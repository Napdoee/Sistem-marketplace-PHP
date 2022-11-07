<?php include "../database/config.php"; include "../partials/admin-only.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MarketPlace</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="box">
                    <h3>Welcome Back <?= $_SESSION['name'] ?></h3>
                </div>
            </div>
        </div>
    </main>
</body>
</html>