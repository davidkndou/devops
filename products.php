<?php include "db.php";
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
<h3>Produk</h3>
<form method="post">
    <input name="name" placeholder="Nama">
    <input name="price" placeholder="Harga">
    <input name="stock" placeholder="Stok">
    <button name="add">Tambah</button>
</form>
<table border="1">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['stock'] ?></td>
            <td><a href="?delete=<?= $row['id'] ?>">Hapus</a></td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">← Kembali</a>