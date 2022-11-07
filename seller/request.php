<?php 
    include "../database/config.php"; 
    include "../partials/seller-only.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request New Product!</title>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

</head>
<body>
    <?php include "../partials/navbar-seller.php"; ?>
    <main>
        <div class="section">
            <div class="container">
                <h3>Request New Product to Admin !</h3>
                <div class="box">
                    <form action="proses-request.php" method="post" autocomplete="off" enctype="multipart/form-data">
                        <label for="name">Name Product</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Name">
                        <label for="category">Category</label>
                        <select name="category" class="form-input">
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
                        <textarea name="desc" id="desc" cols="30" rows="10" class="form-input"></textarea>
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-input" placeholder="Price">
                        <label for="img">Image</label>
                        <input type="file" name="img" id="img" class="form-input">
                        <input type="submit" name="request" value="Request to admin" class="form-submit seller">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script> CKEDITOR.replace( 'desc' );</script> 
</body>
</html>