<?php 
    if($_SESSION['level'] != "admin"){
        header("Location: ../index.php");
        exit();
    }
?>