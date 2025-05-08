<?php include "db.php";
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
<h3>Daftar Buku</h3>
<form method="post">
    <input name="title" placeholder="Judul">
    <input name="author" placeholder="Penulis">
    <input name="stock" placeholder="Stok" type="number">
    <button name="add">Tambah</button>
</form>
<table border="1">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php while ($b = $books->fetch_assoc()): ?>
        <tr>
            <td><?= $b['title'] ?></td>
            <td><?= $b['author'] ?></td>
            <td><?= $b['stock'] ?></td>
            <td><a href="?delete=<?= $b['id'] ?>">Hapus</a></td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">← Kembali</a>