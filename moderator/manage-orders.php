<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php"; 

    if(isset($_GET['delete'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_orders WHERE id_orders = '".$_GET['delete']."'");

        if($delete){
            echo "<script>alert('Orders succesfully deleted');
            window.location='request-orders.php'</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_POST['update'])){
        $update = mysqli_query($conn, "UPDATE tb_orders SET
        payment_status = '".$_POST['status']."'
        WHERE id_orders = '".$_POST['ido']."'");

        if($update){
            header("Location: request-orders.php");
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <h3>Manage Orders</h3>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Numbers</th>
                            <th>Items</th>
                            <th>Order date</th>
                            <th>Payment Status</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_orders ORDER BY id_orders DESC");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                                    $realName = mysqli_query($conn, "SELECT username FROM tb_user WHERE id_user = '".$a['id_user']."'");
                                    $name = mysqli_fetch_assoc($realName);
                            ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td><?= $a['username'] ?> (<?= $name['username'] ?>)</td>
                                <td><?= $a['noTelp'] ?></td>
                                <td>
                                <?php 
                                    $items = explode("/", $a['items']);
                                    array_pop($items);

                                    foreach($items as $item){
                                        echo "- ".$item."<br>";
                                    }   
                                ?>
                                </td>
                                <td><?= $a['order_date'] ?></td>
                                <td align="center">
                                        <form action="" method="POST">
                                        <input type="hidden" name="ido" value="<?= $a['id_orders'] ?>">
                                        <select style="padding: 5px;margin: 5px 0px;border-radius: 5px" name="status">
                                            <option value="">Select Status</option>                                            
                                            <option <?= $a['payment_status'] == 'pending' ? "selected" : '' ?> value="pending">Pending</option>
                                            <option <?= $a['payment_status'] == 'completed' ? "selected" : '' ?> value="completed">Completed</option>
                                        </select>
                                </td>
                                <td align="center">
                                    <input style="border: none; background: none; font-size: 15px; color: blue; cursor: pointer;" type="submit" name="update" value="Update"> ||
                                    </form>
                                    <a onclick="return confirm('Are you sure want delete this orders? [<?= $a['username'] ?>]')" href="?delete=<?= $a['id_orders'] ?>">Delete</a>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td align="center" colspan="7">Not Data Found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>