<?php
// ============================ User management logic ============================

// The user session starts and we increase the time of the session cookies to remain active.
session_start();
$sessionLifetime = 86400 * 30;
if (isset($_POST['keep-signed-in']) && $_POST['keep-signed-in'] == 'true') {
    setcookie(session_name(), session_id(), time() + $sessionLifetime, "/");
}

// We call the file that establishes the connection with the database. 
require_once 'db.php';

try {
    // We check if a function was sent to us from JS through the POST method
    if(isset($_POST['function'])){

        $action = $_POST['function'];

        // If the user is already logged in, we prevent them from logging in or creating a new user again
        if (isset($_SESSION['user_id']) && ($action == 'logInUser' || $action == 'createNewUser')) {
            echo "already-logged";
            exit;
        }

        // ============================ Login logic ============================

        // We verify the type of function we received, and from there, the requirements stored in the database are prepared for verification. 
        if ($action == 'logInUser'){
            $username = $_POST["username"];
            $password = $_POST["password"];

            $query = $connection->prepare("SELECT * FROM users WHERE username = :username");
            $result = $query->execute(['username' => $username]);
            $userFound = $query->fetch(PDO::FETCH_ASSOC);
            // We prepare the statement to retrieve role and business information
            $stmt = $connection->prepare("SELECT Role, Business FROM users WHERE UserID = :userID");

            // If the user exists, we verify the hashed password, assign the value to the user variables, and print the result of the process.  
            if ($userFound) {
                if (password_verify($password, $userFound['Password'])) {
                    // We assign session variables for user identification and personalization.
                    $_SESSION['user_id'] = $userFound['UserID'];
                    $_SESSION['username'] = $userFound['Username'];
                    // We execute the statement to get role and business information
                    $stmt->execute(['userID' => $userFound['UserID']]);
                    $roleBusiness = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['role'] = $roleBusiness['Role'];
                    $_SESSION['business'] = $roleBusiness['Business'];
                    echo "success";
                } else {
                    echo "incorrect-pass";
                }
            } else {
                echo "error";
            }

        // ============================ Registration logic ============================

        // If the function is to create a new user, we first assign variables to the data sent and then check if the username already exists in the database.
        } else if ($action == 'createNewUser'){
            $newUsername = $_POST['new-username'];
            $newPassword = $_POST['new-password'];
            $passwordHashed = password_hash($newPassword, PASSWORD_DEFAULT); // We hash the password for security.
            $checkUser = $connection->prepare("SELECT * FROM users WHERE username = :newUsername");
            $checkUser->execute(['newUsername' => $newUsername]);

            // We check if there are more than 0 rows in the database containing the user name. If so, we notify that the user already exists; otherwise, we proceed to create the new user.
            if ($checkUser->rowcount() > 0) {
                echo "user-exists";
            } else {
                $query = $connection->prepare("INSERT INTO users (username, password) VALUES (:newUsername, :newPassword)");
                $result = $query->execute(['newUsername' => $newUsername, 'newPassword' => $passwordHashed]);

                // If the user is created successfully, we automatically log them in by assigning session variables and printing the success message.
                if($result){
                    // We get the ID that the database just generated
                    $lastId = $connection->lastInsertId(); 
                    $_SESSION['user_id'] = $lastId;
                    $_SESSION['username'] = $newUsername;
                    echo "success-create";
                }   else {
                        echo "error-create";
                }
            }
        }
    }
} catch (PDOException $e){
    echo 'Query error: ' . $e->getMessage();
} // We assign a message to query errors

?>