<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../autentikasi/login.php");
    exit();
}
// ...existing code...
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ...existing code... -->
</head>
<body>
  <!-- ...existing code... -->
</body>
</html>