<?php include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");
echo "Selamat datang, " . $_SESSION['user']['name'];
?>
<ul>
    <li><a href="books.php">Kelola Buku</a></li>
    <li><a href="loans.php">Peminjaman Buku</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>