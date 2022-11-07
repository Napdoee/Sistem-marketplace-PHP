<?php 
    include "./database/config.php"; 

    if(isset($_POST['update-profile'])){
        $email   = $_POST['email'];
        $usn    = $_POST['user'];
        $telp   = $_POST['telp'];
        $adres  = $_POST['adres'];

        // var_dump($_POST['telp']);

        $mysql = mysqli_query($conn, "UPDATE tb_user SET
        email    = '".$email."', 
        username    = '".$usn."',
        address     = '".$adres."',
        noTelp      = '".$telp."'
        WHERE id_user = '".$user['id_user']."'
        ");

        if($mysql){
            echo "<script>alert('Succesfully update your profile!');window.location='profile.php'</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
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
                    <div class="head-title">Update Profile</div>
                </div>
                <div class="box">
                    <?php 
                        include_once "./functions.php";

                        $user = query("SELECT * FROM tb_user WHERE id_user = '".$_SESSION['id']."'")[0];
                    ?>
                    <form method="post" autocomplete="off" id="UserProfile">
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Type your username" value="<?= $user['username'] ?>" required>
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-input" placeholder="Type your name" value="<?= $user['email'] ?>" required>
                        <label for="telp">Phone Number</label>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="081234567891" pattern="[0-9]{13}" maxlength="13"  title="Phone number must be at least 13 digits"
                        value="<?= $user['noTelp'] ?>" required>
                        <label for="adres">Address</label>
                        <textarea name="adres" id="adres" placeholder="Type your full address" rows="5" class="form-input"><?= $user['address'] ?></textarea>
                        <div class="flex">
                            <div class="flex">
                                <input type="submit" name="update-profile" value="Update Profile" class="form-submit">
                                <input type="reset" value="Cancel" class="form-submit" style="opacity: 0.8;">
                            </div>
                            <a href="change-pass.php" class="form-submit" style="font-size: 14px;">Change Password ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/jquery.validate.min.js"></script>    
    <script>
        $("#UserProfile").validate();
    </script>
</body>
</html>