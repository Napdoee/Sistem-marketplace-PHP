<?php 
    include "./database/config.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MarketPlace</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <header>
        <div class="container-80">
            <div class="title">Welcome <?= $_SESSION['name'] ? ucfirst($_SESSION['name']) : '' ?> to our store</div>
            <div class="sub-title">Our shop caters to your various needs</div>
        </div>
    </header>
    <main>
        <div class="box" style="margin: 0px">
            <?php 
                $mysql = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY createAt");
                if(mysqli_num_rows($mysql) > 0){
                    while($i = mysqli_fetch_array($mysql)){
            ?>
            <div class="container">
                <div class="col-5">
                    <div class="category-box" onclick="window.location='product.php?cate=<?= $i['categoryName'] ?>'">
                        <img width="50px" src="./assets/img/category.png" alt="">
                        <p align="center" style="font-size: 16px;"><?= $i['categoryName'] ?></p>
                    </div>
                </div>
            </div>
            <?php }} else {?>
            <p align="center" >404 Not Data Found</p>
            <?php } ?>
        </div>
        <!-- Latest Product -->
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Latest Product</div>
                    <a href="product.php" class="head-link product">See Products</a>
                </div>
                <div class="box">
                    <?php 
                        $mysql = mysqli_query($conn, "SELECT * FROM tb_produk WHERE status = 1 ORDER BY createAt DESC LIMIT 4");
                        if(mysqli_num_rows($mysql) > 0){
                            while($a = mysqli_fetch_array($mysql)){
                    ?>
                    <div class="col-4">
                        <div onclick="window.location='detail-product.php?id=<?= $a['id_produk'] ?>'" class="card">
                            <div class="card-image">
                                <img src="./assets/product/<?= $a['image']?>" alt="<?= $a['name']?>">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <div class="card-title"><?= $a['name'] ?></div>
                                    <!-- <p>Owner: Gwejh</p> -->
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
        </div>
        <!-- <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">New Clothes !</div>
                    <a href="product.php?cate=Clothing" class="head-link product">See Products</a>
                </div>
                <div class="box">
                    <?php 
                        $mysql = mysqli_query($conn, "SELECT * FROM tb_produk p, tb_category c WHERE p.status = 1 AND c.id_category = p.id_category
                        AND c.categoryName = 'Clothing' ORDER BY p.createAt DESC");
                        if(mysqli_num_rows($mysql) > 0){
                            while($a = mysqli_fetch_array($mysql)){
                    ?>
                    <div class="col-4">
                        <div onclick="window.location='detail-product.php?id=<?= $a['id_produk'] ?>'" class="card">
                            <div class="card-image">
                                <img src="./assets/product/<?= $a['image']?>" alt="<?= $a['name']?>">
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
    <?php include "./partials/footer.php"; ?>
</body>
</html>