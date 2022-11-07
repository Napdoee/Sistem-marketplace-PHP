<?php include "./database/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Category</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <main>
        <div class="section">
            <div class="container-80">
                <h3>Category List</h3>
                <div class="box">
                    <?php 
                        $mysql = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY createAt");
                        if(mysqli_num_rows($mysql) > 0){
                            while($i = mysqli_fetch_array($mysql)){
                    ?>
                    <div class="col-4 my">
                        <div class="category-box mb-10" onclick="window.location='product.php?cate=<?= $i['categoryName'] ?>'">
                            <img width="60px" src="./assets/img/category.png" alt="">
                            <p align="center"><?= $i['categoryName'] ?></p>
                        </div>
                    </div>
                    <?php }} else {?>
                    <p align="center" >404 Not Data Found</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>