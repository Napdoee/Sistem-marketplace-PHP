<?php include "./database/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <header>
        <div class="container-80">
            <div class="title">Become a seller in our shop</div>
            <div class="sub-title">You can promote products on our service</div>
            <a class="btn-title" href="./login/login-seller.php">Login as Seller</a>
            <a class="btn-title b10" href="register-seller.php">Sign Up Here</a>
        </div>
    </header>
    <main>
        <div class="section">
            <div class="container">
                <h3>Our Seller</h3>
                <div class="box">
                    <?php 
                        $mysql = mysqli_query($conn, "SELECT COUNT(id_produk) as Jmlh, tb_seller.companyName, tb_seller.id_seller
                        FROM tb_seller LEFT JOIN tb_produk USING(id_seller) 
                        WHERE tb_seller.status = 1 
                        GROUP BY id_seller HAVING Jmlh > 0
                        ORDER BY `Jmlh` DESC;");

                        if(mysqli_num_rows($mysql)){
                            while($a = mysqli_fetch_array($mysql)){
                    ?>
                    <div class="col-3">
                        <div class="card-2">
                            <div class="card-2-grid">
                                <div class="card-2-title">
                                    <h4><?= $a['companyName'];  ?></h4>
                                    <p onclick="window.location='product.php?seller=<?= $a['id_seller'] ?>'" class="prSeller">View Product</p>
                                </div>
                                <div class="card-2-subtitle">
                                  Product: <?= $a['Jmlh'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-4">
                       <div class="card-2">
                            <div class="card-2-grid">
                                <div class="card-2-title">
                                    <h4><?= $a['companyName'] ?></h4>
                                    <p><?= $a['username'] ?></p>
                                </div>
                                <div class="card-2-subtitle">
                                    Product: 10
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php }} ?>
                </div>
            </div>
        </div>
    </main>
    <!-- <?php include "./partials/footer.php"; ?> -->
</body>
</html>