<?php
include "db.php";
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="post" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-4 text-center">Masuk</h2>

        <?php if (isset($error)): ?>
            <p class="text-red-500 text-sm mb-3 text-center"><?= $error ?></p>
        <?php endif; ?>

        <input name="username" placeholder="Username" class="w-full mb-3 px-4 py-2 border rounded">
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-4 py-2 border rounded">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded">Login</button>
        <p class="text-sm mt-3 text-center">Belum punya akun? <a href="register.php" class="text-blue-500">Daftar</a>
        </p>
    </form>
</body>

</html>