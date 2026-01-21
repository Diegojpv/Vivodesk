<?php
// =========================== Delete User Section ===========================
// This file handles the deletion of a user account from the database.

// We include the database connection file to interact with the database.
require_once 'db.php';
session_start();
// We check if the request method is POST and if the 'delete' parameter is set.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userID = $_SESSION['user_id'];

    try { // We prepare the SQL statement to delete the user based on their UserID.
        $sql = "DELETE FROM users WHERE UserID = :userID";
        $stmt = $connection->prepare($sql);
        // We bind the UserID parameter to the prepared statement.
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    // We execute the statement and check if the deletion was successful.
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            // We clear the session data and destroy the session after successful deletion.
            session_unset();
            session_destroy();
            echo "delete-success";
        } else {
            echo "delete-error";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "invalid-request";
}
?>
