<?php
// ============================ Security verification ============================
// This file is included in pages that require user authentication.

// We start the session to access session variables.
session_start();
// We check if the session does not exist or if the user in the URL does not match the one in the session.
if (!isset($_SESSION['username']) || (isset($_GET['user']) && $_GET['user'] !== $_SESSION['username'])) {
    // If it is not the correct user, we send them back to the index
    header("Location: ../public/index.php");
    exit();
}
// If the user manages to access, we assign the username from the session to a variable for further use.
$username = $_SESSION['username'];
?>