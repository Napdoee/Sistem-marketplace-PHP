<?php
    include "../database/config.php";
    include "../partials/admin-only.php"; 

    if(isset($_POST['add-seller'])){
        $company = $_POST['company'];
        $user    = $_POST['user'];
        $pass    = MD5($_POST['pass']);
        $telp    = $_POST['telp'];

        $mysql = mysqli_query($conn, "INSERT INTO tb_seller SET
        companyName = '".$company."', 
        username    = '".$user."', 
        password    = '".$pass."', 
        noTelp      = '".$telp."',
        status      = 1
        ");

        if($mysql){
            echo "<script>alert('Seller Succesfully Added'); window.location='manage-seller.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_GET['delete'])){
        $enable = mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0;");
        $delete = mysqli_query($conn, "DELETE s.*, p.* FROM tb_seller s, tb_produk p 
        WHERE s.id_seller = p.id_seller AND s.id_seller = '".$_GET['delete']."';");

        if($enable AND $delete){
            echo "<script>alert('Seller Succesfully Delete'); window.location='manage-seller.php';</script>";
            $disable = mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1;");
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Seller</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Data Seller</div>
                    <a id="ModalBtn" class="head-link">Add Seller +</a>
                </div>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th width="5%">No</th>
                            <th>Company Name</th>
                            <th>Seller</th>
                            <th>No Telp.</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_seller WHERE status = 1 ORDER BY id_seller DESC");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no ?></td>
                                <td><?= $a['companyName'] ?></td>
                                <td><?= $a['username'] ?></td>
                                <td><?= $a['noTelp'] ?></td>
                                <td align="center"><?= $a['status'] ? "Active" : "Deactive" ?></td>
                                <td align="center">
                                    <a href="update-seller.php?id=<?= $a['id_seller'] ?>">Update</a> ||
                                    <a onclick="return confirm('Are you sure want delete this Seller? [<?= $a['username'] ?>]\nthis Will be delete all products from seller')" href="?delete=<?= $a['id_seller'] ?>">Delete</a>
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
                        <div class="head-title">Add Seller</div>
                        <span class="close">&times;</span>
                    </div>
                    <form method="post" autocomplete="off" enctype="multipart/form-data">
                        <label for="company">Company Name</label>
                        <input type="text" name="company" id="company" class="form-input" placeholder="Company Name" required>
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" class="form-input" placeholder="Username" required>
                        <label for="pass">Password</label>
                        <input type="text" name="pass" id="pass" class="form-input" placeholder="Type Password" required>                     
                        <label for="telp">Phone Number</label>
                        <input type="text" name="telp" id="telp" class="form-input" placeholder="Type Number" required>                     
                        <input type="submit" name="add-seller" value="Add Seller" class="form-submit admin">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../styles/modal.js"></script>
</body>
</html>