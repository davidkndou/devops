<?php include "db.php";
if ($_POST) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')");
    header("Location: login.php");
}
?>
<form method="post">
    <input name="name" placeholder="Name"><br>
    <input name="username" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Register</button>
</form>