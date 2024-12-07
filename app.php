<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acak Aja</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      color: #343a40;
    }
    .text-center {
      text-align: center;
    }
    .my-4 {
      margin: 2rem 0;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 1rem;
      background-color: #fff;
      border-radius: 0.25rem;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    .list-group-item {
      padding: 0.75rem 1.25rem;
      background-color: #fff;
      border: 1px solid rgba(0, 0, 0, 0.125);
      border-radius: 0.25rem;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      text-align: center;
    }
    .btn {
      display: inline-block;
      font-weight: 400;
      color: #fff;
      text-align: center;
      vertical-align: middle;
      user-select: none;
      background-color: #007bff;
      border: 1px solid transparent;
      padding: 0.375rem 0.75rem;
      font-size: 1rem;
      line-height: 1.5;
      border-radius: 0.25rem;
      text-decoration: none;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    .btn:hover {
      background-color: #0056b3;
      border-color: #004085;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
    .mt-4 {
      margin-top: 1.5rem;
    }
    .login {
      position: absolute;
      top: 1rem;
      right: 1rem;
    }
    .login a {
      margin-left: 0.5rem;
    }
  </style>
</head>
<body>
  <header class="text-center my-4">
    <h1>Acak Aja</h1>
  </header>
  <div class="login">
    <?php if (isset($_SESSION['id_user'])): ?>
      <a href="profile.php" class="btn btn-primary">Profile</a>
      <a href="autentikasi/logout.php" class="btn btn-secondary">Logout</a>
    <?php else: ?>
      <a href="autentikasi/login.php" class="btn btn-secondary">Login</a>
    <?php endif; ?>
  </div>
  <main class="container">
    <div class="grid">
      <div class="list-group-item">
        <a href="acak-kelompok/main/kelompok.php" class="btn btn-primary" data-action="acak-kelompok">Acak Kelompok</a>
      </div>
      <div class="list-group-item">
        <a href="acak-peran/main/peran.php" class="btn btn-primary" data-action="acak-peran">Acak Peran</a>
      </div>
      <div class="list-group-item">
        <a href="spin-wheel/wheel.php" class="btn btn-primary" data-action="spin-wheel">Spin Wheel</a>
      </div>
      <div class="list-group-item">
        <a href="acak-angka/main/angka.php" class="btn btn-primary" data-action="acak-angka">Acak Angka</a>
      </div>
    </div>
  </main>
</body>
</html>