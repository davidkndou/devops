<?php include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");
echo "Selamat datang, " . $_SESSION['user']['name'];
?>
<ul>
    <li><a href="products.php">Kelola Produk</a></li>
    <li><a href="transactions.php">Transaksi</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>