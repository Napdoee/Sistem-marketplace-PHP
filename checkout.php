<?php 
    include "./database/config.php"; 

    $checkCart = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_user = '".$_SESSION['id']."'");

    if(!mysqli_num_rows($checkCart)){
        header("Location: product.php");
    }

    if(isset($_POST['order'])){
        $idu = $_POST['idu'];
        $ids = $_POST['ids'];
        $qty = $_POST['qty'];
        $tpr = $_POST['tpr'];
        $itm = $_POST['itm'];

        $usn = $_POST['usn'];
        $noTelp = $_POST['noTelp'];
        $address = $_POST['address'];
        // var_dump($_POST);

        // echo "INSERT INTO tb_order SET
        // id_user         = '".$idu."', 
        // id_seller       = '".$ids."', 
        // quantity        = '".$qty."', 
        // total_produk    = '".$qty."', 
        // total_price     = '".$tpr."', 
        // items           = '".$itm."'";

        $insert = mysqli_query($conn, "INSERT INTO tb_orders SET
        id_user         = '".$idu."',
        username        = '".$usn."',
        noTelp          = '".$noTelp."',
        address         = '".$address."',
        id_seller       = '".$ids."', 
        total_produk    = '".$qty."', 
        total_price     = '".$tpr."', 
        items           = '".$itm."'
        ");

        if($insert){
            $delete = mysqli_query($conn, "DELETE FROM tb_cart WHERE id_user = '".$idu."'");
            if($delete) {
                echo "<script>alert('Succesfully orders all cart items!');
                window.location='cart.php';</script>";
            }
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
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
                <h2>ORDER SUMMARY</h2>
                <div class="box">
                    <?php 
                        include_once "./functions.php";

                        $grandTotal = 0;
                        $cartItem[] = '';
                        $data = query("SELECT * , u.noTelp as userTelp, u.username as userName FROM tb_cart c, tb_produk p, tb_user u, tb_seller s 
                        WHERE c.id_user = u.id_user
                        AND c.id_produk = p.id_produk
                        AND p.id_seller = s.id_seller
                        AND c.id_user = '".$_SESSION['id']."' AND u.id_user = '".$_SESSION['id']."'
                        ORDER BY id_cart DESC");
                        $dataInfo = $data[0];
                        // var_dump($data);
                    ?>
                    <div class="flex" style="align-items: center;">
                        <h3>Your Information</h3>
                        <a href="profile.php" class="btn-update small"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> INFO</a>
                    </div>
                    <hr class="line">
                    <table class="tb-summary">
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i></td>
                            <td><p><?= $dataInfo['userName'] ?></p></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i></td>
                            <td><?= $dataInfo['email'] ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-phone" aria-hidden="true"></i></td>
                            <td><?= $dataInfo['userTelp'] ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                            <td><?= $dataInfo['address'] ? $dataInfo['address'] : "<h4 style='color: red;'>Please update your address first!</h4>" ?>
                            </td>
                        </tr>
                    </table>
                    <hr class="line">
                    <div class="cart-box">
                        <div class="flex" style="align-items: center;">
                            <h3>CART ITEMS</h3>
                            <h3>TOTAL</h3>
                            <!-- <a href="profile.php" class="btn-update small"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> INFO</a> -->
                        </div>
                        <hr class="line">
                        <table class="tb-summary" border="0" width="100%">
                        <?php 
                            foreach($data as $a) :
                                $cartItem[] = $a['name'].' ('.$a['price'].' x '.$a['quantity'].')/';
                                $cartDB = implode($cartItem);
                                $grandTotal += ($a['price'] * $a['quantity']);
                        ?>
                            <tr>
                                <td><?= $a['name'] ?></td>
                                <td align="right"><?=  number_format($a['price']).' x '.$a['quantity'] ?></td>
                            </tr>
                        <?php endforeach; ?> 
                        </table>
                        <hr class="line">
                        <div class="flex" style="padding: 0px 9px 10px;">
                            <p>ITEMS <?= count($cartItem) - 1; ?></p>
                            <p class="product-price">Rp. <?= number_format($grandTotal) ?></p>
                        </div>
                    </div>
                    <hr class="line">
                    <form action="" method="POST">
                    <input type="hidden" name="usn" value="<?= $dataInfo['userName'] ?>">
                    <input type="hidden" name="noTelp" value="<?= $dataInfo['userTelp'] ?>">
                    <input type="hidden" name="address" value="<?= $dataInfo['address'] ?>">
                    <input type="hidden" name="ids" value="<?= $dataInfo['id_seller'] ?>">
                    <input type="hidden" name="idu" value="<?= $dataInfo['id_user'] ?>">
                    <input type="hidden" name="qty" value="<?= count($cartItem) ?>">
                    <input type="hidden" name="tpr" value="<?= $grandTotal ?>">
                    <input type="hidden" name="itm" value="<?= $cartDB ?>">
                    <?php if($dataInfo['address'] != '') { ?>
                        <button type="submit" name="order" class="btn-chkout">ORDER ITEMS</button>
                    <?php } else { ?>
                        <button  onclick="return alert('Update your address first!')" class="btn-chkout btn-disabled">ORDER ITEMS</button>
                    <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>