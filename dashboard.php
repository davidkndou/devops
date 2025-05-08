<?php
include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full text-center">
        <h1 class="text-2xl font-semibold mb-4">Selamat Datang, <span
                class="text-blue-600"><?= htmlspecialchars($user['name']) ?></span> 👋</h1>
        <ul class="space-y-3">
            <li>
                <a href="products.php" class="block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Kelola
                    Produk</a>
            </li>
            <li>
                <a href="transactions.php"
                    class="block bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Transaksi</a>
            </li>
            <li>
                <a href="logout.php" class="block bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Kevin</a>
            </li>
        </ul>
    </div>
</body>

</html>