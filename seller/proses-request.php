<?php 
    include "../database/config.php";

    if(isset($_POST['request'])){
        $name   = $_POST['name'];
        $cate   = $_POST['category'];
        $desc   = $_POST['desc'];
        $price  = $_POST['price'];
        $id     = $_SESSION['id'];

        $fileImg = $_FILES['img'];
        $typeImg = explode('.', $fileImg['name']);
        $image   = "product".time().'.'.$typeImg[1];

        $mysql = mysqli_query($conn, "INSERT INTO tb_produk SET
        id_seller   = '".$id."',
        id_category = '".$cate."',
        name        = '".$name."', 
        description = '".$desc."',
        price       = '".$price."',
        image       = '".$image."',
        status      = 0
        ");

        if($mysql){
            move_uploaded_file($fileImg['tmp_name'], '../assets/product/'.$image);
            echo "<script>alert('Succesfully request product to admin'); window.location='index.php';</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>