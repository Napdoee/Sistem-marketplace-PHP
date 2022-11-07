<link rel="icon" type="image/x-icon" href="../assets/img/favicon.png">
<?php 
    session_start();
    error_reporting(0);
    include "../partials/links.php";

    $conn = mysqli_connect("localhost", "root", "", "online_shop");

    if(!$conn){
        die("Tidak dapat terhubung ke database");
    }
?>