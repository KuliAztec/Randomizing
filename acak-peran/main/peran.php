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
  <style>
    /* style.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.input-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

textarea, input[type="text"], input[type="number"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#positions-container {
    margin-bottom: 10px;
}

.position {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.position input {
    flex: 1;
    margin-right: 10px;
}

.delete-position {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
}

.delete-position:hover {
    background-color: #c0392b;
}

#add-position, #randomize {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 10px;
}

#add-position:hover, #randomize:hover {
    background-color: #2980b9;
}

#result-container {
    margin-top: 20px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
  </style>
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