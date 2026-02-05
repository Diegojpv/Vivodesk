<?php
require_once '../db.php';
// ================================ EDIT ITEM SCRIPT ================================= //
// We check if the request method is POST and if the editItem field is set.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editItem'])){
    $itemId = $_POST['item_id'];
    $itemDescription = $_POST['itemDescription'];
    $itemQuantity = $_POST['itemQuantity'];
    $itemPrice = $_POST['itemPrice'];

    try { // We prepare the SQL statement to update the item in the database.
    $stmt = $connection->prepare("UPDATE inventory SET description = :description, item_stock = :quantity, price = :price WHERE item_id = :id");
    $stmt->execute([
        'description' => $itemDescription,
        'quantity' => $itemQuantity,
        'price' => $itemPrice,
        'id' => $itemId
    ]);
        echo "success-item-updated";
        exit();
    } catch (PDOException $e) {
        echo "error-updating-item: " . $e->getMessage();
        exit();
    }
} else {
    echo "invalid-request";
    exit();
}

?>