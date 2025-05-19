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
    <title>BERWA SHOP - Add Stock In</title>
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
                <a href="stock_in.php" class="list-group-item list-group-item-action active">Stock In</a>
                <a href="stock_out.php" class="list-group-item list-group-item-action">Stock Out</a>
                <a href="reports.php" class="list-group-item list-group-item-action">Reports</a>
            </div>
        </div>
        <div class="col-md-9">
            <h2>Add Stock In</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <select name="product" class="form-select" required>
                        <option value="">Select Product</option>
                        <?php
                        $sql = "SELECT * FROM product";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['ProductCode']}'>{$row['ProductName']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="price" class="form-control" placeholder="Unit Price (RWF)" required>
                </div>
                <input type="submit" name="add" value="Add Stock In" class="btn btn-success">
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php


if (isset($_POST['add'])) {
    $product = $_POST['product'];
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $quantity * $price;

    $sql = "INSERT INTO productin (ProductCode, Date, Quantity, UniquePrice, TotalPrice) 
            VALUES ('$product', '$date', '$quantity', '$price', '$total')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: stock_in.php");
    } else {
        echo "Failed to add stock in: " . mysqli_error($conn);
    }
}
?>