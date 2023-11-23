<?php
// Inisialisasi sesi
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai
header("Location: ../../reservasi-mini/index.php"); // Ganti dengan halaman yang sesuai
exit();
?>
