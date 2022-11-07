<?php 
    if($_SESSION['level'] == 'admin'){
        echo "<script>alert('You must login as seller to enter this page !');window.location='../moderator/index.php'</script>";
        return;
    } else if($_SESSION['level'] != "seller"){
        header("Location: ../index.php");
        exit();
    }
?>