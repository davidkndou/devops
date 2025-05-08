<?php
include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");

if ($_POST) {
    $book_id = $_POST['book_id'];
    $today = date('Y-m-d');
    $return = date('Y-m-d', strtotime('+7 days'));
    $conn->query("INSERT INTO loans (user_id, book_id, loan_date, return_date) 
                  VALUES ({$_SESSION['user']['id']}, $book_id, '$today', '$return')");
    $conn->query("UPDATE books SET stock = stock - 1 WHERE id = $book_id");
}

$books = $conn->query("SELECT * FROM books WHERE stock > 0");
$loans = $conn->query("SELECT l.*, b.title FROM loans l JOIN books b ON l.book_id = b.id WHERE l.user_id = {$_SESSION['user']['id']}");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Peminjaman Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">📖 Peminjaman Buku</h1>

        <form method="post" class="mb-6">
            <label class="block mb-2 font-semibold">Pilih Buku:</label>
            <select name="book_id" class="w-full border px-3 py-2 rounded mb-4">
                <?php while ($b = $books->fetch_assoc()): ?>
                    <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['title']) ?> (stok: <?= $b['stock'] ?>)</option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Pinjam</button>
        </form>

        <h2 class="text-xl font-semibold mb-3">📚 Riwayat Peminjaman</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Tanggal Pinjam</th>
                    <th class="border px-4 py-2 text-left">Harus Kembali</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($l = $loans->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2"><?= htmlspecialchars($l['title']) ?></td>
                        <td class="border px-4 py-2"><?= $l['loan_date'] ?></td>
                        <td class="border px-4 py-2"><?= $l['return_date'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="inline-block mt-6 text-blue-600 hover:underline">← Kembali ke Dashboard</a>
    </div>
</body>

</html>