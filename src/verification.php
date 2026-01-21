<?php
// ============================ Security verification ============================
// This file is included in pages that require user authentication.
// We updated the verification system to prevent users from lagging behind with old session cookies. 

session_start();
require_once 'db.php'; // conexión PDO

// Check if the user is logged in by verifying the presence of 'user_id' in the session.
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
} else {
    $username = $_SESSION['username'];
    $userId   = $_SESSION['user_id'];

    // We verify whether the user and session ID exist and match the database.
    $stmt = $connection->prepare("SELECT UserID, username, role, business FROM users WHERE UserID = :id LIMIT 1");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    if (!$user) {
        // if the user does not exist in the database, we destroy the session and close it
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    if ($user['username'] !== $username) {
        // If the username does not match, we destroy the session and close it
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    // if everything is correct, we assign the user data to variables
    $role     = $user['role'] ?? '';
    $business = $user['business'] ?? '';
}
?>
