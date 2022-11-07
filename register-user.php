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
<body>
    <nav>
        <a href="index.php" class="logo">MarketPlace</a>
        <ul>
            <li><a href="./login/login-user.php">Login</a></li>
        </ul>
    </nav>
    <main>
        <div class="section">
            <div class="container-60">
                <div class="head-content">
                    <div class="head-title">Register your account</div>
                </div>
                <div class="box" style="border-radius: 10px;">
                    <form method="post" autocomplete="off" id="UserRegister">
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Type your username">
                        <label for="mail">E-mail</label>
                        <input type="email" name="mail" id="mail" class="form-input" placeholder="Type your e-mail">
                        <label for="telp">Phone Number</label>
                        <input type="tel" name="telp" id="telp" class="form-input" placeholder="081234567891" pattern="[0-9]{13}" maxlength="13"  title="Ten digits code">
                        <hr class="line">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" class="form-input" placeholder="Type your passowrd">
                        <label for="pass2">Type your password again</label>
                        <input type="password" name="pass2" id="pass2" class="form-input" placeholder="Type your passowrd">
                        <input type="submit" id="BtnRegister" name="register" value="Register account" class="form-submit">
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