<?php
require_once '../db.php';
// ================================ SELL ITEM SCRIPT ================================= //
// We check if the request method is POST and if the sellItem field is set.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sellItem'])){
    try {
        $itemId = $_POST['item_id'];
        // We store the data sent by the fetch in a variable. Only integers and floats are converted accordingly. 
        $sellQuantity = intval($_POST['sellQuantity']);
        $buyerName = $_POST['buyerName'];
        $availableStock = intval($_POST['availableStock']);
        $itemPrice = floatval($_POST['itemPrice']);
        $userId = $_POST['user_id'];
        $itemName = $_POST['item_name'];
        // Validate sell quantity
        if ($sellQuantity <= 0) {
            echo "Sell quantity must be greater than zero.";
        }
        if ($sellQuantity > $availableStock) {
            echo "Insufficient stock available.";
        }

        // Update inventory stock
        // Calculate total price
        $totalPrice = $sellQuantity * $itemPrice;
        $newStock = $availableStock - $sellQuantity;
        $updateStmt = $connection->prepare("UPDATE inventory SET item_stock = :newStock WHERE item_id = :itemId AND user_id = :userId");
        $updateStmt->execute(['newStock' => $newStock, 'itemId' => $itemId, 'userId' => $userId]);

        // Record the sale
        $saleStmt = $connection->prepare("INSERT INTO sales (item_id, quantity, buyer_name, price, user_id, product_name, total_price) VALUES (:itemId, :quantitySold, :buyerName, :itemPrice, :userId, :itemName, :totalPrice)");
        $saleStmt->execute([
            'itemId' => $itemId,
            'quantitySold' => $sellQuantity,
            'buyerName' => $buyerName,
            'itemPrice' => $itemPrice,
            'userId' => $userId,
            'itemName' => $itemName,
            'totalPrice' => $totalPrice
        ]);
        echo "success-item-sold";
    } catch (Exception $e) {
        echo "error-item-sold:" . $e->getMessage();
    };
}
?>