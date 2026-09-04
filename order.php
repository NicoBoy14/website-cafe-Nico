<?php
// Konfigurasi Database
$host     = 'localhost';
$dbname   = 'nama_database_kamu';
$username = 'username_db';
$password = 'password_db';

try {
    // 1. Koneksi ke MariaDB menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// 2. Proses formulir saat method POST dikirim
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pelanggan = trim($_POST['nama_pelanggan'] ?? '');
    $nama_produk    = trim($_POST['nama_produk'] ?? '');
    $jumlah         = (int)($_POST['jumlah'] ?? 0);

    if (!empty($nama_pelanggan) && !empty($nama_produk) && $jumlah > 0) {
        // Prepared Statement untuk mencegah SQL Injection
        $sql = "INSERT INTO pesanan (nama_pelanggan, nama_produk, jumlah) VALUES (:nama, :produk, :jumlah)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([':nama' => $nama_pelanggan, ':produk' => $nama_produk, ':jumlah' => $jumlah])) {
            $message = "<p style='color:green;'>Pesanan berhasil disimpan!</p>";
        } else {
            $message = "<p style='color:red;'>Gagal menyimpan pesanan.</p>";
        }
    } else {
        $message = "<p style='color:red;'>Mohon isi semua data dengan benar.</p>";
    }
}
?>
