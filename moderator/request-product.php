<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php"; 

    if(isset($_GET['active'])){
        $mysql = mysqli_query($conn, "UPDATE tb_produk SET status = 1 WHERE id_produk = '".$_GET['active']."'");

        if($mysql){
            echo "<script>alert('Product actived successfully')</script>";
            echo "<script>window.location='request-product.php'</script>";
        } else {
            echo 'Something Error '.mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Product</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <h3>Requested Product</h3>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th>No</th>
                            <th>Product</th>
                            <th>Seller Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th width="20%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_seller USING(id_seller) WHERE tb_produk.status = 0 ORDER BY tb_produk.createAt DESC;");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no ?></td>
                                <td><?= $a['name'] ?></td>
                                <td><?= $a['companyName'].' - '.$a['username'] ?></td>
                                <td>Rp. <?= number_format($a['price']) ?></td>
                                <td align="center"><img width="50px" src="../assets/product/<?= $a['image'] ?>" alt="<?= $a['name'] ?>"></td>
                                <td align="center">
                                    <a href="?active=<?= $a['id_produk'] ?>">Actived</a>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td align="center" colspan="7">Not Data Found</td>
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