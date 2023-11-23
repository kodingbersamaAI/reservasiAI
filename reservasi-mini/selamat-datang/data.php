              <?php
              $kodeRuangan = isset($_GET['kodeRuangan']) ? $_GET['kodeRuangan'] : ''; // Mendapatkan nilai kodeRuangan dari parameter URL

              $queryRuangan = "SELECT * FROM ruangan WHERE kodeRuangan = '$kodeRuangan'";
              $stmtRuangan = mysqli_prepare($conn, $queryRuangan);

              if ($stmtRuangan && mysqli_stmt_execute($stmtRuangan)) {
                  $resultRuangan = mysqli_stmt_get_result($stmtRuangan);

                  if ($resultRuangan && $rowRuangan = mysqli_fetch_assoc($resultRuangan)) {
                      ?>
                      <p><strong>Nama</strong>: <?php echo $rowRuangan['namaRuangan']; ?></p>
                      <p><strong>Kode</strong>: <?php echo $rowRuangan['kodeRuangan']; ?></p>
                      <p><strong>Tipe</strong>: <?php echo $rowRuangan['tipeRuangan']; ?></p>
                      <p><strong>Ukuran</strong>: <?php echo $rowRuangan['ukuranRuangan']; ?> meter</p>
                      <p><strong>Kapasitas</strong>: <?php echo $rowRuangan['kapasitasRuangan']; ?> orang</p>
                      <p><strong>Fasilitas</strong>: <?php echo $rowRuangan['fasilitasRuangan']; ?></p>
                      <p><strong>Harga</strong>: Rp. <?php echo number_format($rowRuangan['hargaRuangan'], 0, ',', '.'); ?> / Jam</p>
                      <p><strong>Status</strong>: 
                          <?php
                          if ($rowRuangan['statusRuangan'] == 'Tersedia') {
                              echo '<button class="btn btn-xs btn-success">Tersedia</button>';
                          } else {
                              echo '<button class="btn btn-xs btn-secondary">Tidak Tersedia</button>';
                          }
                          ?> 
                      </p>
                      <?php
                  } else {
                      echo "Ruangan tidak ditemukan.";
                  }
              } else {
                  echo "Error dalam menjalankan query.";
              }
              ?>