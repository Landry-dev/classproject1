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