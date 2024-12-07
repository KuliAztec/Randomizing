<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../autentikasi/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Acak Jabatan</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Acak Peran</h1>
  <div class="input-container">
    <label for="name-list">Daftar Nama:</label>
    <textarea id="name-list" rows="10" placeholder="Masukkan nama peserta, setiap baris satu nama"></textarea>

    <label for="positions">Jabatan dan Jumlah Anggota:</label>
    <div id="positions-container">
      <!-- Position template -->
      <div class="position">
        <input type="text" placeholder="Nama Jabatan">
        <input type="number" min="1" placeholder="Jumlah Anggota">
        <button class="delete-position">Hapus</button>
      </div>
    </div>
    <button id="add-position">Tambah Jabatan</button>
    <button id="randomize">Acak</button>
    <button id="download-results">Download Hasil</button>
  </div>

  <div id="result-container"></div>

  <script src="script-peran.js"></script>
  <a href="../../app.php">Kembali</a>
</body>
</html>