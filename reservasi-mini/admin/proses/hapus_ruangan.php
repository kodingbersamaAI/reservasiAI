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

    // Validasi data jika diperlukan


    // Buat query SQL untuk menambahkan ruangan baru
    $query = "DELETE FROM ruangan WHERE kodeRuangan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kodeRuangan);

    if ($stmt->execute()) {
        // Pengguna berhasil ditambahkan, arahkan ke halaman sukses atau daftar ruangan
        header("Location: ../manajemen-ruangan.php?success=2"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Gagal menambahkan ruangan, tampilkan pesan kesalahan
        header("Location: ../manajemen-ruangan.php?error=3");
        exit();
    }

}
?>
