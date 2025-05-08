<?php
include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");

if (isset($_POST['add'])) {
    $conn->query("INSERT INTO books (title, author, stock) VALUES ('{$_POST['title']}', '{$_POST['author']}', {$_POST['stock']})");
}
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM books WHERE id={$_GET['delete']}");
}

$books = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded p-6">
        <h1 class="text-2xl font-bold mb-4">📚 Daftar Buku</h1>

        <form method="post" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input name="title" placeholder="Judul" required class="border px-3 py-2 rounded w-full">
            <input name="author" placeholder="Penulis" required class="border px-3 py-2 rounded w-full">
            <input name="stock" type="number" placeholder="Stok" required class="border px-3 py-2 rounded w-full">
            <button name="add" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600">Tambah</button>
        </form>

        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Penulis</th>
                    <th class="border px-4 py-2 text-left">Stok</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($b = $books->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2"><?= htmlspecialchars($b['title']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($b['author']) ?></td>
                        <td class="border px-4 py-2"><?= $b['stock'] ?></td>
                        <td class="border px-4 py-2">
                            <a href="?delete=<?= $b['id'] ?>" class="text-red-500 hover:underline">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="inline-block mt-6 text-blue-600 hover:underline">← Kembali ke Dashboard</a>
    </div>
</body>

</html>