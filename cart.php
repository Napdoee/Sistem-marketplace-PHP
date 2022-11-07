<?php 
    include "./database/config.php"; 

    if(isset($_GET['delete'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_cart WHERE id_cart = '".$_GET['delete']."'");

        if($delete){
            header("Location: cart.php");
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_POST['ch-qty'])){

        $newPrice = $_POST['price']*$_POST['qty'];

        $update = mysqli_query($conn, "UPDATE tb_cart SET
        total_price = '".$newPrice."',
        quantity    = '".$_POST['qty']."' 
        WHERE id_cart = '".$_POST['idc']."'");

        if($update){
            echo "<script>//alert('Succesfully change quantity cart!');
            window.location='cart.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     for(let i=0; i<3; i++){
        //         $(`#Quantity${i}`).on('input', function() {

        //             let price = $(`#Price${i}`).val();
        //             let qty = $(`#Quantity${i}`).val()

        //             $(`#QtyTotal${i}`).html("Rp. "+price * qty);
        //         })
        //     }
        // })
    </script>
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Shopping Cart</div>
                    <!-- <a class="head-link" href="product.php">Procced to Checkout</a> -->
                </div>
                <div class="box">
                    <div class="flex">
                        <table class="tb-cart">
                            <tr>
                                <th colspan="2">Product</th>
                                <th align="left">Quantity</th>
                                <th align="left">Total</th>
                                <th width="15%">Action</th>
                            </tr>
                        <?php  
                            include_once "functions.php";
                            $total = query("SELECT COUNT(id_cart) as TotalCart, SUM(total_price) as TotalPrice, SUM(quantity) as TotalQty FROM tb_cart WHERE id_user = '".$_SESSION['id']."'")[0];

                            $dataCart = query("SELECT * FROM tb_cart LEFT JOIN tb_produk USING(id_produk) WHERE id_user = '".$_SESSION['id']."' ORDER BY id_cart DESC");
                            $no = 0;
                            $no2 = 0;

                            if(count($dataCart)){
                            for($i = 0; $i<count($dataCart); $i++) :
                        ?>
                            <tr>
                                <td width="10%" align="center"><img style="height: 70px; width: 80px; object-fit: contain;" src="./assets/product/<?= $dataCart[$i]['image'] ?>" alt="<?= $dataCart[$i]['name'] ?>"></td>
                                <td>
                                    <a class="btn-link" href="detail-product.php?id=<?= $dataCart[$i]['id_produk'] ?>"><?= $dataCart[$i]['name'] ?></a>
                                    <div style="font-size: 13px; color: #333;">Rp. <?= number_format($dataCart[$i]['price'])?></div>
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" id="Price<?=$i?>" name="price" class="price" value="<?= $dataCart[$i]['price'] ?>">
                                        <input type="hidden" name="idc" value="<?= $dataCart[$i]['id_cart'] ?>">
                                        <input value="<?= $dataCart[$i]['quantity'] ?>" id="Quantity<?=$i?>" type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2" required>
                                        <button class="btn-update" name="ch-qty" type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                                <td id="QtyTotal<?=$i?>">Rp. <?= number_format($dataCart[$i]['total_price']) ?></td>
                                <td width="5%" align="center">
                                    <a onclick="return confirm('Are you sure want remove [ <?= $dataCart[$i]['name'] ?> ] from Cart?')"
                                    class="btn-delete" href="?delete=<?= $dataCart[$i]['id_cart'] ?>">
                                    <i class="fa fa-times" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                            <tr>
                                <td colspan="2">
                                    <h3>Grand Total:</h3>
                                </td>
                                <td>
                                    <?= $total['TotalCart'] ?> Items / <?= $total['TotalQty'] ?> Qty
                                </td>
                                <td>
                                    <div class="product-price">Rp. <?= number_format($total['TotalPrice']) ?></div>
                                </td>
                                <td>
                                <button style="font-size: 14.8px;" type="submit" onclick="return window.location='checkout.php'" class="btn-chkout">Checkout Now !</button>
                                </td>
                            </tr>
                        <?php } else {?>
                            <tr>
                                <td align="center" colspan="5"><h2>You dont have any items in cart</h2></td>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>