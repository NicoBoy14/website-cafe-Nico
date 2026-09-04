<?php
// Konfigurasi database
$host = "localhost";
$user = "root";      // ganti sesuai user mariaDB
$pass = "";          // ganti sesuai password mariaDB
$db   = "mompopcafe";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama    = $_POST['nama'];
$telepon = $_POST['telepon'];
$menu    = $_POST['menu'];
$alamat  = $_POST['alamat'];

// Simpan ke database
$sql = "INSERT INTO orders (nama, telepon, menu, alamat)
        VALUES ('$nama', '$telepon', '$menu', '$alamat')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pesanan berhasil tersimpan!'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
