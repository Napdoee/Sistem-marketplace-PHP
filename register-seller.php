<?php 
    include "./database/config.php";

    if(isset($_POST['register-seller'])){
        $company   = $_POST['company'];
        $user   = $_POST['user'];
        $pass   = MD5($_POST['pass']);
        $telp   = $_POST['telp'];

        $query = mysqli_query($conn, "INSERT INTO tb_seller SET
        companyName = '".$company."', 
        username    = '".$user."', 
        password    = '".$pass."', 
        noTelp      = '".$telp."',
        status = 0
        ");

        if($query){
            echo '<script>alert("Succesfully created your seller account\nPlease wait for receipt from admin");window.location="./seller.php"</script>';
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Become an Seller</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <nav>
        <a href="index.php" class="logo">MarketPlace</a>
        <ul>
            <li><a href="./login/login-seller.php">Login</a></li>
        </ul>
    </nav>
    <main>
        <div class="section">
            <div class="container-60">
                <div class="head-content">
                    <div class="head-title">Register account Seller</div>
                </div>
                <div class="box" style="border-radius: 10px;">
                    <form method="post" autocomplete="off" id="SellerRegister">
                        <label for="company">Company Name</label>
                        <input type="text" name="company" id="company" class="form-input" placeholder="Type your Company Name" required>
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Type your username" required>
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" class="form-input" placeholder="Type your passowrd" required>
                        <label for="telp">Phone Number</label>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="Type your phone number" required>
                        <input type="submit"id="BtnRegister" name="register-seller" value="Register account" class="form-submit">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>
    <script src="./js/register-seller.js"></script>
</body>
</html>