<?php

include '../../koneksyon.php';

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
  <title>Acak Kelompok</title>
  <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        font-size: 2.5em;
        margin: 0;
        margin-bottom: 20px;
    }

    .input-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        transition: box-shadow 0.3s ease;
    }

    .input-container:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #555;
    }

    textarea, input[type="text"], input[type="number"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1em;
        transition: border-color 0.3s ease;
    }

    textarea:focus, input[type="text"]:focus, input[type="number"]:focus {
        border-color: #3498db;
        outline: none;
    }

    button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
        margin-bottom: 10px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2980b9;
    }

    #download-btn {
        width: auto;
        padding: 5px 10px;
        font-size: 0.9em;
        margin: 10px auto;
    }

    #result-container {
        margin-top: 20px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #3498db;
        text-decoration: none;
        font-size: 1em;
    }

    a:hover {
        text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Acak Kelompok</h1>
  <div class="input-container">
    <label for="num-groups">Jumlah Kelompok:</label>
    <input type="number" id="num-groups" min="1" value="1">
    <button type="button" id="randomize-btn">Acak</button>
    <button type="button" id="reset-btn">Reset</button>
    <textarea id="name-list" rows="5" placeholder="Masukkan nama peserta, setiap baris satu nama"></textarea>
  </div>
  <button type="button" id="download-btn">Download Hasil</button>
  <div id="result-container" class="result-container"></div>
  <a href="../../app.php">Kembali</a>
  <form id="save-form" method="POST" action="save-kelompok.php" target="hidden-iframe">
    <input type="hidden" name="result" id="result-input">
  </form>
  <iframe name="hidden-iframe" style="display:none;"></iframe>
  <script src="script-kelompok.js"></script>
  <script>
    document.getElementById('randomize-btn').addEventListener('click', function() {
      const names = document.getElementById('name-list').value.split('\n');
      const numberOfGroups = parseInt(document.getElementById('num-groups').value, 10);
      const result = divideIntoGroups(names, numberOfGroups);
      document.getElementById('result-input').value = JSON.stringify(result); // Save result to hidden input
      displayGroups(result);
    });

    document.getElementById('download-btn').addEventListener('click', function() {
      if (!document.getElementById('result-input').value) {
        alert('Tidak ada hasil untuk didownload.');
        return;
      }

      // Trigger form submission to save result to database
      document.getElementById('save-form').submit();
    });
  </script>
</body>
</html>