<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../autentikasi/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acak Angka</title>
  <link rel="stylesheet" href="style-angka.css">
</head>
<body>
  <header class="text-center">
    <h1>Acak Angka</h1>
  </header>
  <main>
    <form id="input-form">
      <div class="form-group">
        <label for="start">Batas Bawah:</label>
        <input type="number" id="start" name="start" min="0">
      </div>
      <div class="form-group">
        <label for="end">Batas Atas:</label>
        <input type="number" id="end" name="end" min="0">
      </div>
      <div class="form-group">
        <label for="amount">Jumlah Angka:</label>
        <input type="number" id="amount" name="amount" min="1">
      </div>
      <div class="form-group">
        <button type="button" id="randomize-btn">Acak</button>
        <button type="button" id="reset-btn">Reset</button>
      </div>
    </form>
    <div id="results"></div>
    <div class="form-group" style="margin-top: 20px;">
      <button type="button" id="save-btn">Unduh Hasil</button>
      <button type="button" onclick="window.location.href='../../app.php'">Kembali</button>
    </div>
  </main>
  <script src="script-angka.js"></script>
</body>
</html>