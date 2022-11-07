<?php include "./database/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php"; ?>
    <main>
        <div class="section">
            <div class="container-60">
                <div class="head-content">
                    <div class="head-title">Change Password</div>
                    <a href="profile.php" class="head-link product">< Back</a>
                </div>
                <div class="box">
                    <?php include_once "./functions.php"; ?>
                    <form method="post" autocomplete="off" id="ChangePassword">
                        <label for="pass">Previous password</label>
                        <input type="password" name="pass" id="pass" class="form-input" placeholder="Type your previous password" required>
                        <hr class="line">
                        <label for="pass1">Enter new password</label>
                        <input type="password" name="pass1" id="pass1" class="form-input" placeholder="Type your new password" required>
                        <label for="pass2">Re-enter new password</label>
                        <input type="password" name="pass2" id="pass2" class="form-input" placeholder="Type again your new password" required>
                        <div class="flex">
                            <div class="flex">
                                <input type="submit" name="change-pass" value="Change Password" class="form-submit">
                                <input type="reset" value="Cancel" class="form-submit" style="opacity: 0.8;">
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['change-pass'])){                            
                            $pass = $_POST['pass'];
                            $pass1 = $_POST['pass1'];
                            $pass2 = $_POST['pass2'];

                            $dataUser = query("SELECT id_user, password FROM tb_user WHERE id_user = '".$_SESSION['id']."'")[0];

                            if($dataUser['password'] == MD5($pass)){
                                if($pass1 != $pass2){
                                    echo "<script>alert('The new password doesn't match!');window.location='change-pass.php'</script>";
                                } else {
                                    $mysql = mysqli_query($conn, "UPDATE tb_user SET password = '".MD5($pass1)."'
                                    WHERE id_user = '".$dataUser['id_user']."'");
        
                                    if($mysql){
                                        echo "<script>alert('Password succesfully changed!');window.location='profile.php'</script>";
                                    } else {
                                        echo "There was error: ".mysqli_error($conn);
                                    }
                                }
                            } else {
                                echo "<script>alert('Previous password does not match!');window.location='change-pass.php'</script>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>    
    <script src="./js/change-pass.js"></script>
</body>
</html>