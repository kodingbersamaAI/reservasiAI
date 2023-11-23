<div class="row">
          <?php
          $queryRuangan = "SELECT * FROM ruangan";
          $stmtRuangan = mysqli_prepare($conn, $queryRuangan);

          if ($stmtRuangan && mysqli_stmt_execute($stmtRuangan)) {
              $resultRuangan = mysqli_stmt_get_result($stmtRuangan);

          if ($resultRuangan) {
          while ($rowRuangan = mysqli_fetch_assoc($resultRuangan)) {
                $galeriRuangan = explode(';', $rowRuangan['galeriRuangan']);
          ?>
          <div class="col-md-3 col-sm-6">
            <div class="card card-outline card-primary">
              <div class="card-header text-center" style="color: #007bff; font-size: 20px"><?php echo $rowRuangan['namaRuangan']; ?></div>
                <div class="card-body">
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
                      ?> </p>
                  <hr>
                  <div class="text-center">
                    <a href="detail-ruangan.php?kodeRuangan=<?php echo $rowRuangan['kodeRuangan']; ?>" class="btn btn-sm btn-primary">Lihat Selengkapnya</a> 
                  </div>
                </div>
              </div>
            </div>
            <?php
              }
                } else {
                    // Tampilkan pesan jika query ruangan gagal
                    echo "Gagal mengambil data.";
                }

                // Tutup prepared statement
                mysqli_stmt_close($stmtRuangan);
            } else {
                // Tampilkan pesan jika prepared statement gagal
                echo "Gagal membuat atau mengeksekusi prepared statement.";
            }
            ?>
          </div>
        </div>