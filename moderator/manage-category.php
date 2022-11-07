<?php 
    include "../database/config.php"; 
    include "../partials/admin-only.php"; 
    
    if(isset($_POST['add-category'])){
        $mysql = mysqli_query($conn, "INSERT INTO tb_category SET categoryName = '".$_POST['name']."'");

        if($mysql){
            echo "<script>alert('Category succesfully added');window.location='manage-category.php'</script>";
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }

    if(isset($_GET['delete'])){
        $enable = mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0;");
        $delete = mysqli_query($conn, "DELETE c.*, p.* FROM tb_category c, tb_produk p 
        WHERE c.id_category = p.id_category AND c.id_category = '".$_GET['delete']."';");

        if($enable AND $delete){
            echo "<script>alert('Category succesfully deleted');window.location='manage-category.php'</script>";
            $disable = mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1;");
        } else {
            echo "There was error: ".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Category</title>
</head>
<body>
    <?php include "../partials/navbar-admin.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="head-content">
                    <div class="head-title">Data Category</div>
                    <a id="ModalBtn" class="head-link">Tambah Category +</a>
                </div>
                <div class="box">
                    <table border="1" cellspacing="0" class="table-data">
                        <thead>
                            <th width="5%">No</th>
                            <th>Category</th>
                            <th width="15%">Action</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $mysql = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY createAt DESC;");
                                if(mysqli_num_rows($mysql)){
                                    while($a = mysqli_fetch_array($mysql)){
                            ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td><?= $a['categoryName'] ?></td>
                                <td align="center">
                                    <a href="update-category.php?id=<?= $a['id_category'] ?>">Update</a> ||
                                    <a onclick="return confirm('Are you sure want delete this category? [<?= $a['categoryName'] ?>]')" href="manage-category.php?delete=<?= $a['id_category'] ?>">Delete</a>
                                </td>
                            </tr>
                            <?php }} else {?>
                            <tr>
                                <td align="center" colspan="7">404 Not Data Found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <div class="container">
        <div class="modal" id="myModal">
            <div class="modal-content">
                <div class="container">
                    <div class="head-content">
                        <div class="head-title">Add Category</div>
                        <span class="close">&times;</span>
                    </div>
                    <form action="" method="post" autocomplete="off">
                        <label for="name">Category</label>
                        <input class="form-input" type="text" name="name" placeholder="Category Name" required>
                        <input type="submit" name="add-category" value="Add Category" class="form-submit admin">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../styles/modal.js"></script>
</body>
</html>