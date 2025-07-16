<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>
    <p style="text-align:center;">Ini adalah halaman home setelah login berhasil.</p>
    <div class="message">
        <a href="logout.php">Logout</a>
    </div>
</div>
