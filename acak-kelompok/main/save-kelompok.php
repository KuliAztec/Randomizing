<?php

include '../../koneksyon.php';

session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../autentikasi/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $_POST['result'];
    $id_user = $_SESSION['id_user'];

    $stmt = $conn->prepare("INSERT INTO simpan (id_user, isi) VALUES (?, ?)");
    $stmt->bind_param("is", $id_user, $result);

    if ($stmt->execute()) {
        // Create a blob with the result and trigger download
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="hasil_kelompok.json"');
        echo $result;
    } else {
        echo "Terjadi kesalahan saat menyimpan hasil.";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: kelompok.php");
    exit();
}
?>