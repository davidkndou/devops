<?php include "db.php";
if ($_POST) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')");
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="post" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>
        <input name="name" placeholder="Nama Lengkap" class="w-full mb-3 px-4 py-2 border rounded">
        <input name="username" placeholder="Username" class="w-full mb-3 px-4 py-2 border rounded">
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-4 py-2 border rounded">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">Register</button>
        <p class="text-sm mt-3 text-center">Sudah punya akun? <a href="login.php" class="text-blue-500">Login</a></p>
    </form>
</body>
</html>
