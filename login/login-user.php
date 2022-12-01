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
<body class="bg-center linear">
    <div class="form-login">
        <div class="login-text">Login User</div>
        <form action="process-login.php?lvl=user" method="POST" id="UserLogin">
            <input class="form-input" type="email" name="name" id="name" placeholder="Email" required>
            <input class="form-input" type="password" name="pass" id="pass" placeholder="Password" required>
            <input style="width: 100%; text-align: center;" class="form-submit" type="submit" name="login-submit" value="Login to account">
            <!-- <a href="../register-user.php" class="form-submit register">Don't have an account? <b> Register Here</b></a> -->
            <p class="sign-button">Don't have an account? 
            <a href="../register-user.php"><b>Signup</b></a></p>
        </form>
    </div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>    
    <script>
        $("#UserLogin").validate();
    </script>
</body>
</html>