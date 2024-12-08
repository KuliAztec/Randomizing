<?php

include '../../koneksyon.php';

session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../autentikasi/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $data['result'];
    $id_user = $_SESSION['id_user'];

    $stmt = $conn->prepare("INSERT INTO simpan (id_user, isi) VALUES (?, ?)");
    $stmt->bind_param("is", $id_user, $result);

    if ($stmt->execute()) {
        // Return the result as plain text for download
        header('Content-Type: text/plain');
        echo $result;
    } else {
        echo "Terjadi kesalahan saat menyimpan hasil.";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: peran.php");
    exit();
}
?>