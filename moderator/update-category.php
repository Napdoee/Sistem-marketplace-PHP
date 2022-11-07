<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php";

    if(isset($_GET['id'])){
        $mysql = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category = '".$_GET['id']."'");

        if(mysqli_num_rows($mysql)){
            $a = mysqli_fetch_assoc($mysql);
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Category</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <h3>Update Data Category</h3><br>
                    <a href="manage-category.php" class="head-link">< Kembali</a>
                </div>
                <div class="box">
                    <form action="" method="post" autocomplete="off">
                        <label for="name">Category</label>
                        <input type="text" name="name" id="name" placeholder="Category Name" class="form-input" value="<?= $a['categoryName'] ?>" required>
                        <input type="submit" name="update-category" value="Update Data" class="form-submit admin">
                    </form>
                    <?php 
                        if(isset($_POST['update-category'])){
                            $mysql = mysqli_query($conn, "UPDATE tb_category SET categoryName = '".$_POST['name']."' WHERE id_category = '".$a['id_category']."'");

                            if($mysql){
                                echo "<script>alert('Category update succesfully');window.location='manage-category.php'</script>";
                            } else {
                                echo "There was error: ".mysqli_error($conn);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>