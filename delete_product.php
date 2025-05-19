<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include "conn.php";

$code = $_GET['id'];
$sql = "DELETE FROM product WHERE ProductCode = '$code'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: products.php");
} else {
    echo "Failed to delete product: " . mysqli_error($conn);
}
?>