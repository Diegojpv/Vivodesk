<?php
// ================================ EDIT CLIENT SCRIPT ================================= //
require_once '../db.php';
session_start();

// We check if the request method is POST and if the editClient field is set.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editClient'])) {
    // We store the data sent by the fetch in a variable.
    $clientID = trim($_POST['client_id']);
    $clientName = trim($_POST['clientName']);
    $clientEmail = trim($_POST['clientEmail']);
    $clientPhone = trim($_POST['clientPhone']);
    $clientAddress = trim($_POST['clientAddress']);
    $description = trim($_POST['description']);
    $userID = $_SESSION['user_id'];

    try {
        // We prepare the SQL statement to update the client in the database.
        $sql = "UPDATE clients 
                SET name = :clientName, email = :clientEmail, phone = :clientPhone, address = :clientAddress, description = :description 
                WHERE client_id = :clientID AND user_id = :userID";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':clientName' => $clientName,
            ':clientEmail' => $clientEmail,
            ':clientPhone' => $clientPhone,
            ':clientAddress' => $clientAddress,
            ':description' => $description,
            ':clientID' => $clientID,
            ':userID' => $userID
        ]);
        // If everything is correct, we return a success message.
        echo "success-client-updated";
    } catch (PDOException $e) {
        echo "error-updating-client: " . $e->getMessage();
    }
} else {
    echo "invalid-request";
}
?>