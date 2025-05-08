<?php
include "db.php";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 shadow-md rounded-lg w-full max-w-4xl">
        <!-- Form Transaksi Baru -->
        <h3 class="text-2xl font-semibold mb-6">Transaksi Baru</h3>
        <form method="post" class="space-y-4 mb-8">
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                <select name="product_id" id="product_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                    required>
                    <?php while ($p = $products->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['name'] ?> (stok: <?= $p['stock'] ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input name="quantity" type="number" id="quantity" placeholder="Jumlah"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Bayar</button>
        </form>

        <!-- Riwayat Transaksi -->
        <h3 class="text-2xl font-semibold mb-4">Riwayat Transaksi</h3>
        <table class="min-w-full table-auto mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Produk</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($t = $history->fetch_assoc()): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?= $t['name'] ?></td>
                        <td class="px-4 py-2"><?= $t['quantity'] ?></td>
                        <td class="px-4 py-2"><?= $t['total_price'] ?></td>
                        <td class="px-4 py-2"><?= $t['created_at'] ?></td>
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
<?php
include "db.php";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 shadow-md rounded-lg w-full max-w-4xl">
        <!-- Form Transaksi Baru -->
        <h3 class="text-2xl font-semibold mb-6">Transaksi Baru</h3>
        <form method="post" class="space-y-4 mb-8">
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                <select name="product_id" id="product_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                    required>
                    <?php while ($p = $products->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['name'] ?> (stok: <?= $p['stock'] ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input name="quantity" type="number" id="quantity" placeholder="Jumlah"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Bayar</button>
        </form>

        <!-- Riwayat Transaksi -->
        <h3 class="text-2xl font-semibold mb-4">Riwayat Transaksi</h3>
        <table class="min-w-full table-auto mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Produk</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($t = $history->fetch_assoc()): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?= $t['name'] ?></td>
                        <td class="px-4 py-2"><?= $t['quantity'] ?></td>
                        <td class="px-4 py-2"><?= $t['total_price'] ?></td>
                        <td class="px-4 py-2"><?= $t['created_at'] ?></td>
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