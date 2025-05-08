<?php include "db.php";
if (!isset($_SESSION['user']))
    header("Location: login.php");

if ($_POST) {
    $product_id = $_POST['product_id'];
    $qty = $_POST['quantity'];
    $product = $conn->query("SELECT * FROM products WHERE id=$product_id")->fetch_assoc();
    $total = $product['price'] * $qty;
    $conn->query("INSERT INTO transactions (user_id, product_id, quantity, total_price) 
                  VALUES ({$_SESSION['user']['id']}, $product_id, $qty, $total)");
    $conn->query("UPDATE products SET stock = stock - $qty WHERE id=$product_id");
}

$products = $conn->query("SELECT * FROM products");
$history = $conn->query("SELECT t.*, p.name FROM transactions t JOIN products p ON t.product_id=p.id WHERE t.user_id={$_SESSION['user']['id']}");
?>
<h3>Transaksi Baru</h3>
<form method="post">
    <select name="product_id">
        <?php while ($p = $products->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>"><?= $p['name'] ?> (stok: <?= $p['stock'] ?>)</option>
        <?php endwhile; ?>
    </select>
    <input name="quantity" type="number" placeholder="Jumlah">
    <button>Bayar</button>
</form>

<h3>Riwayat Transaksi</h3>
<table border="1">
    <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Waktu</th>
    </tr>
    <?php while ($t = $history->fetch_assoc()): ?>
        <tr>
            <td><?= $t['name'] ?></td>
            <td><?= $t['quantity'] ?></td>
            <td><?= $t['total_price'] ?></td>
            <td><?= $t['created_at'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">← Kembali</a>