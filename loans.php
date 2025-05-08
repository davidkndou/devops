<?php include "db.php";
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
<h3>Peminjaman Buku</h3>
<form method="post">
    <select name="book_id">
        <?php while ($b = $books->fetch_assoc()): ?>
            <option value="<?= $b['id'] ?>"><?= $b['title'] ?> (stok: <?= $b['stock'] ?>)</option>
        <?php endwhile; ?>
    </select>
    <button>Pinjam</button>
</form>
<h3>Riwayat Peminjaman</h3>
<table border="1">
    <tr>
        <th>Judul</th>
        <th>Tanggal Pinjam</th>
        <th>Harus Kembali</th>
    </tr>
    <?php while ($l = $loans->fetch_assoc()): ?>
        <tr>
            <td><?= $l['title'] ?></td>
            <td><?= $l['loan_date'] ?></td>
            <td><?= $l['return_date'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">← Kembali</a>