<div id="calendar">
                <?php
                $kodeRuangan = isset($_GET['kodeRuangan']) ? $_GET['kodeRuangan'] : ''; // Mendapatkan nilai kodeRuangan dari parameter URL
                // Mendapatkan data peminjaman sesuai dengan kode ruangan
                $queryPeminjaman = "SELECT * FROM reservasi WHERE kodeRuangan = '$kodeRuangan' ORDER BY STR_TO_DATE(jamReservasi, '%H.%i')";
                $stmtPeminjaman = mysqli_prepare($conn, $queryPeminjaman);

                if ($stmtPeminjaman && mysqli_stmt_execute($stmtPeminjaman)) {
                    $resultPeminjaman = mysqli_stmt_get_result($stmtPeminjaman);

                    // Mengonversi data peminjaman ke dalam format yang diterima oleh FullCalendar
                    $events = array();
                    while ($rowPeminjaman = mysqli_fetch_assoc($resultPeminjaman)) {
                        $events[] = array(
                            'title' => $rowPeminjaman['tanggalReservasi'] . ' ' . $rowPeminjaman['jamReservasi'], // Judul acara
                            'start' => $rowPeminjaman['tanggalPeminjaman'], // Tanggal mulai acara
                            'end' => $rowPeminjaman['tanggalPengembalian'] // Tanggal selesai acara
                        );
                    }
                }
                ?>
                </div>