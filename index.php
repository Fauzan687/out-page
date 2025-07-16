<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = json_decode(file_get_contents('users.json'), true);

    foreach ($data as $user) {
        if ($user['username'] == $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: home.php');
            exit;
        }
    }
    $error = "Username atau password salah!";
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div class="message">
        <p>Belum punya akun? <a href="register.php">Register di sini</a></p>
    </div>
</div>
