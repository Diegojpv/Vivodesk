<?php
// ============================ Add new client ============================
// This file handles the addition of new clients to the database.

require_once '../db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addClient'])) {
    // We store the data sent by the fetch in a variable.
    $clientName = trim($_POST['clientName']);
    $clientEmail = trim($_POST['clientEmail']);
    $clientPhone = trim($_POST['clientPhone']);
    $clientAddress = trim($_POST['clientAddress']);
    $description = trim($_POST['description']);
    $userID = $_SESSION['user_id'];

    try {
        // We prepare the SQL statement to insert the new client into the database.
        $sql = "INSERT INTO clients (name, email, phone, address, description, user_id) 
                VALUES (:clientName, :clientEmail, :clientPhone, :clientAddress, :description, :userID)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':clientName' => $clientName,
            ':clientEmail' => $clientEmail,
            ':clientPhone' => $clientPhone,
            ':clientAddress' => $clientAddress,
            ':description' => $description,
            ':userID' => $userID
        ]);
        // If everything is correct, we return a success message.
        echo "success-client-added";
    } catch (PDOException $e) {
        echo "error-adding-client: " . $e->getMessage();
    }
} else {
    echo "invalid-request";
}
?>