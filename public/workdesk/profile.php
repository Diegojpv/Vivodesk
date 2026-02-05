<?php
// =========================== Profile Section ===========================
    require_once '../../src/verification.php';   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Vivodesk - Profile</title>
</head>
<body>
    <?php require_once 'navbar.php'; ?>
    <main class="profile-section">
        <div class="profile-card">
            <div class="profile-card__content">
                <div class="profile-card__img">
                    <img src="../assets/img/profile.webp" alt="">
                </div>
                <form class="profile-card__info" id="profileForm">
                    <input type="text" name="updateUser" id="updateUser" value="<?php echo htmlspecialchars($username); ?>">
                    <input type="text" name="role" placeholder="Role" value="<?php echo htmlspecialchars($role)?>" id="role">
                    <input type="text" name="business" placeholder="Business Name" value="<?php echo htmlspecialchars($business)?>" id="business">
                    <div class="profile-card__settings">
                        <button id="delete" class="delete-account-btn"> 
                            <p>Delete User</p>
                            <img src="../assets/img/x.webp" alt="">
                        </button>
                        <button id="logout" class="logout-btn">
                            <p>Logout</p>
                            <img src="../assets/img/logout-small.webp" alt="">
                        </button>
                        <button type="submit" id="save" class="save-changes-btn">
                            <p>Save Changes</p>
                            <img src="../assets/img/check.webp" alt="">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../assets/js/profile.js"></script>
</body>
</html>