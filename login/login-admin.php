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
<body class="bg-center">
    <div class="form-login admin">
        <div class="login-text">Login Admin</div>
        <form action="process-login.php?lvl=admin" method="POST" autocomplete="off">
            <input class="form-input" type="text" name="name" id="name" placeholder="Username" required>
            <input class="form-input" type="password" name="pass" id="pass" placeholder="Password" required>
            <input class="form-submit admin" type="submit" name="login-submit" value="Login">
        </form>
    </div>
</body>
</html>