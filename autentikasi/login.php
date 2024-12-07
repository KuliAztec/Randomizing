<?php 
include '../koneksyon.php'; 
session_start(); 

if (isset($_POST['submit'])) { 
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = hash('sha256', $_POST['password']); 

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'"; 
    $result = mysqli_query($conn, $sql); 

    if ($result->num_rows > 0) { 
        $row = mysqli_fetch_assoc($result); 
        $_SESSION['email'] = $row['email']; 
        $_SESSION['id_user'] = $row['id_user']; // Set the session variable
        header("Location: ../app.php"); 
        exit();
    } else { 
        echo "<script>alert('Email atau password salah.')</script>"; 
    } 
} 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: calc(100% - 22px);
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin: 10px 0;
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h1>Login</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
        <a href="../app.php">Kembali</a>
        <a href="register.php">Daftar</a>
    </form>
</body>
</html>