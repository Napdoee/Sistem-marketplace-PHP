<?php 
    include "check-login.php";
    include "../partials/links.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body class="bg-seller bg-center">
    <div class="form-login seller">
        <div class="login-text">Login Seller</div>
        <form action="process-login.php?lvl=seller" method="POST" autocomplete="off">
            <input class="form-input" type="text" name="name" id="name" placeholder="Username" required>
            <input class="form-input" type="password" name="pass" id="pass" placeholder="Password" required>
            <input style="width: 100%; text-align: center;" class="form-submit seller" type="submit" name="login-submit" value="Login as Seller">
        </form>
    </div>
</body>
</html> 