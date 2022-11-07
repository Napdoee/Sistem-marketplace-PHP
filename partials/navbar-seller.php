<nav class="seller">
        <a href="../seller/index.php" class="logo">Panel Seller</a>
        <ul>
            <li><a href="manage-product.php">Data Product</a></li>
            <li><a href="orders.php">Orders</a></li>
            <?php if(!isset($_SESSION['login'])) {?>
            <div class="dropdown">
                <li><a class="btn-log" class="dropbtn">Login</a></li>
                <div class="dropdown-content">
                    <a href="./login/login-seller.php">Seller</a>
                    <a href="./login/login-user.php">Customer</a>
                </div>
            </div>
            <?php } else {?>
            <li><a class="btn-log" href="../logout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </nav>