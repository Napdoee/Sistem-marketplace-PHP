<?php include "./database/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <h3>Your Orders</h3>
                <div class="box">
                    <?php 
                        include_once "./functions.php";

                        $sql = query("SELECT * FROM tb_orders
                        WHERE id_user = '".$_SESSION['id']."'");

                        $no = 1;
                        if(count($sql)) {
                        foreach($sql as $a):
                    ?>
                    <div class="col-2">
                        <table class="tb-orders">
                            <tr>
                                <td colspan="3">
                                    <h3>Order <?= $no++ ?></h3>
                                    <hr class="line">
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><?= $a['username'] ?></td>
                            </tr>
                            <tr>
                                <td>Number</td>
                                <td>:</td>
                                <td><?= $a['noTelp'] ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?= $a['address'] ?></td>
                            </tr>
                            <tr>
                                <td>Items</td>
                                <td>:</td>
                                <td>
                                <?php 
                                    $items = explode("/", $a['items']);
                                    array_pop($items);

                                    foreach($items as $item){
                                        echo "- ".$item."<br>";
                                    }   
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>:</td>
                                <td>Rp. <?= number_format($a['total_price']) ?></td>
                            </tr>
                            <tr>
                                <td>Order Date</td>
                                <td>:</td>
                                <td><?= $a['order_date'] ?></td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>:</td>
                                <td style="color: <?= $a['payment_status'] == 'pending' ? 'red' : 'green' ?>"><?= strtoupper($a['payment_status']) ?></td>
                            </tr>
                            </p>
                        </table>
                    </div>
                    <?php endforeach; 
                    } else { ?>
                    <h4 align="center">You don't have any orders item</h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>