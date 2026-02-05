<?php
    require_once '../../src/verification.php';
    require_once '../../src/db.php';
    // We call up the customer database, which detects customers by their user ID and organizes them from most recent to oldest.
    $user_id = $_SESSION['user_id']; 
    $stmt = $connection->prepare("SELECT * FROM clients WHERE user_id = :uid ORDER BY creation_date DESC"); $stmt->execute(['uid' => $user_id]); 
    $clients = $stmt->fetchAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/clients.css">
    <title>Vivodesk - Clients</title>
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <main>
        <header class="wd-main__header">
            <search class="wd-main__search"><input type="text" id="search" placeholder="Search clients.."></search>
            <input type="checkbox" id="toggle-form">
            <label for="toggle-form" class="wd-btn--add-client">
                <img src="../assets/img/add-client.webp" alt="Add Client">
            </label>
            <div class="wd-form--container">
                <form class="wd-form__add-client" id="add-client-form">
                    <header class="wd-form__header">
                        <h2>Add New Client</h2> 
                        <label for="toggle-form" class="wd-btn--close-form"><img src="../assets/img/close.webp" alt="close form"></label>
                    </header>
                    <div class="wd-form__body">
                        <input type="text" name="clientName" placeholder="Client Name" required>
                        <textarea name="clientAddress" placeholder="Address" class="form-client__address"></textarea>
                        <input type="email" name="clientEmail" placeholder="Client Email">
                        <input type="tel" name="clientPhone" placeholder="Client Phone">
                        <textarea name="description" placeholder="Description" class="form-client__description"></textarea>
                        <button type="submit" id="add-client-btn">Add Client</button>
                    </div>
                </form>
            </div>
        </header>
        <!-- Check if the clients variable is empty. If not, generate a container div with each client's data.  -->
        <?php if (empty($clients)): ?> 
            <p class="empty-message">You don't have any customers yet. 🚀</p> 
            <?php else: ?> 
                <section class="wd-main__content"> 
                    <?php foreach ($clients as $c): ?> 
                        <div class="client-card"> 
                            <input type="checkbox" id="details-toggle-<?= htmlspecialchars($c['client_id']) ?>" class="details-toggle">
                            <input type="checkbox" id="edit-toggle-<?= htmlspecialchars($c['client_id']) ?>" class="edit-toggle">
                            <header class="client-card--header">
                                <div class="client-card--status">
                                    <div class="client-settings-container">
                                        <label for="details-toggle-<?= htmlspecialchars($c['client_id']) ?>" class="client-settings-btn">
                                            <img src="../assets/img/close.webp" alt="Close Details">
                                        </label>
                                        <label for="edit-toggle-<?= htmlspecialchars($c['client_id']) ?>" class="client-settings-btn">
                                            <img src="../assets/img/edit.webp" alt="Edit Client">
                                        </label>
                                        <button type="submit" form="edit-client-form-<?= htmlspecialchars($c['client_id'])?>" class="client-settings-btn save-btn">
                                            <img src="../assets/img/save.webp" alt="Save Client">
                                        </button>
                                        <button type="button" class="client-settings-btn delete-btn" onclick="deleteClient(<?= htmlspecialchars($c['client_id']) ?>)">
                                            <img src="../assets/img/delete.webp" alt="Delete Client">
                                        </button>
                                    </div>
                                    <p>Active 🟢</p>
                                </div>
                                <img src="../assets/img/client-icon.webp" alt="Client Icon" class="client-card--icon">
                            </header>
                            <form class="card--content" id="edit-client-form-<?= htmlspecialchars($c['client_id'])?>">
                                <input type="hidden" name="client_id" value="<?= htmlspecialchars($c['client_id']) ?>">
                                <input type="text" value="<?= htmlspecialchars($c['name']) ?>" class="client-card__name" readonly name="clientName"> 
                                <textarea class="client-card__address" readonly name="clientAddress"><?= htmlspecialchars($c['address'])?></textarea>
                                <input type="tel" class="client-card__phone" value="<?= htmlspecialchars($c['phone']) ?>" readonly name="clientPhone">     
                                <input type="email" class="client-card__email" value="<?= htmlspecialchars($c['email']) ?>" readonly name="clientEmail"> 
                                <textarea class="client-card__description" readonly name="description"><?= htmlspecialchars($c['description'])?></textarea> 
                                <small class="created--date">Created: <?= htmlspecialchars($c['creation_date']) ?></small> 
                            </form>
                            <label for="details-toggle-<?= htmlspecialchars($c['client_id']) ?>" class="details-label"> More details</label>
                        </div> 
                    <?php endforeach; ?> 
                </section> 
        <?php endif; ?>
    </main>
    <script src="../assets/js/clients.js"></script>
</body>
</html>