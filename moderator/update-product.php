<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php";

    if(isset($_GET['id'])){
        $mysql = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = '".$_GET['id']."'");

        if(mysqli_num_rows($mysql)){
            $a = mysqli_fetch_object($mysql);
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Product</title>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <h3>Update Data Product</h3><br>
                    <a href="manage-product.php" class="head-link">< Kembali</a>
                </div>
                <div class="box">
                    <form method="post" autocomplete="off" enctype="multipart/form-data">
                        <label for="name">Name Product</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Name" value="<?= $a->name ?>">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-input" required>
                            <option value="">Select Status</option>
                            <option <?= $a->status == '1' ? 'selected' : '' ?> value="1">Active</option>
                            <option <?= $a->status == '0' ? 'selected' : '' ?>  value="0">Deactive</option>
                        </select>
                        <label for="seller">Seller</label>
                        <select name="seller" id="seller" class="form-input" required>
                            <option value="#">Select Seller</option>
                            <?php 
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_seller ORDER BY id_seller DESC");

                                if(mysqli_num_rows($mysql) > 0){
                                    while($i = mysqli_fetch_array($mysql)){
                            ?>
                            <option <?= $a->id_seller == $i['id_seller'] ? "selected" : ""?> value="<?= $i['id_seller'] ?>"><?= $i['companyName'].' - '.$i['username'] ?></option>
                            <?php } } else {?>
                            <option value="">There Was Error</option>
                            <?php }?>
                        </select>
                        <label for="category">Category</label>
                        <select name="category" class="form-input">
                            <option value="#">Select Category</option>
                            <?php 
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");

                                if(mysqli_num_rows($mysql) > 0){
                                    while($i = mysqli_fetch_array($mysql)){
                            ?>
                            <option <?= $a->id_category == $i['id_category'] ? "selected" : ""?> value="<?= $i['id_category'] ?>"><?= $i['categoryName'] ?></option>
                            <?php } } else {?>
                            <option value="">There Was Error</option>
                            <?php }?>
                        </select>
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" cols="30" rows="10" class="form-input"><?= $a->description ?></textarea>
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-input" placeholder="Price" value="<?= $a->price ?>">
                        <img width="100px" src="../assets/product/<?= $a->image ?>" alt="<?= $a->name ?>"><br>
                        <p style="font-size: 14px;"><?= $a->image ?></p>
                        <label for="img">Image</label>
                        <input type="hidden" name="Himg" value="<?= $a->image ?>">
                        <input type="file" name="img" id="img" class="form-input">
                        <input type="submit" name="update-product" value="Update Data" class="form-submit admin">
                    </form>
                    <?php  
                        if(isset($_POST['update-product'])){
                            $name   = $_POST['name'];
                            $cate   = $_POST['category'];
                            $desc   = $_POST['desc'];
                            $price  = $_POST['price'];
                            $seller = $_POST['seller'];
                            $status = $_POST['status'];

                            $fileImg = $_FILES['img'];
                            $Himg    = $_POST['Himg'];

                            if($fileImg['name'] != ''){
                                $typeImg = explode('.', $fileImg['name']);

                                $image   = "product".time().'.'.$typeImg[1];

                                $allowed = array("jpg", "jpeg", "png");

                                if(!in_array($typeImg[1], $allowed)){
                                    echo "<script>alert('File type image not allowed')</script>";
                                } else {
                                    unlink('../assets/product/'.$Himg);
                                    move_uploaded_file($fileImg['tmp_name'], '../assets/product/'.$image);
                                    $img = $image;
                                }
                            } else {
                                $img = $Himg;
                            }

                            $mysql = mysqli_query($conn, "UPDATE tb_produk SET
                            id_seller   = '".$seller."',
                            id_category = '".$cate."',
                            name        = '".$name."', 
                            description = '".$desc."',
                            price       = '".$price."',
                            image       = '".$img."',
                            status      = '".$status."'
                            WHERE id_produk = '".$a->id_produk."'
                            ");

                            if($mysql){
                                echo "<script>alert('Product updated successfully')</script>";
                                echo "<script>window.location='manage-product.php'</script>";
                            } else {
                                echo 'Something Error '.mysqli_error($conn);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script> CKEDITOR.replace( 'desc' );</script> 
</body>
</html>