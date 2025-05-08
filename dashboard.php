<?php
include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">
            Selamat datang, <?= htmlspecialchars($_SESSION['user']['name']) ?>
        </h1>
        <ul class="space-y-3">
            <li>
                <a href="books.php"
                    class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded">
                    📚 Kelola Buku
                </a>
            </li>
            <li>
                <a href="loans.php"
                    class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded">
                    📖 Peminjaman Buku
                </a>
            </li>
            <li>
                <a href="logout.php"
                    class="block w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded">
                    🚪 Logout
                </a>
            </li>
        </ul>
    </div>
</body>

</html>