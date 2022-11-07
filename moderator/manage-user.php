<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php"; 

    if(isset($_POST['add-user'])){
        $email = $_POST['email'];
        $user    = $_POST['user'];
        $pass    = MD5($_POST['pass']);
        $telp    = $_POST['telp'];

        $mysql = mysqli_query($conn, "INSERT INTO tb_user SET
        email    = '".$email."', 
        username    = '".$user."', 
        password    = '".$pass."', 
        noTelp      = '".$telp."'
        ");

        if($mysql){
            echo "<script>alert('User Succesfully Added'); window.location='manage-user.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_GET['delete'])){
        $mysql = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = '".$_GET['delete']."'");

        if($mysql){
            echo "<script>alert('User Succesfully Delete'); window.location='manage-user.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage User</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Data User</div>
                    <a id="ModalBtn" class="head-link">Add User +</a>
                </div>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th width="5%">No</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>No Telp.</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_user ORDER BY id_user DESC");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no ?></td>
                                <td><?= $a['email'] ?></td>
                                <td><?= $a['username'] ?></td>
                                <td><?= $a['noTelp'] ?></td>
                                <td align="center">
                                    <a href="update-user.php?id=<?= $a['id_user'] ?>">Update</a> ||
                                    <a onclick="return confirm('Are you sure want delete this user? [<?= $a['email'] ?>]')" href="?delete=<?= $a['id_user'] ?>">Delete</a>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td align="center" colspan="7">404 Not Data Found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <div class="container">
        <div class="modal" id="myModal">
            <div class="modal-content">
                <div class="container">
                    <div class="head-content">
                        <div class="head-title">Add User</div>
                        <span class="close">&times;</span>
                    </div>
                    <form method="post" autocomplete="off">
                        <label for="email">email</label>
                        <input type="email" name="email" id="email" class="form-input" placeholder="email" required>
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Username" required>
                        <label for="pass">Password</label>
                        <input type="text" name="pass" id="pass" class="form-input" placeholder="Type Password" required>                     
                        <label for="telp">Phone Number</label>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="Type Number" required>                     
                        <input type="submit" name="add-user" value="Add User" class="form-submit admin">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../styles/modal.js"></script>
</body>
</html>