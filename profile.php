<?php
include 'koneksyon.php'; // Menyertakan file config.php untuk koneksi database

session_start(); // Memulai sesi

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: autentikasi/login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Mengambil data pengguna dari database
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan data pengguna
    $row = $result->fetch_assoc();
    echo "<h1>Profil Pengguna</h1>";
    echo "<p>Email: " . $row['email'] . "</p>";
} else {
    echo "Data pengguna tidak ditemukan.";
}

$conn->close(); // Menutup koneksi
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <a href="app.php">Beranda</a>
    <a href="autentikasi/logout.php">Logout</a>
</body>
</html>