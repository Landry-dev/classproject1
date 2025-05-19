<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include "conn.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>BERWA SHOP - Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">BERWA SHOP</a>
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">Welcome, <?php echo $_SESSION['username']; ?></span>
            <a class="nav-link" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="products.php" class="list-group-item list-group-item-action">Products</a>
                <a href="stock_in.php" class="list-group-item list-group-item-action">Stock In</a>
                <a href="stock_out.php" class="list-group-item list-group-item-action">Stock Out</a>
                <a href="reports.php" class="list-group-item list-group-item-action active">Reports</a>
            </div>
        </div>
        <div class="col-md-9">
            <h2>Reports</h2>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Stock Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total In</th>
                                <th>Total Out</th>
                                <th>Current Stock</th>
                                <th>Total Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT p.ProductName, 
                                    COALESCE(SUM(pi.Quantity), 0) as TotalIn,
                                    COALESCE(SUM(po.Quantity), 0) as TotalOut,
                                    COALESCE(SUM(pi.Quantity), 0) - COALESCE(SUM(po.Quantity), 0) as CurrentStock,
                                    (COALESCE(SUM(pi.Quantity), 0) - COALESCE(SUM(po.Quantity), 0)) * COALESCE(pi.UniquePrice, 0) as StockValue
                                    FROM product p
                                    LEFT JOIN productin pi ON p.ProductCode = pi.ProductCode
                                    LEFT JOIN productout po ON p.ProductCode = po.ProductCode
                                    GROUP BY p.ProductCode";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>{$row['ProductName']}</td>
                                        <td>{$row['TotalIn']}</td>
                                        <td>{$row['TotalOut']}</td>
                                        <td>{$row['CurrentStock']}</td>
                                        <td>{$row['StockValue']} RWF</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4>Daily Summary</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="date" name="report_date" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                            </div>
                        </div>
                    </form>
                    
                    <?php
                    if (isset($_POST['generate'])) {
                        $date = $_POST['report_date'];
                        
                        echo "<h5>Report for: $date</h5>";
                        
                        // Stock In for the day
                        $sql_in = "SELECT p.ProductName, pi.Quantity, pi.UniquePrice, pi.TotalPrice
                                  FROM productin pi
                                  JOIN product p ON pi.ProductCode = p.ProductCode
                                  WHERE pi.Date = '$date'";
                        $result_in = mysqli_query($conn, $sql_in);
                        
                        if (mysqli_num_rows($result_in) > 0) {
                            echo "<h6 class='mt-3'>Stock In</h6>";
                            echo "<table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($row_in = mysqli_fetch_assoc($result_in)) {
                                echo "<tr>
                                        <td>{$row_in['ProductName']}</td>
                                        <td>{$row_in['Quantity']}</td>
                                        <td>{$row_in['UniquePrice']} RWF</td>
                                        <td>{$row_in['TotalPrice']} RWF</td>
                                      </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No stock in records for this date.</p>";
                        }
                        
                        // Stock Out for the day
                        $sql_out = "SELECT p.ProductName, po.Quantity, po.UniquePrice, po.TotalPrice
                                   FROM productout po
                                   JOIN product p ON po.ProductCode = p.ProductCode
                                   WHERE po.Date = '$date'";
                        $result_out = mysqli_query($conn, $sql_out);
                        
                        if (mysqli_num_rows($result_out) > 0) {
                            echo "<h6 class='mt-3'>Stock Out</h6>";
                            echo "<table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($row_out = mysqli_fetch_assoc($result_out)) {
                                echo "<tr>
                                        <td>{$row_out['ProductName']}</td>
                                        <td>{$row_out['Quantity']}</td>
                                        <td>{$row_out['UniquePrice']} RWF</td>
                                        <td>{$row_out['TotalPrice']} RWF</td>
                                      </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No stock out records for this date.</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>