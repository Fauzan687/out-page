<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = json_decode(file_get_contents('users.json'), true);

    foreach ($data as $user) {
        if ($user['username'] == $username) {
            $error = "Username sudah digunakan!";
            break;
        }
    }

    if (!isset($error)) {
        $data[] = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        file_put_contents('users.json', json_encode($data, JSON_PRETTY_PRINT));
        $success = "Pendaftaran berhasil. <a href='index.php'>Login sekarang</a>";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Daftar</h2>
    <?php 
    if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>";
    if (isset($success)) echo "<p style='color:green; text-align:center;'>$success</p>";
    ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>
    <div class="message">
        <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
    </div>
</div>
