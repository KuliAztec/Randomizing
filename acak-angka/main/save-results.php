<?php
include '../../koneksyon.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $data['result'];
    $id_user = intval($data['id_user']);

    if ($result && $id_user) {
        $stmt = $conn->prepare("INSERT INTO simpan (id_user, isi) VALUES (?, ?)");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'error' => 'Prepare statement failed: ' . $conn->error]);
            exit();
        }
        $stmt->bind_param("is", $id_user, $result);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Execute failed: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input', 'data' => $data]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>