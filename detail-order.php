<?php include "./database/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Product</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <main>
        <div class="section">
            <div class="container-60">
                <div class="head-content">
                    <div class="head-title">Order Product</div>
                    <a href="detail-product.php?id=<?= $_POST['pid'] ?>" class="head-link">Cancel</a>
                </div>
                <div class="box">
                    <div class="col-2">
                        <center>
                        <img width="300px" src="./assets/product/<?= $_POST['img'] ?>" alt="none">
                        </center>
                    </div>
                    <div class="col-2">
                        <div class="head-content">
                            <div class="head-title"><?= $_POST['name'] ?></div>
                            <!-- <h3 class="product-price">Rp. <?= number_format($_POST['price'])." ( X ".$_POST['qty']." )" ?></h3> -->
                        </div>
                        <table class="tb-ordet">
                            <!-- <tr>
                                <th>Product</th>
                                <td>:</td>
                                <td><?= $_POST['name'] ?></td>
                            </tr> -->
                            <tr>
                                <th>Price</th>
                                <td>:</td>
                                <td>Rp. <?= number_format($_POST['price'])." ( X ".$_POST['qty']." )" ?></td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td>:</td>
                                <td>Rp. <?= number_format($_POST['price']*$_POST['qty']) ?></td>
                            </tr>
                        </table>
                        <div class="head-content">
                            <div class="head-title">Your Information</div>
                        </div>
                        <table class="tb-ordet">
                            <tr>
                                <th><i class="fa fa-user" aria-hidden="true"></i></th>
                                <td><?= $_SESSION['name'] ?></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-phone" aria-hidden="true"></i></th>
                                <td>90909</td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-map-marker" aria-hidden="true"></i></th>
                                <td>Ndatau</td>
                            </tr>
                        </table>
                        <button>Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>