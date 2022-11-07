<?php include "./database/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <main>
        <div class="search">
            <div class="container">
                <form action="" autocomplete="off">
                    <input name="search"  type="text" list="searchs"  placeholder="Search Product">
                    <!-- <datalist id="searchs">
                    <?php
                        $list = mysqli_query($conn, "SELECT name FROM tb_produk WHERE status = 1 ");
                        while($a = mysqli_fetch_array($list)) {
                            
                    ?>
                        <option value="<?php echo $a['name'] ?>"></option>
                    <?php } ?>
                    </datalist> -->
                    <input type="submit" name="src" value="Search Product">
                </form>
            </div>
        </div>
        <?php 
            if($_GET['search'] != ''){
                $where = "AND name LIKE '%".$_GET['search']."%'";
                $title = "Result for: ".$_GET['search']." ";
            } else if(isset($_GET['cate']) != ''){
                $where = "AND tb_category.categoryName = '".$_GET['cate']."'";
                $title = "Category: ".$_GET['cate'];
            } else if(isset($_GET['seller']) != ''){
                $where = "AND id_seller = '".$_GET['seller']."'";
                $query = mysqli_query($conn, "SELECT companyName FROM tb_seller WHERE id_seller = '".$_GET['seller']."'");
                $name = mysqli_fetch_assoc($query)['companyName'];
                $title = "Company: ".$name;
            }
        ?>
        <div class="section">
            <div class="container">
                <h3><?= $title ? $title : "All Product" ?></h3>
                <div class="box">
                    <?php
                        $mysql = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_category USING(id_category) WHERE status = 1 $where ORDER BY tb_produk.createAt DESC");
                        if(mysqli_num_rows($mysql) > 0){
                            while($a = mysqli_fetch_array($mysql)){
                    ?>
                    <div class="col-4">
                        <div onclick="window.location='./detail-product.php?id=<?= $a['id_produk'] ?>'" class="card">
                            <div class="card-image">
                                <img src="./assets/product/<?= $a['image']?>" alt="<?= $a['image']?>">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <div class="card-title"><?= $a['name'] ?></div>
                                    <div class="card-price">Rp. <?= number_format($a['price']) ?></div>
                                </div>
                                <div style="font-size: 13px; color: #333" class="card-subtitle">
                                    <a class="btn-link" href="product.php?cate=<?= $a['categoryName'] ?>"><?= $a['categoryName'] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }} else {?>
                    <p align="center" >404 Not Data Found</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- <div class="section">
            <div class="container">
                <h3>From Best Seller</h3>
                <div class="box">
                    <?php 
                        $mysql = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_seller = 202309001 ORDER BY createAt DESC");
                        if(mysqli_num_rows($mysql) > 0){
                            while($a = mysqli_fetch_array($mysql)){
                    ?>
                    <div class="col-4">
                        <div onclick="window.location='./detail-product.php?id=<?= $a['id_produk'] ?>'" class="card">
                            <div class="card-image">
                                <img src="./assets/product/<?= $a['image']?>" alt="<?= $a['image']?>">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <div class="card-title"><?= $a['name'] ?></div>
                                </div>
                                <div class="card-price">Rp. <?= number_format($a['price']) ?></div>
                            </div>
                        </div>
                    </div>
                    <?php }} else {?>
                    <p align="center" >404 Not Data Found</p>
                    <?php } ?>
                </div>
            </div>
        </div> -->
    </main>
</body>
</html>