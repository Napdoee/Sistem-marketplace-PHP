<?php 
    include "../database/config.php"; 
    include "../partials/seller-only.php";

    if(isset($_POST['update-status'])){
        $ido = $_POST['ido'];
        $sts = $_POST['status'];

        $update = mysqli_query($conn, "UPDATE tb_orders SET
        payment_status = '".$sts."' WHERE id_orders = '".$ido."'");

        if($update){
            header("Location: orders.php");
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Orders</title>
</head>
<body>
    <?php include "../partials/navbar-seller.php" ?>
    <main>
    <div class="section">
            <div class="container">
                <h3>Your Orders</h3>
                <div class="box">
                    <?php 
                        include_once "../partials/functions.php";

                        $sql = query("SELECT * FROM tb_orders o
                        WHERE o.id_seller = '".$_SESSION['id']."'");

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
                                <td>
                                    <div style="font-size: 16px;" class="product-price">Rp. <?= number_format($a['total_price']) ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Order Date</td>
                                <td>:</td>
                                <td><?= $a['order_date'] ?></td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>:</td>
                                <!-- <td style="color: <?= $a['payment_status'] == 'pending' ? 'red' : 'green' ?>"><?= strtoupper($a['payment_status']) ?></td> -->
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="ido" value="<?= $a['id_orders'] ?>">
                                        <select style="padding: 5px;margin: 5px 0px;border-radius: 5px" name="status">
                                            <option value="">Select Status</option>                                            
                                            <option <?= $a['payment_status'] == 'pending' ? "selected" : '' ?> value="pending">Pending</option>
                                            <option <?= $a['payment_status'] == 'completed' ? "selected" : '' ?> value="completed">Completed</option>
                                        </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="head-link seller" name="update-status" type="submit">Update</button>
                                    <button class="head-link seller"
                                    onclick="return confirm('Are you sure want remove this order? [<?= $a['username'] ?>]');
                                    window.location='?delete=<?= $a['id_orders'] ?>'">Delete</button>
                                </td>
                                </form>
                            </tr>
                            </p>
                        </table>
                    </div>
                    <?php endforeach; 
                    } else {?>
                    <tr>
                        <td colspan="3" align="center">No Orders Found</td>
                    </tr>
                    <?php }?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>