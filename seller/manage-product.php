<?php include "../database/config.php"; include "../partials/seller-only.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Product</title>
</head>
<body>
    <?php include "../partials/navbar-seller.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Data Product</div>
                    <a href="request.php" class="head-link seller">Request Product</a>
                </div>
                <div class="box">
                    <table class="table-data">
                        <thead>
                            <th>No</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_category USING(id_category) WHERE id_seller = ".$_SESSION['id']." ORDER BY tb_produk.status DESC;");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td><?= $a['name'] ?></td>
                                <td><?= $a['categoryName'] ?></td>
                                <td>Rp. <?= number_format($a['price']) ?></td>
                                <td><?= $a['status'] ? "Active" : "Deactive" ?></td>
                                <td align="center"><img width="50px" src="../assets/product/<?= $a['image'] ?>" alt="<?= $a['name'] ?>"></td>
                                <td align="center">
                                    <a href="update.php?id=<?= $a['id_produk'] ?>">Update</a> ||
                                    <a href="delete.php?id=<?= $a['id_produk'] ?>">Delete</a>
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