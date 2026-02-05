<?php
    require_once '../../src/verification.php';
    require_once '../../src/db.php';
    // We call up the customer database, which detects customers by their user ID and organizes them from most recent to oldest.
    $userId = $_SESSION['user_id'];
    $stmt = $connection->prepare("SELECT * FROM inventory WHERE user_id = :uid ORDER BY created_date DESC"); 
    $stmt->execute(['uid' => $userId]); 
    $items = $stmt->fetchAll(); 
    $salesStmt = $connection->prepare("SELECT * FROM sales WHERE user_id = :uid ORDER BY sell_date DESC"); 
    $salesStmt->execute(['uid' => $userId]);
    $sales = $salesStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <title>Vivodesk - Inventory</title>
</head>
<body>
    <?php require_once 'navbar.php';?>
    <main class="wd-inventory">
        <header class="wd-inventory__header">
            <search class="search-item--box"><input type="text" id="search-input" placeholder="Search items..."></search>
            <div class="wd-inventory__header-actions">
                <button class="btn btn--add-item">
                    <input type="checkbox" id="add-item-checkbox" class="open-card-checkbox">
                    <label for="add-item-checkbox" class="add-item-label">
                        <img src="../assets/img/add-item.webp" alt="">
                    </label>
                </button>
                <button class="btn btn--history">
                    <input type="checkbox" id="history-checkbox" class="open-card-checkbox history-checkbox">
                    <label for="history-checkbox">
                        <img src="../assets/img/history.webp" alt="">
                    </label>
                </button>
                <div class="history-card__container">
                    <header class="history-card__header">
                        <h2>Sales history</h2> 
                        <label for="history-checkbox" class="wd-btn--close-form"><img src="../assets/img/close.webp" alt="close form"></label>
                    </header>
                    <section class="history-content">
                        <!-- History items will be dynamically loaded here -->
                        <?php if(empty($sales)): ?>
                        <p class="empty-message">No history available.</p>
                        <?php else: ?>
                        <?php foreach ($sales as $sale): ?>
                        <div class="history-item-card">
                            <div class="history-item-card--info">
                                <h3><?php echo htmlspecialchars($sale['product_name']);?></h3>
                                <p>Sold to: <?php echo htmlspecialchars($sale['buyer_name']); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($sale['quantity']); ?></p>
                                <p>Price per item: $<?php echo htmlspecialchars(number_format($sale['price'], 2)); ?></p>
                                <p>Total Price: $<?php echo htmlspecialchars(number_format($sale['total_price'], 2)); ?></p>
                                <small>Sold on: <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($sale['sell_date']))); ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </section>
                </div>
                <div class="add-item-form__container">
                    <header class="item-form__header">
                        <h2>Add New Item</h2> 
                        <label for="add-item-checkbox" class="wd-btn--close-form"><img src="../assets/img/close.webp" alt="close form"></label>
                    </header>
                    <form id="add-item-form" class="add-item-form">
                        <input type="text" name="itemName" placeholder="Item Name" required>
                        <input type="number" step="1" name="itemQuantity" placeholder="Quantity" required>
                        <input type="number" step="0.01" name="itemPrice" placeholder="Price" required>
                        <textarea name="itemDescription" placeholder="Description" class="form-item__description"></textarea>
                        <button type="submit" form="add-item-form" class="add-item-form--submit-btn">Add Item</button>
                    </form>
                </div>
            </div>
        </header>
        <?php if (empty($items)):?>
            <p class="empty-message">Your inventory is empty. Start adding items to keep track of your stock! 📦</p>
        <?php else: ?>
        <section class="wd-inventory__content">
            <!-- Inventory items will be dynamically loaded here -->
            <?php foreach ($items as $item): ?>
            <div class="inventory-item-card">
                <header class="inventory-item-card--header">
                    <div class="inventory-item-card--settings">
                            <input type="checkbox" id="sell-item-checkbox-<?php echo htmlspecialchars($item['item_id']); ?>" class="open-card-checkbox sell-item-checkbox">
                            <label class="inventory-item--sell-btn" for="sell-item-checkbox-<?php echo htmlspecialchars($item['item_id']); ?>">
                                <img src="../assets/img/sell.webp" alt="Sell Item">
                            </label>
                            <button type="submit" form="inventory-item-form-<?php echo htmlspecialchars($item['item_id']); ?>" class="inventory-item--save-btn">
                                <img src="../assets/img/save.webp" alt="Save Changes">
                            </button>
                            <input type="checkbox" id="edit-item--checkbox-<?php echo htmlspecialchars($item['item_id']); ?>" class="edit-item-checkbox">
                            <label class="inventory-item--edit-btn" for="edit-item--checkbox-<?php echo htmlspecialchars($item['item_id']); ?>">
                                <img src="../assets/img/edit.webp" alt="Edit Item">
                            </label>
                            <button class="inventory-item--delete-btn" onclick="deleteInventoryItem(<?php echo htmlspecialchars($item['item_id']); ?>)">
                                <img src="../assets/img/delete.webp" alt="Delete Item">
                            </button>
                    </div>
                    <div class="inventory-item-card--image">
                    <img src="../assets/img/product.webp" alt="Product Image">
                    </div>
                </header>
                <form id="inventory-item-form-<?php echo htmlspecialchars($item['item_id']); ?>" class="item-info-form">
                    <input type="text" value="<?php echo htmlspecialchars($item['item_name']); ?>" readonly class="item-card--name">
                    <span class="item-card--stock-text">Stock:</span>
                    <input type="number" value="<?php echo htmlspecialchars($item['item_stock']); ?>" readonly class="item-card--stock" name="itemQuantity">
                    <span class="item-card--price-text">$:</span>
                    <input type="number" step="0.01" value="<?php echo htmlspecialchars($item['price']); ?>" readonly class="item-card--price" name="itemPrice">
                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>" class="item-card--id">
                    <textarea readonly class="item-card--description" name="itemDescription"><?php echo htmlspecialchars($item['description']); ?></textarea>
                </form>
                <form id="sell-item-form-<?php echo htmlspecialchars($item['item_id']); ?>" class="sell-item-form">
                    <header class="sell-item-form__header">
                        <h4>Sell <?php echo htmlspecialchars($item['item_name']); ?></h4> 
                        <label for="sell-item-checkbox-<?php echo htmlspecialchars($item['item_id']); ?>" class="wd-btn--close-form"><img src="../assets/img/close.webp" alt="close form"></label>
                    </header>
                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                    <input type="number" name="sellQuantity" placeholder="Quantity to Sell" required>
                    <input type="text" name="buyerName" placeholder="Buyer Name" required>
                    <input type="hidden" name="availableStock" value="<?php echo htmlspecialchars($item['item_stock']); ?>">
                    <input type="hidden" name="itemPrice" value="<?php echo htmlspecialchars($item['price']); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
                    <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>">
                    <button type="submit" form="sell-item-form-<?php echo htmlspecialchars($item['item_id']); ?>">Confirm Sale</button>
                </form>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>
    </main>
    <script src="../assets/js/inventory.js"></script>
</body>
</html>