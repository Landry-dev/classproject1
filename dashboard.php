<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">BERWA SHOP</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Welcome, <?php echo $_SESSION['username']?></span>
                <a href="logout.php" class="nav-link">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="dashboard.php" class="list-group-item list-group-item-action actice">Dashboard</a>
                    <a href="products.php" class="list-group-item list-group-item-action actice">Products</a>
                    <a href="stock_in.php" class="list-group-item list-group-item-action actice">Stock_in</a>
                    <a href="stock_out.php" class="list-group-item list-group-item-action actice">Stock_out</a>
                    <a href="reports.php" class="list-group-item list-group-item-action actice">Reports</a>
                </div>
            </div>

       

            <div class="col-md-9">
                <h2>Dashboard</h2>
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <?php
                                $sql = "SELECT COUNT(*) as total FROM product";
                                $result = mysqli_query($conn, $sql);
                                if(!$result){
                                    echo "Error: unable to load product count";
                                }
                                $row = mysqli_fetch_assoc($result);
                                echo "<h3>" . $row['total'] . "</h3>";
                                
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Stock Value</h5>
                                <?php
                                $sql = "SELECT SUM(TotalPrice) as total FROM productin";
                                $result = mysqli_query($conn, $sql);
                                if(!$result)
                                $row = mysqli_fetch_assoc($result);
                                echo "<h3>" . number_format($row['total']) . " RWF</h3>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>