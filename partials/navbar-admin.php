<nav class="admin">
        <a href="../moderator/index.php" class="logo">Simple Logo</a>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <div class="dropdown">
                <li><a class="dropbtn">Data</a></li>
                <div class="dropdown-content admin">
                    <a href="manage-category.php">Data Category</a>
                    <a href="manage-product.php">Data Product</a>
                    <a href="manage-orders.php">Data Orders</a>
                    <a href="manage-seller.php">Data Seller</a>
                    <a href="manage-user.php">Data Customer</a>
                </div>
            </div>
            <div class="dropdown">
                <li><a class="dropbtn">Request</a></li>
                <div class="dropdown-content admin">
                    <?php 
                        $produk = mysqli_query($conn, "SELECT COUNT(id_produk) AS JumlahProduk FROM tb_produk WHERE status = 0");
                        $dataProduk = mysqli_fetch_assoc($produk);

                        $seller = mysqli_query($conn, "SELECT COUNT(id_seller) AS JumlahSeller FROM tb_seller WHERE status = 0");
                        $dataSeller = mysqli_fetch_assoc($seller);

                        // $order = mysqli_query($conn, "SELECT COUNT(id_orders) as JumlahOrders FROM tb_orders");
                        // $dataOrder = mysqli_fetch_assoc($order);
                    ?>
                    <a href="request-product.php">Request Product <?= "[".$dataProduk['JumlahProduk']."]" ?></a>
                    <a href="request-seller.php">Request Seller <?= "[".$dataSeller['JumlahSeller']."]" ?></a>
                </div>
            </div>
        </ul>
    </nav>