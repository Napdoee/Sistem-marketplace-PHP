<?php 
    session_start();
    if(isset($_SESSION['login']) == true){
        echo "<script>alert('Anda telah login silahkan logout terlebih dahulu'); window.location='../index.php'</script>";
    }
?>