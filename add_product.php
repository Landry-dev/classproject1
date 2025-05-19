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
                <h2>Add Product</h2>
                <form  method="POST">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="add" class="btn btn-primary mt-3" value="Add Product">
                    </div>
                </form>
            </div>
            </div>
</div>


</body>
</html>

<?php

include "conn.php";
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $sql = "INSERT INTO product (ProductCode ,ProductName) VALUES ('','$name')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: products.php");
    } else {
        echo "<script>alert('Failed to add product!');</script>";
    }
}