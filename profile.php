<?php
include 'koneksyon.php'; // Menyertakan file config.php untuk koneksi database

session_start(); // Memulai sesi

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: autentikasi/login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Mengambil data pengguna dari database
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

$id_user = null;
if ($result->num_rows > 0) {
    // Menampilkan data pengguna
    $row = $result->fetch_assoc();
    $id_user = $row['id_user']; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #50b3a2;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            display: inline;
            padding: 0 20px 0 20px;
        }
        header #branding {
            float: left;
        }
        header #branding h1 {
            margin: 0;
        }
        header nav {
            float: right;
            margin-top: 10px;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #50b3a2;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            color: #fff;
            background: #e8491d;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #50b3a2;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Profil Pengguna</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="app.php">Beranda</a></li>
                    <li><a href="autentikasi/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <?php if ($id_user): ?>
            <p>Email: <?php echo $row['email']; ?></p>
            <?php
            // Menghapus data dari tabel simpan
            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $sql_delete = "DELETE FROM simpan WHERE id_simpan = '$delete_id' AND id_user = '$id_user'";
                if ($conn->query($sql_delete) === TRUE) {
                    echo "Data berhasil dihapus.";
                } else {
                    echo "Error: " . $conn->error;
                }
            }

            // Mengambil data dari tabel simpan
            $sql_simpan = "SELECT * FROM simpan WHERE id_user = '$id_user'";
            $result_simpan = $conn->query($sql_simpan);

            if ($result_simpan->num_rows > 0) {
                echo "<h2>Data Simpan</h2>";
                echo "<table>";
                echo "<tr><th>id_simpan</th><th>id_user</th><th>isi</th><th>Aksi</th></tr>";
                while ($row_simpan = $result_simpan->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_simpan['id_simpan'] . "</td>";
                    echo "<td>" . $row_simpan['id_user'] . "</td>";
                    echo "<td>" . $row_simpan['isi'] . "</td>";
                    echo "<td><a href='profile.php?delete_id=" . $row_simpan['id_simpan'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Tidak ada data simpan.";
            }
            ?>
        <?php else: ?>
            <p>Data pengguna tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close(); // Menutup koneksi
?>