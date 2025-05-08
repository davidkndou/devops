<?php
$conn = new mysqli("localhost", "root", "Katasandi00_", "kasir_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>