<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
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
                <h2>Stock Out</h2>
                <a href="add_stock_out.php" class="btn btn-primary mb-3">Add Stock Out</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $sql = "SELECT productout.*, product.ProductName 
                         FROM productout 
                         JOIN product ON productout.ProductCode = product.ProductCode
                         ORDER BY productout.Date DESC";
         $result = mysqli_query($conn, $sql);
         while ($row = mysqli_fetch_assoc($result)) {
             echo "<tr>
                     <td>{$row['ProductName']}</td>
                     <td>{$row['Date']}</td>
                     <td>{$row['Quantity']}</td>
                     <td>{$row['UniquePrice']} RWF</td>
                     <td>{$row['TotalPrice']} RWF</td>
                   </tr>";
         }
                        ?>
                    </tbody>
                </table>
            </div>
