<?php 
    include "./database/config.php";
    
    if(isset($_POST['register'])){
        $email  = $_POST['mail'];
        $user   = $_POST['user'];
        $telp   = $_POST['telp'];
        $pass   = $_POST['pass'];
        $pass2  = $_POST['pass2'];

        $emails = mysqli_query($conn, "SELECT email FROM tb_user");
        $validEmail = mysqli_fetch_array($emails);

        if(in_array($email, $validEmail)){
            echo "<script>alert('This email is already registered')</script>";
        }else {
            $mysql = mysqli_query($conn, "INSERT INTO tb_user SET
            email       = '".$email."', 
            username    = '".$user."', 
            password    = '".MD5($pass)."', 
            noTelp      = '".$telp."'
            ");

            if($mysql){
                echo "<script>alert('Succesfully created your account!');window.location='./login/login-user.php'</script>";
            } else {
                echo "There was error: ".mysqli_error($conn);
            }
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration User</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="bg-center linear">
    <!-- <div class="form-login">
        <div class="login-text">Signup</div>
        <form action="process-login.php?lvl=user" method="POST" id="UserLogin">
            <input type="text" name="user" id="user" class="form-input" placeholder="Username" required>
            <input class="form-input" type="email" name="name" id="name" placeholder="Email" required>
            <input class="form-input" type="text" name="tel" id="tel" placeholder="Phone number" required>
            <input class="form-input" type="password" name="pass" id="pass" placeholder="Password" required>
            <input class="form-input" type="password" name="pass2" id="pass2" placeholder="Confirm Password" required>
            <input style="width: 100%; text-align: center;" class="form-submit" type="submit" name="login-submit" value="Login to account">
            <a href="../register-user.php" class="form-submit register">Don't have account? <b> Register Here</b></a>
        </form>
    </div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>    
    <script>
        $("#UserLogin").validate();
    </script> -->

    <main>
        <div class="section">
            <div style="width: 50%; margin: 0 auto">
                <div class="box" style="border-radius: 10px;">
                    <h2 style="margin: 5px 0px 8px; text-align: center;">Create your account</h2>
                    <form method="post" autocomplete="off" id="UserRegister">
                        <input type="text" name="user" id="user" class="form-input" placeholder="Type your username">
                        <input type="email" name="mail" id="mail" class="form-input" placeholder="Type your e-mail">
                        <input type="tel" name="telp" id="telp" class="form-input" placeholder="081234567891" pattern="[0-9]{13}" maxlength="13"  title="Ten digits code">
                        <input type="password" name="pass" id="pass" class="form-input" placeholder="Type your passowrd">
                        <input type="password" name="pass2" id="pass2" class="form-input" placeholder="Type your passowrd">
                        <input style="width: 100%; text-align: center" type="submit" id="BtnRegister" name="register" value="Register account" class="form-submit">
                        <p class="sign-button">Already have an account? 
                        <a href="./login/login-user.php"><b>Login</b></a></p>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>    
    <script src="./js/register.js"></script>
</body>
</html>