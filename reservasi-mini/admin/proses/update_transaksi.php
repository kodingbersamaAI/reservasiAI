<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../manajemen-transaksi.php?error=5"); // Ganti dengan halaman yang sesuai
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $kode_ruangan = filter_input(INPUT_POST, 'kodeRuangan', FILTER_SANITIZE_STRING);
    $tanggal_peminjaman = filter_input(INPUT_POST, 'tanggalPeminjaman', FILTER_SANITIZE_STRING);
    $tanggal_pengembalian = filter_input(INPUT_POST, 'tanggalPengembalian', FILTER_SANITIZE_STRING);
    $jam_reservasi = filter_input(INPUT_POST, 'jamReservasi', FILTER_SANITIZE_STRING);
    $totalBayar = filter_input(INPUT_POST, 'totalBayar', FILTER_SANITIZE_NUMBER_INT);
    $status_reservasi = filter_input(INPUT_POST, 'statusReservasi', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan

    // Jalankan tindakan perbarui transaksi
    $query = "UPDATE reservasi SET username = ?, kodeRuangan = ?, tanggalPeminjaman = ?, tanggalPengembalian = ?, jamReservasi = ?, totalBayar = ?, statusReservasi = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $username, $kode_ruangan, $tanggal_peminjaman, $tanggal_pengembalian, $jam_reservasi, $totalBayar, $status_reservasi, $id_transaksi);

    if ($stmt->execute()) {
        // Transaksi berhasil diperbarui
        header("Location: ../manajemen-transaksi.php?success=2"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Gagal memperbarui transaksi
        header("Location: ../manajemen-transaksi.php?error=3"); // Ganti dengan halaman yang sesuai
        exit();
    }
}
?>
