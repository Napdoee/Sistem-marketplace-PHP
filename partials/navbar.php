<nav>
    <?php 
        include "./functions.php";

        $lvl = $_SESSION['level'];

        if($lvl == 'admin'){
            $index = './moderator/index.php';
        } else if($lvl == 'seller'){
            $index = './seller/index.php';
        } else {
            $index = 'index.php';
        }
    ?>
    <a href="<?= $index ?>" class="logo">MarketPlace</a>
    <ul>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? "class='active'" : "" ?> href="index.php">Home</a></li>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'product.php' ? "class='active'" : "" ?> href="product.php">Products</a></li>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'category.php' ? "class='active'" : "" ?> href="category.php">Category</a></li>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'seller.php' ? "class='active'" : "" ?> href="seller.php">Seller</a></li>
        <?php if(isset($_SESSION['login']) && $_SESSION['level'] == 'user') :?>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? "class='active'" : "" ?> href="orders.php">Orders</a></li>
        <?php endif; ?>
    </ul>
    <ul class="nav-icon">
        <?php if(isset($_SESSION['login']) && $_SESSION['level'] == 'user') {
                $result = mysqli_query($conn, "SELECT  COUNT(*) as countCart  FROM tb_cart WHERE id_user = '".$_SESSION['id']."'");
                $data = mysqli_fetch_assoc($result);
                // var_dump($data)
                // echo "SELECT COUNT(id_cart) as countCart FROM tb_cart WHERE id_user = '".$_SESSION['id']."'";
        ?>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'cart.php' ? "class='active'" : "" ?> href="cart.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i> <span style="font-size: 14px; color: #efefef"><?= $data['countCart'] ? $data['countCart'] : '' ?></span></a></li>
        <li><a <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? "class='active'" : "" ?> href="profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
        <?php } ?>
        <?php if(!isset($_SESSION['login'])) {?>
        <li><a href="./login/login-user.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        <?php } else {?>
        <li>
            <a class="btn-log" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </li>
        <?php } ?>
    </ul>
</nav>