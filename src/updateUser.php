<?php
// =========================== Update User Section ===========================
// This file handles updating user information in the database.

require_once 'db.php';
session_start();

// We check if the request method is POST and if the 'updateUser' parameter is set.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
    // We assign variables to the data sent from the profile page.
    $updateUser = trim($_POST['updateUser']);
    $role = trim($_POST['role']);
    $business = trim($_POST['business']);

    // We check if the new username already exists for another user in the database.
    $userID = $_SESSION['user_id'];
    $checkUser = $connection->prepare("SELECT * FROM users WHERE username = :updateUser AND UserID != :userID");
    $checkUser->execute(['updateUser' => $updateUser, 'userID' => $userID]);
    if($checkUser->rowCount() > 0){
        echo "user-exists";
        exit;
    }

    try{ // We prepare the SQL statement to update the user's information.
        $sql = "UPDATE users SET Username = :updateUsername, Role = :role, Business = :business WHERE UserID = :userID";
        $stmt = $connection->prepare($sql);
        // We bind the parameters to the prepared statement.
        $stmt->bindParam(':updateUsername', $updateUser, PDO::PARAM_STR);
        $stmt->bindParam(':role', $_POST['role'], PDO::PARAM_STR);
        $stmt->bindParam(':business', $_POST['business'], PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        // We execute the statement and check if the update was successful.
        if($stmt->execute()){
            $_SESSION['username'] = $updateUser;
            $_SESSION['role'] = $role;
            $_SESSION['business'] = $business;
            echo "update-success";
        } else {
            echo "update-error";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "invalid-request";
}

?>