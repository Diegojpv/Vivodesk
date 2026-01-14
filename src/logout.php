<?php
// ============================ Logout Logic ============================
// This file handles user logout by destroying the session and redirecting to the homepage.

// We start the session to access session variables.
session_start();
// We clear all session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// We destroy the session.
session_destroy();
// We redirect the user to the homepage after logout.
header("Location: ../public/index.php");
exit();
?>