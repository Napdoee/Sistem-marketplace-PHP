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
<body class="bg-seller bg-center">
    <main>
        <div class="section">
            <div style="width: 50%; margin: 0 auto">
                <div class="box" style="border-radius: 10px;">
                    <h2 style="margin: 5px 0px 8px; text-align: center;">Signup Seller</h2>
                    <form method="post" autocomplete="off" id="SellerRegister">
                        <input type="text" name="company" id="company" class="form-input" placeholder="Type your Company Name" required>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Type your username" required>
                        <input type="password" name="pass" id="pass" class="form-input" placeholder="Type your passowrd" required>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="Type your phone number" required>
                        <input style="width: 100%; text-align: center" type="submit" id="BtnRegister" name="register" value="Register account" class="form-submit seller">
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