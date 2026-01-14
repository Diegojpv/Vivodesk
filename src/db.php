<?php
// ============================ Database Connection ============================
// This file establishes a connection to the Vivodesk database using PDO.

// Database configuration
$host = 'localhost';
$dbname = 'vivodesk';
$user = 'root';
$pass = '';

// Establishing the database connection
try{
    // We create a new pdo instance based on the values set in the database variables.
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // We set the PDO error mode to exception for better error handling.
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
    exit;
}
?>