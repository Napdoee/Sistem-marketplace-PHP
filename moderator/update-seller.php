<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php";

    if(isset($_GET['id'])){
        $mysql = mysqli_query($conn, "SELECT * FROM tb_seller WHERE id_seller = '".$_GET['id']."'");

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
    <title>Update Seller</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <h3>Update Data Seller</h3><br>
                    <a href="manage-seller.php" class="head-link">< Kembali</a>
                </div>
                <div class="box">
                    <form method="post" autocomplete="off">
                        <label for="company">Company Name</label>
                        <input type="text" name="company" id="company" class="form-input" placeholder="Company Name" value="<?= $a['companyName'] ?>" required>
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-input" required>
                            <option value="">Select Status</option>
                            <option <?= $a['status'] == '1' ? 'selected' : '' ?> value="1">Active</option>
                            <option <?= $a['status'] == '0' ? 'selected' : '' ?>  value="0">Deactive</option>
                        </select>
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Username" value="<?= $a['username'] ?>" required>            
                        <label for="telp">Phone Number</label>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="Type Number" value="<?= $a['noTelp'] ?>" required>                     
                        <input type="submit" name="update-seller" value="Update Data Seller" class="form-submit admin">
                    </form>
                    <?php 
                        if(isset($_POST['update-seller'])){
                            $company = $_POST['company'];
                            $user    = $_POST['user'];
                            $telp    = $_POST['telp'];
                            $status  = $_POST['status'];
                    
                            $mysql = mysqli_query($conn, "UPDATE tb_seller SET
                            companyName = '".$company."', 
                            username    = '".$user."', 
                            noTelp      = '".$telp."',
                            status      = '".$status."'
                            WHERE id_seller = '".$a['id_seller']."'
                            ");
                    
                            if($mysql){
                                echo "<script>alert('Seller Succesfully Added'); window.location='manage-seller.php';</script>";
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
                        <input type="submit" name="change-password" value="Update Password Seller" class="form-submit admin">
                    </form>
                    <?php 
                        if(isset($_POST['change-password'])){
                            $pass1 = $_POST['pass1'];
                            $pass2 = $_POST['pass2'];
                    
                            if($pass2 != $pass1){
                                echo "<script>alert('passwords doesn\'t match')</script>";
                                return;
                            }

                            $mysql = mysqli_query($conn, "UPDATE tb_seller SET
                            password = '".MD5($pass1)."'
                            WHERE id_seller = '".$a['id_seller']."'
                            ");
                    
                            if($mysql){
                                echo "<script>alert('Seller Password Changed'); window.location='manage-seller.php';</script>";
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