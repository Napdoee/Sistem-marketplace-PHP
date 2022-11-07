<?php
    include "../database/config.php";
    include "../partials/admin-only.php"; 

    if(isset($_GET['active'])){
        $mysql = mysqli_query($conn, "UPDATE tb_seller SET status = 1 WHERE id_seller = '".$_GET['active']."'");

        if($mysql){
            echo "<script>alert('Seller Succesfully Actived'); window.location='request-seller.php';</script>";
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
                <h3>Requested Seller</h3>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th width="5%">No</th>
                            <th>Company Name</th>
                            <th>Seller</th>
                            <th>No Telp.</th>
                            <th width="20%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_seller WHERE status = 0 ORDER BY id_seller DESC");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no ?></td>
                                <td><?= $a['companyName'] ?></td>
                                <td><?= $a['username'] ?></td>
                                <td><?= $a['noTelp'] ?></td>
                                <td align="center">
                                    <a href="?active=<?= $a['id_seller'] ?>">Actived</a>
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
</body>
</html>