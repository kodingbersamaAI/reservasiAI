<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../manajemen-ruangan.php?error=5"); // Ganti dengan halaman yang sesuai
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeRuangan = filter_input(INPUT_POST, 'kodeRuangan', FILTER_SANITIZE_STRING);
    $namaRuangan = filter_input(INPUT_POST, 'namaRuangan', FILTER_SANITIZE_STRING);
    $galeriRuangan = filter_input(INPUT_POST, 'galeriRuangan', FILTER_SANITIZE_STRING);
    $tipeRuangan = filter_input(INPUT_POST, 'tipeRuangan', FILTER_SANITIZE_STRING);
    $ukuranRuangan = filter_input(INPUT_POST, 'ukuranRuangan', FILTER_SANITIZE_STRING);
    $kapasitasRuangan = filter_input(INPUT_POST, 'kapasitasRuangan', FILTER_SANITIZE_STRING);
    $fasilitasRuangan = filter_input(INPUT_POST, 'fasilitasRuangan', FILTER_SANITIZE_STRING);
    $hargaRuangan = filter_input(INPUT_POST, 'hargaRuangan', FILTER_SANITIZE_STRING);
    $statusRuangan = filter_input(INPUT_POST, 'statusRuangan', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan

    // Cek apakah kodeRuangan sudah ada dalam database
    $checkQuery = "SELECT kodeRuangan FROM ruangan WHERE kodeRuangan = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $kodeRuangan);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Kode Ruangan sudah ada, arahkan dengan pesan kesalahan
        header("Location: ../manajemen-ruangan.php?error=2");
        exit();
    }

    // Buat query SQL untuk menambahkan ruangan baru
    $query = "INSERT INTO ruangan (kodeRuangan, namaRuangan, galeriRuangan, tipeRuangan, ukuranRuangan, kapasitasRuangan, fasilitasRuangan, hargaRuangan, statusRuangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssss", $kodeRuangan, $namaRuangan, $galeriRuangan, $tipeRuangan, $ukuranRuangan, $kapasitasRuangan, $fasilitasRuangan, $hargaRuangan, $statusRuangan);

    if ($stmt->execute()) {
        // Pengguna berhasil ditambahkan, arahkan ke halaman sukses atau daftar ruangan
        header("Location: ../manajemen-ruangan.php?success=1"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Gagal menambahkan ruangan, tampilkan pesan kesalahan
        header("Location: ../manajemen-ruangan.php?error=1");
        exit();
    }

}
?>
