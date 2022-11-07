<?php 
    include "../database/config.php";

    $level = $_GET['lvl'];

    if(isset($_POST['login-submit'])){
        $nm     = mysqli_real_escape_string($conn, $_POST['name']);
        $pass   = mysqli_real_escape_string($conn, $_POST['pass']);

        if($level == 'user'){
            $sql = "SELECT * FROM tb_user WHERE email = '".$nm."' AND password = '".MD5($pass)."'";
        } else {
            $sql = "SELECT * FROM tb_$level WHERE username = '".$nm."' AND password = '".MD5($pass)."'";
        }

        $result = mysqli_query($conn, $sql);
        $data   = mysqli_fetch_assoc($result);

        if($level == 'seller' && $data['status'] != 1){
            echo "<script>alert('Your account has not been verified');window.location='../seller.php';</script>";
            return;
        }

        if(mysqli_num_rows($result) > 0){
            $_SESSION['login'] = true;
            $_SESSION['level'] = $level;
            $_SESSION['name']  = $data['username'];
            $_SESSION['id']    = $data["id_$level"];
            
            echo "<script>alert('Anda berhasil login sebagai $level');</script>";

            switch($level){
                case 'user':
                    echo "<script>window.location='../index.php'</script>";
                    break;
                case 'seller':
                    echo "<script>window.location='../seller/index.php'</script>";
                    break;
                case 'admin':
                    echo "<script>window.location='../moderator/index.php'</script>";
                    break;
            }

        } else {
            echo "<script>alert('Terjadi kesalahan pada username dan password anda');
            window.location='login-$level.php'</script>";
        }
    }
?>