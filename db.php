<?php
session_start();
$conn = new mysqli("localhost", "root", "Kelompok7_", "peminjaman_buku");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>