<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include "conn.php";

$code = $_GET['id'];
$sql = "SELECT * FROM product WHERE ProductCode = '$code'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>BERWA SHOP - Edit Product</title>
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
                <a href="products.php" class="list-group-item list-group-item-action active">Products</a>
                <a href="stock_in.php" class="list-group-item list-group-item-action">Stock In</a>
                <a href="stock_out.php" class="list-group-item list-group-item-action">Stock Out</a>
                <a href="reports.php" class="list-group-item list-group-item-action">Reports</a>
            </div>
        </div>
        <div class="col-md-9">
            <h2>Edit Product</h2>
            <form action="" method="post">
                <input type="hidden" name="code" value="<?php echo $row['ProductCode']; ?>">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" value="<?php echo $row['ProductName']; ?>" required>
                </div>
                <input type="submit" name="edit" value="Update Product" class="btn btn-info">
            </form>
        </div>
    </div>
</div>
</body>
</html>



<?php
include "conn.php";

if (isset($_POST['edit'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];

    $sql = "UPDATE product SET ProductName = '$name' WHERE ProductCode = '$code'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: products.php");
    } else {
        echo "Failed to update product: " . mysqli_error($conn);
    }
}
?>