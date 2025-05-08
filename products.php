<?php
include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");

// CRUD
if (isset($_POST['add'])) {
    $conn->query("INSERT INTO products (name, price, stock) VALUES ('{$_POST['name']}', {$_POST['price']}, {$_POST['stock']})");
}
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM products WHERE id={$_GET['delete']}");
}

$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 shadow-md rounded-lg w-full max-w-4xl">
        <h3 class="text-2xl font-semibold mb-6">Kelola Produk</h3>
        <!-- Form Tambah Produk -->
        <form method="post" class="space-y-4 mb-8">
            <div class="flex space-x-4">
                <input name="name" placeholder="Nama Produk" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                    required>
                <input name="price" type="number" placeholder="Harga Produk"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                <input name="stock" type="number" placeholder="Stok Produk"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>
            <button name="add" class="w-full py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Tambah
                Produk</button>
        </form>

        <!-- Tabel Produk -->
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Nama Produk</th>
                    <th class="px-4 py-2 text-left">Harga</th>
                    <th class="px-4 py-2 text-left">Stok</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?= $row['name'] ?></td>
                        <td class="px-4 py-2"><?= $row['price'] ?></td>
                        <td class="px-4 py-2"><?= $row['stock'] ?></td>
                        <td class="px-4 py-2">
                            <a href="?delete=<?= $row['id'] ?>" class="text-red-500 hover:text-red-600">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="mt-4">
            <a href="dashboard.php" class="text-blue-500 hover:text-blue-600">← Kembali ke Dashboard</a>
        </div>
    </div>
</body>

</html>