<?php
// ================================ DELETE ITEM SCRIPT ================================= //
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteItem'])) {
    $itemId = $_POST['item_id'];

    // Prepare and execute the delete statement
    $stmt = $connection->prepare("DELETE FROM inventory WHERE item_id = :itemId");
    $stmt->execute(['itemId' => $itemId]);

    // Return a success response
    echo 'success-item-deleted';
} else {
    // Return an error response for invalid requests
    echo 'error-invalid-request';
}
?>