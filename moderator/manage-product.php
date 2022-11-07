<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php"; 

    if(isset($_POST['add-product'])){
        $name   = $_POST['name'];
        $cate   = $_POST['category'];
        $desc   = $_POST['desc'];
        $price  = $_POST['price'];
        $seller = $_POST['seller'];

        $fileImg = $_FILES['img'];
        $typeImg = explode('.', $fileImg['name']);
        $image   = "product".time().'.'.$typeImg[1];

        $mysql = mysqli_query($conn, "INSERT INTO tb_produk SET
        id_seller   = '".$seller."',
        id_category = '".$cate."',
        name        = '".$name."', 
        description = '".$desc."',
        price       = '".$price."',
        image       = '".$image."',
        status      = 1
        ");

        if($mysql){
            move_uploaded_file($fileImg['tmp_name'], '../assets/product/'.$image);
            echo "<script>alert('Product Succesfully Added'); window.location='manage-product.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_GET['delete'])){
        $mysql = mysqli_query($conn, "DELETE FROM tb_produk WHERE id_produk = '".$_GET['delete']."'");

        if($mysql){
            move_uploaded_file($fileImg['tmp_name'], '../assets/product/'.$image);
            echo "<script>alert('Product Succesfully Delete'); window.location='manage-product.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Product</title>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Data Product</div>
                    <a id="ModalBtn" class="head-link">Add Product +</a>
                </div>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th width="5%">No</th>
                            <th>Product</th>
                            <th>Seller Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_seller USING(id_seller) WHERE tb_produk.status = 1 ORDER BY tb_produk.createAt DESC;");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td><?= $a['name'] ?></td>
                                <td><?= $a['companyName'].' - '.$a['username'] ?></td>
                                <td>Rp. <?= number_format($a['price']) ?></td>
                                <td align="center"><?= $a['status'] ? "Active" : "Deactive" ?></td>
                                <td align="center"><img width="50px" src="../assets/product/<?= $a['image'] ?>" alt="<?= $a['name'] ?>"></td>
                                <td align="center">
                                    <a href="update-product.php?id=<?= $a['id_produk'] ?>">Update</a> ||
                                    <a onclick="return confirm('Are you sure want delete this product? [<?= $a['name'] ?>]')" href="manage-product.php?delete=<?= $a['id_produk'] ?>">Delete</a>
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
                        <div class="head-title">Add Product</div>
                        <span class="close">&times;</span>
                    </div>
                    <form method="post" autocomplete="off" enctype="multipart/form-data">
                        <label for="name">Name Product</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Name" required>
                        <label for="seller">Seller</label>
                        <select name="seller" class="form-input" required>
                            <option value="#">Select Seller</option>
                            <?php 
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_seller ORDER BY id_seller DESC");

                                if(mysqli_num_rows($mysql) > 0){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <option value="<?= $a['id_seller'] ?>"><?= $a['companyName'].' - '.$a['username'] ?></option>
                            <?php } } else {?>
                            <option value="">There Was Error</option>
                            <?php }?>
                        </select>
                        <label for="category">Category</label>
                        <select name="category" class="form-input" required>
                            <option value="#">Select Category</option>
                            <?php 
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");

                                if(mysqli_num_rows($mysql) > 0){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <option value="<?= $a['id_category'] ?>"><?= $a['categoryName'] ?></option>
                            <?php } } else {?>
                            <option value="">There Was Error</option>
                            <?php }?>
                        </select>
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" cols="30" rows="5" class="form-input" required></textarea>
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-input" placeholder="Price" required>
                        <label for="img">Image</label>
                        <input type="file" name="img" id="img" class="form-input" required>
                        <input type="submit" name="add-product" value="Add Product" class="form-submit admin">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../styles/modal.js"></script>
    <script> CKEDITOR.replace( 'desc' );</script> 
</body>
</html>