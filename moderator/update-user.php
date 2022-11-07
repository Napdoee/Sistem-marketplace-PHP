<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php";

    if(isset($_GET['id'])){
        $mysql = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '".$_GET['id']."'");

        if(mysqli_num_rows($mysql)){
            $a = mysqli_fetch_assoc($mysql);
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <h3>Update Data User</h3><br>
                    <a href="manage-user.php" class="head-link">< Kembali</a>
                </div>
                <div class="box">
                    <form method="post" autocomplete="off">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-input" placeholder="email" value="<?= $a['email'] ?>" required>
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Username" value="<?= $a['username'] ?>" required>            
                        <label for="telp">Phone Number</label>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="Type Number" value="<?= $a['noTelp'] ?>" required>                     
                        <input type="submit" name="update-user" value="Update Data user" class="form-submit admin">
                    </form>
                    <?php 
                        if(isset($_POST['update-user'])){
                            $email = $_POST['email'];
                            $user    = $_POST['user'];
                            $telp    = $_POST['telp'];
                            $status  = $_POST['status'];
                    
                            $mysql = mysqli_query($conn, "UPDATE tb_user SET
                            email = '".$email."', 
                            username    = '".$user."', 
                            noTelp      = '".$telp."'
                            WHERE id_user = '".$a['id_user']."'
                            ");
                    
                            if($mysql){
                                echo "<script>alert('User Succesfully Added'); window.location='manage-user.php';</script>";
                            } else {
                                echo "There was error: ".mysqli_error($conn);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <h3>Change Password</h3>
                <div class="box">
                    <form method="post" autocomplete="off">
                        <label for="pass1">Passowrd</label>
                        <input type="password" name="pass1" id="pass1" class="form-input" placeholder="Type Password" required>
                        <label for="pass2">Repeat Password</label>
                        <input type="password" name="pass2" id="pass2" class="form-input" placeholder="Type Repeat Password" required> 
                        <input type="submit" name="change-password" value="Update Password user" class="form-submit admin">
                    </form>
                    <?php 
                        if(isset($_POST['change-password'])){
                            $pass1 = $_POST['pass1'];
                            $pass2 = $_POST['pass2'];
                    
                            if($pass2 != $pass1){
                                echo "<script>alert('passwords doesn\'t match')</script>";
                                return;
                            }

                            $mysql = mysqli_query($conn, "UPDATE tb_user SET
                            password = '".MD5($pass1)."'
                            WHERE id_user = '".$a['id_user']."'
                            ");
                    
                            if($mysql){
                                echo "<script>alert('User Password Changed'); window.location='manage-user.php';</script>";
                            } else {
                                echo "There was error: ".mysqli_error($conn);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>