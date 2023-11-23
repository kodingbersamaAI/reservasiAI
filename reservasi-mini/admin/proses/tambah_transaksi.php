<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, lakukan tindakan yang sesuai
    header("Location: ../manajemen-transaksi.php?error=5");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Membuat kode acak sepanjang 6 karakter tanpa simbol
    $idReservasi = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);

    // Cek apakah ID Reservasi sudah ada dalam database, jika ya, buat ID baru
    do {
        $queryCheckId = "SELECT COUNT(*) AS count FROM reservasi WHERE idReservasi = ?";
        $stmtCheckId = $conn->prepare($queryCheckId);
        $stmtCheckId->bind_param("s", $idReservasi);
        $stmtCheckId->execute();
        $resultCheckId = $stmtCheckId->get_result();
        $rowCheckId = $resultCheckId->fetch_assoc();
    } while ($rowCheckId['count'] > 0);

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $kodeRuangan = filter_input(INPUT_POST, 'kodeRuangan', FILTER_SANITIZE_STRING);
    $tanggalPeminjaman = filter_input(INPUT_POST, 'tanggalPeminjaman', FILTER_SANITIZE_STRING);
    $tanggalPengembalian = filter_input(INPUT_POST, 'tanggalPengembalian', FILTER_SANITIZE_STRING);
    $jamReservasi = filter_input(INPUT_POST, 'jamReservasi', FILTER_SANITIZE_STRING);
    $totalBayar = filter_input(INPUT_POST, 'totalBayar', FILTER_SANITIZE_NUMBER_INT);
    $statusReservasi = filter_input(INPUT_POST, 'statusReservasi', FILTER_SANITIZE_STRING);

    $insertQuery = "INSERT INTO reservasi (idReservasi, username, kodeRuangan, tanggalPeminjaman, tanggalPengembalian, jamReservasi, totalBayar, statusReservasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertQuery);
    $stmtInsert->bind_param("ssssssss", $idReservasi, $username, $kodeRuangan, $tanggalPeminjaman, $tanggalPengembalian, $jamReservasi, $totalBayar, $statusReservasi);

    if ($stmtInsert->execute()) {
        // Cek apakah username sudah ada di tabel pengguna
        $queryCheckUsername = "SELECT COUNT(*) AS count FROM pengguna WHERE username = ?";
        $stmtCheckUsername = $conn->prepare($queryCheckUsername);
        $stmtCheckUsername->bind_param("s", $username);
        $stmtCheckUsername->execute();
        $resultCheckUsername = $stmtCheckUsername->get_result();
        $rowCheckUsername = $resultCheckUsername->fetch_assoc();

        if ($rowCheckUsername['count'] == 0) {
            // Lanjutkan dengan menambahkan data pengguna
            $insertUserQuery = "INSERT INTO pengguna (username, password, role) VALUES (?, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 'user')";
            $stmtInsertUser = $conn->prepare($insertUserQuery);
            $stmtInsertUser->bind_param("s", $username);

            if ($stmtInsertUser->execute()) {
                // Data pengguna berhasil ditambahkan
                header("Location: ../manajemen-transaksi.php?success=1");
                exit();
            } else {
                // Gagal menambahkan data pengguna, tampilkan pesan kesalahan
                header("Location: ../manajemen-transaksi.php?error=2");
                exit();
            }
        } else {
            // Gagal menambahkan transaksi, tampilkan pesan kesalahan
            header("Location: ../manajemen-transaksi.php?success=1");
            exit();
        }
    } else {
        // Username sudah ada di tabel pengguna, tidak perlu insert
        header("Location: ../manajemen-transaksi.php?success=1"); // atau lokasi lain jika diperlukan
        exit();
    }
}
?>
