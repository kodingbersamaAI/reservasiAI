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
    $id_ruangan = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
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

    // Jalankan tindakan perbarui ruangan
    $query = "UPDATE ruangan SET kodeRuangan = ?, namaRuangan = ?, galeriRuangan = ?, tipeRuangan = ?, ukuranRuangan = ?, kapasitasRuangan = ?, fasilitasRuangan = ?, hargaRuangan = ?, statusRuangan = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssss", $kodeRuangan, $namaRuangan, $galeriRuangan, $tipeRuangan, $ukuranRuangan, $kapasitasRuangan, $fasilitasRuangan, $hargaRuangan, $statusRuangan, $id_ruangan);

    if ($stmt->execute()) {
        // Buku berhasil diperbarui
        header("Location: ../manajemen-ruangan.php?success=3"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Gagal memperbarui ruangan
        header("Location: ../manajemen-ruangan.php?error=4"); // Ganti dengan halaman yang sesuai
        exit();
    }
}
?>
