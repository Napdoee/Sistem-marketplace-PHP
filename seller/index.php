<?php 
    include "../database/config.php"; 
    include "../partials/seller-only.php";                         
    include_once "../partials/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MarketPlace</title>
    <script src="../styles/charts/Chart.bundle.js"></script>
</head>
<body>
    <?php include "../partials/navbar-seller.php" ?>
    <main>
        <div class="section">
            <div class="container">
                <div class="box">
                    <h3>Welcome Back <?= $_SESSION['name'] ?></h3>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="col-2">
                    <?php 
                        $dp = query("SELECT COUNT(id_produk) as JumlahProduk 
                        FROM tb_produk WHERE id_seller = '".$_SESSION['id']."'")[0];
    
                        $do = query("SELECT SUM(total_price) as TotalPrice, COUNT(id_orders) as JumlahOrder
                        ,(SELECT COUNT(id_orders) FROM tb_orders WHERE payment_status = 'pending' AND id_seller = '".$_SESSION['id']."') as TotalPending
                        ,(SELECT SUM(total_price) FROM tb_orders WHERE payment_status = 'completed' AND id_seller = '".$_SESSION['id']."') as PriceCompleted
                        ,(SELECT COUNT(id_orders) FROM tb_orders WHERE payment_status = 'completed' AND id_seller = '".$_SESSION['id']."') as TotalCompleted
                        FROM tb_orders WHERE id_seller = '".$_SESSION['id']."'")[0];
                    ?>
                    <h3>Configuration</h3>
                    <div class="box">
                        <div class="card not-hover">  
                            <div class="card-stacked">
                                <div class="card-content mlr-5">
                                    <div class="card-title">
                                        <h2>Total Product</h2>
                                    </div>
                                    <h3 style="color: #777"><?= $dp['JumlahProduk'] ?> Items</h3>
                                </div>
                                <button onclick="window.location='manage-product.php'" class="btn-100 seller">
                                    See Products
                                </button>
                            </div>
                        </div>
                        <div class="card not-hover">  
                            <div class="card-stacked">
                                <div class="card-content mlr-5">
                                    <div class="card-title">
                                        <h2>Total Orders</h2>
                                    </div>
                                    <h3 style="color: #777"><?= $do['TotalPending'] ?> -/ <?= $do['JumlahOrder']?></h3>
                                </div>
                                <button onclick="window.location='orders.php'" class="btn-100 seller">
                                    See Orders
                                </button>
                            </div>
                        </div>
                        <div class="card not-hover">  
                            <div class="card-stacked">
                                <div class="card-content mlr-5">
                                    <div class="card-title">
                                        <h2>Your Salary</h2>
                                    </div>
                                    <h3 style="color: #777"><?= $do['TotalCompleted'] ?> - Rp. <?= number_format($do['PriceCompleted']) ?></h3>
                                </div>
                                <button onclick="window.location='orders.php'" class="btn-100 seller">
                                    See Orders
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <h3>Total product sales</h3>
                    <div class="box">
                        <canvas id="product" height="161px"></canvas>
                    </div>
                    <?php 
                        $items = query("SELECT items FROM tb_orders WHERE id_seller = '".$_SESSION['id']."' AND  payment_status = 'completed'");
                        $itemArrays = [];
    
                        foreach($items as $row){
                            $itemArrays[] = $row['items'];
                        } 
    
                        $item = implode("", $itemArrays);
                        $seperateItems = explode("/", $item);
                        $replItems = str_replace(array('(', ')'), '', $seperateItems);

                        $productName = [];
                        $totalProduct = [];
                        for($i = 0; $i < count($replItems); $i++){
                            $otherItems = explode(" ", $replItems[$i]);
    
                            $productName[] = current($otherItems);
                            $totalProduct[] = end($otherItems);
                        }
                        
                        $total = implode(", ", $totalProduct);
    
                        // var_dump($productName);
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script>
        var ctx = document.getElementById("product");
        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [ <?php for($i = 0; $i < count($productName) - 1; $i++ ){ echo "'$productName[$i]', "; }  ?> ],
                datasets: [{
                    label: 'Total Sales',
                    data: [ <?= $total ?> ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(130, 174, 213, 0.2)',
                        'rgba(87, 67, 43, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(130, 174, 213, 1)',
                        'rgba(87, 67, 43, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })
    </script>
</body>
</html>