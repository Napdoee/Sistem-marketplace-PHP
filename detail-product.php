<?php 
    include "./database/config.php"; 
    
    $mysql = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = '".$_GET['id']."'");
    if(mysqli_num_rows($mysql)){
        $a = mysqli_fetch_assoc($mysql);
    } else {
        header("Location: product.php");
    }

    $rates = mysqli_query($conn, "SELECT COUNT(*) as Rate, SUM(rating) as rating FROM tb_rating WHERE id_produk = '".$_GET['id']."'");
    if(mysqli_num_rows($rates)){
        $rateData = mysqli_fetch_assoc($rates);
        $rate = $rateData['Rate'];
        $stars = $rateData['rating'];
    } else {
        $rate = 0;
        $stars = 0;
    }

    if(isset($_POST['add-rating'])){

        if($_SESSION['level'] != 'user'){
            echo "<script>alert('You must login as customer to use this feature');
            window.location='detail-product.php?id=".$_GET['id']."';</script>";
            return;
        }

        $query = mysqli_query($conn, "INSERT INTO tb_rating SET
        id_produk = '".$_GET['id']."',
        id_user = '".$_SESSION['id']."',
        rating = '".$_POST['ProductRating']."',
        comment = '".$_POST['comment']."'");

        if($query){
            echo "<script>alert('Your rating has been sending!');
            window.location='detail-product.php?id=".$_GET['id']."';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_POST['add-cart'])){

        if($_SESSION['level'] != 'user'){
            echo "<script>alert('You must login as customer to use this feature');
            window.location='detail-product.php?id=".$_GET['id']."';</script>";
            return;
        }

        $totalQty = $a['price']*$_POST['qty'];

        $checkCart = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_produk = '".$a['id_produk']."' AND id_user = '".$_SESSION['id']."'");

        if(mysqli_num_rows($checkCart) > 0){
            echo "<script>alert('This product already added to Cart!');
            window.location='product.php';</script>";
            return;
        }

        $insert = mysqli_query($conn, "INSERT INTO tb_cart SET
        id_produk   = '".$a['id_produk']."',
        id_user     = '".$_SESSION['id']."',
        quantity    = '".$_POST['qty']."',
        total_price = '".$totalQty."'
        ");

        if($insert){
            echo "<script>alert('Succesfully added to Cart!');
            window.location='product.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $a['name'] ?></title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/rating/jquery.rateyo.min.css"/>
    <style>
        .row{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* align-items: center; */
        }
        .col{
            flex: 50%;
            padding: 10px;
            box-sizing: border-box;
            /* border: solid; */
        }
    </style>
</head>
<body>
    <?php include "./partials/navbar.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="box">
                    <div class="row">
                        <div class="col">
                            <div class="product-img">
                                <img draggable=false src="./assets/product/<?= $a['image']?>" alt="<?= "image_".$a['name'] ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="head-content">
                                <div class="head-title">
                                    <?= $a['name'] ?>
                                    <div class="product-price">Rp. <?= number_format($a['price']) ?></div>
                                </div>
                                <?php if($_SESSION['level'] == 'user') :?>
                                <form action="" method="POST">
                                    <input type="hidden" name="pid" value="<?= $a['id_produk'] ?>">
                                    <input type="hidden" name="name" value="<?= $a['name'] ?>">
                                    <input type="hidden" name="price" value="<?= $a['price'] ?>">
                                    <input type="hidden" name="img" value="<?= $a['image'] ?>">
                                    <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2" required>
                                    <button class="btn-cart" name="add-cart" type="submiit"><i class="fas fa-shopping-cart" aria-hidden="true"> +</i></button>
                                </form>
                                <?php endif; ?>
                            </div>
                            <div class="product-desc">
                                <br><p class="desc-title">Description: </p>
                                <?= $a['description'] ?>
                            </div>
                        </div>
                        <div class="col">                
                            <hr class="line">
                            <div class="row" style="display: flex;align-items: center;">
                                <div style="display: flex;">
                                    <div class="RateProduk" data-rateyo-num-stars="5" data-rateyo-rating="<?= $stars ?>"></div>                                
                                    <div style="font-size: 18px; margin-top: 3px;"><?= $stars ?> RATING</div>
                                </div>                            
                                <?php if($_SESSION['level'] == 'user') :?>
                                <div>
                                    <a style="margin-top: 5px;" id="ModalBtn" class="btn-title">Rate this product</a>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="box">
                    <div>
                        <h3>REVIEWS</h3>
                        <p><?= $rate ?> Reviews</p>
                        <hr class="line">
                    </div>
                    <?php 
                        $RatingData = mysqli_query($conn, "SELECT * FROM tb_rating r, tb_user u WHERE r.id_user = u.id_user AND r.id_produk = '".$_GET['id']."'");

                        if(mysqli_num_rows($RatingData) > 0){
                            while($rating = mysqli_fetch_array($RatingData)){ 
                    ?>
                    <div style="margin: 5px 0px; padding:5px;">
                        <h4><?= $rating['username'] ?></h4>
                        <div class="rateyo form-input" style="background: none;"
                        data-rating="<?= $rating['rating'] ?>"
                        data-rateyo-num-stars="5"><?= $rating['rating'] ?></div>
                        <p><?= $rating['comment'] ?></p>
                    </div>
                    <hr class="line">
                    <?php } } else {?>
                        <h3 align="center">No review yet</h3>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal" id="myModal">
                <div class="modal-content">
                    <div class="container">
                        <div class="head-content">
                            <div class="head-title">Rate this product</div>
                            <span class="close">&times;</span>
                        </div>
                        <form action="" method="post" autocomplete="off">
                            <label for="name">Rating (<span class='result'>0</span>)</label>
                            <input type="hidden" name="ProductRating">
                            <div class="input-rating form-input" style="background: none;"></div>
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-input" rows="5" style="resize: vertical;" required></textarea>
                            <input type="submit" name="add-rating" value="Submit rating" class="form-submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="./styles/modal.js"></script>
    </main>
    <script type="text/javascript" src="./styles/rating/jquery.min.js"></script>
    <script type="text/javascript" src="./styles/rating/jquery.rateyo.js"></script>
    <script>
         $(function () {

            $(".input-rating").rateYo({
                rating: 0.0, 
                numStars: 5,
                starWidth: "25px",
                halfStar: true,
                minValue: 0.5,
                spacing: "5px"
            }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.result').text(rating);
            $(this).parent().find('input[name=ProductRating]').val(rating);
            }); 

            $(".RateProduk").rateYo({
                starWidth: "25px",
                halfStar: true,
                spacing   : "5px",
                readOnly: true
            })

            $(".rateyo").each( function() {
                var rating = $(this).attr("data-rating");
                $(this).rateYo({
                    rating: rating,
                    starWidth: "20px",
                    spacing: "5px",
                    fullStar: true,
                    readOnly: true
                });
            });
         });
    </script>
</body>
</html>