<?php 
include '../koneksyon.php'; 
session_start(); 

if (isset($_POST['submit'])) {  
    $email = $_POST['email']; 
    $password = hash('sha256', $_POST['password']); 
    $cpassword = hash('sha256', $_POST['cpassword']); 

    if ($password == $cpassword) { 
        $stmt = $conn->prepare("SELECT * FROM user WHERE email=?"); 
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) { 
            $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)"); 
            $stmt->bind_param("ss", $email, $password);
            $result = $stmt->execute();
            
            if ($result) { 
                echo "<script>alert('Pendaftaran berhasil!')</script>"; 
            } else {
                echo "<script>alert('Terjadi kesalahan.')</script>";
            }
        } else { 
            echo "<script>alert('Email sudah terdaftar.')</script>"; 
        }
        $stmt->close();
    } else { 
        echo "<script>alert('Password tidak sesuai.')</script>"; 
    } 
    $conn->close();
} 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #4cae4c;
        }

        form::after {
            content: "";
            display: table;
            clear: both;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        a {
            display: block;
            text-align: center;
            margin: 10px 0;
            color: #5cb85c;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h1>Registrasi</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="cpassword" placeholder="Confirm Password" required>
        <button type="submit" name="submit">Daftar</button>
        <a href="login.php">Sudah punya akun?</a>
        <a href="../app.php">Kembali</a>
    </form>
</body>
</html>