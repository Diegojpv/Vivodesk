<?php
// We include the security verification to ensure only authenticated users can access this page.
require_once '../src/verification.php';
?>

<!DOCTYPE html>
<!-- ============================ Vivodesk Work Desk Page ============================ -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/workdesk.css">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/fonts.css">
    <title>Vivodesk - Work Desk</title>
</head>
<body>
    <main>
        <h1>Welcome to your Work Desk, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>This is your workspace.</p>
        <a href="index.php">Back to Home</a>
    </main>
</body>
</html>