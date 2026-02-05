<?php
// ================================ ADD ITEM SCRIPT ================================= //
require_once '../db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addItem'])) {
    // We store the data sent by the fetch in a variable.
    $itemName = trim($_POST['itemName']);
    $itemQuantity = trim($_POST['itemQuantity']);
    $itemPrice = trim($_POST['itemPrice']);
    $itemDescription = trim($_POST['itemDescription']);
    $userID = $_SESSION['user_id'];

    try {
        // We prepare the SQL statement to insert the new item into the database.
        $sql = "INSERT INTO inventory (item_name, item_stock, price, description, user_id) 
                VALUES (:itemName, :itemQuantity, :itemPrice, :itemDescription, :userID)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':itemName' => $itemName,
            ':itemQuantity' => $itemQuantity,
            ':itemPrice' => $itemPrice,
            ':itemDescription' => $itemDescription,
            ':userID' => $userID
        ]);
        // If everything is correct, we return a success message.
        echo "success-item-added";
    } catch (PDOException $e) {
        echo "error-adding-item: " . $e->getMessage();
    }
} else {
    echo "invalid-request";
}

?>