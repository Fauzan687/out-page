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
        if (strlen($password)< 8){
            $error = "password minimal 8 karakter!";
        } elseif (!preg_match("/[A-Z]/",$password)){
            $error = "password harus mengandung huruf besar!";
        } elseif (!preg_match("/[a-z]/", $password)) {
            $error = "password harus mengandung huruf kecil!";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $error = "password harus mengandung angka!";
        } elseif (!preg_match("/[\W]/", $password)) {
            $error = "password harus mengandung simbol (misal ! @ # ?)";
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
    <h2>Register</h2>
    <?php 
    if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>";
    if (isset($success)) echo "<p style='color:green; text-align:center;'>$success</p>";
    ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <div class="message">
        <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
    </div>
</div>
