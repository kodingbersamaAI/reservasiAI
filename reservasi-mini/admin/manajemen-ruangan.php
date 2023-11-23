<?php 
include "../server/sesi.php"; 
include "../server/koneksi.php";
include "akses.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruangan - ReservasiAI</title>

  <?php include "../universal/head.php" ?>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <?php include "navbar.php" ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <?php include "menu.php" ?>

        <!-- Data Ruangan -->
        <div class="row">
          <div class="col-md-8 col-12">
            <div class="card">
              <div class="card-header">
                Data Ruangan
              </div>
              <div class="card-body">
                <table id="ruanganTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>Tipe</th>
                      <th>Ukuran</th>
                      <th>Kapasitas</th>
                      <th>Fasilitas</th>
                      <th>Harga</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  // Query SQL untuk mengambil data ruangan
                  $queryRuangan = "SELECT * FROM ruangan ORDER BY kodeRuangan ASC";
                  $resultRuangan = $conn->query($queryRuangan);

                  if ($resultRuangan->num_rows > 0) {
                    while ($row = $resultRuangan->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["kodeRuangan"] . "</td>";
                      echo "<td>" . $row["namaRuangan"] . "</td>";
                      echo "<td>" . $row["tipeRuangan"] . "</td>";
                      echo "<td>" . $row["ukuranRuangan"] . "</td>";
                      echo "<td>" . $row["kapasitasRuangan"] . "</td>";
                      echo "<td>" . $row["fasilitasRuangan"] . "</td>";
                      echo "<td>" . $row["hargaRuangan"] . "</td>";
                      echo "<td>" . $row["statusRuangan"] . "</td>";
                      echo "<td>";
                      // Tombol Edit dengan Modal
                      echo "<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalEdit" . $row["id"] . "' alt='Edit Data Ruangan'><i class='fas fa-edit'></i></button>&nbsp;";
                      // Tombol Hapus dengan Modal
                      echo "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalHapus" . $row["id"] . "' alt='Hapus Data Ruangan'><i class='fas fa-trash'></i></button>&nbsp;";
                      echo "</td>";
                      echo "</tr>";
                      // Modal untuk Edit Data Ruangan
                        echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalEdit" . $row["id"] . "'>
                                <div class='modal-dialog modal-dialog-centered'>
                                  <div class='modal-content'>
                                    <div class='modal-header'>
                                      <div class='modal-title'>Edit Data Ruangan</div>
                                    </div>
                                    <div class='modal-body'>
                                      <form action='proses/update_ruangan.php' method='POST'>
                                        <input type='hidden' name='csrf_token' readonly value= '" . generateCSRFToken() . "'>
                                        <input type='hidden' class='form-control' id='id' name='id' value='" . $row["id"] . "' readonly>
                                        <div class='form-group'>
                                          <label for='kodeRuangan'>Kode:</label>
                                          <input type='text' class='form-control' id='kodeRuangan' name='kodeRuangan' value='" . $row["kodeRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='namaRuangan'>Nama:</label>
                                          <input type='text' class='form-control' id='namaRuangan' name='namaRuangan' value='" . $row["namaRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='galeriRuangan'>Galeri:</label>
                                          <textarea class='form-control' id='galeriRuangan' name='galeriRuangan' rows='3'>" . $row["galeriRuangan"] . "</textarea>
                                        </div>
                                        <div class='form-group'>
                                          <label for='tipeRuangan'>Tipe:</label>
                                          <input type='text' class='form-control' id='tipeRuangan' name='tipeRuangan' value='" . $row["tipeRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='ukuranRuangan'>Ukuran:</label>
                                          <input type='text' class='form-control' id='ukuranRuangan' name='ukuranRuangan' value='" . $row["ukuranRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='kapasitasRuangan'>Kapasitas:</label>
                                          <input type='text' class='form-control' id='kapasitasRuangan' name='kapasitasRuangan' value='" . $row["kapasitasRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='fasilitasRuangan'>Fasilitas:</label>
                                          <input type='text' class='form-control' id='fasilitasRuangan' name='fasilitasRuangan' value='" . $row["fasilitasRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='hargaRuangan'>Harga:</label>
                                          <input type='text' class='form-control' id='hargaRuangan' name='hargaRuangan' value='" . $row["hargaRuangan"] . "'>
                                        </div>
                                        <div class='form-group'>
                                          <label for='statusRuangan'>Status:</label>
                                          <input type='text' class='form-control' id='statusRuangan' name='statusRuangan' value='" . $row["statusRuangan"] . "'>
                                        </div>
                                        <button type='submit' class='btn btn-primary btn-sm'>Simpan Perubahan</button>
                                      </form>
                                        </div>
                                        <div class='modal-footer'>
                                          <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                      // Modal untuk Hapus Data Ruangan
                      echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalHapus" . $row["id"] . "'>
                              <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <div class='modal-title'>Hapus Data Ruangan</div>
                                  </div>
                                  <div class='modal-body'>
                                    <form action='proses/hapus_ruangan.php' method='POST'>
                                      <input type='hidden' name='csrf_token' readonly value= '" . generateCSRFToken() . "'>
                                      <input type='hidden' class='form-control' id='kodeRuangan' name='kodeRuangan' value='" . $row["kodeRuangan"] . "'>
                                      <p>Anda akan menghapus data ruangan: <b>" . $row["kodeRuangan"] . "</b></p>
                                      <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                                      <button type='button' class='btn btn-secondary btn-sm' data-dismiss='modal'>Batal</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>";
                    }
                  } else {
                      echo '<tr><td colspan="3">Tidak ada data ruangan.</td></tr>';
                  }
                  $conn->close();
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.Data Ruangan -->
          <!-- Tambah Data Ruangan -->
          <div class="col-md-4 col-12">
            <div class="card">
              <div class="card-header">
                Tambah Data Ruangan
              </div>
              <div class="card-body">
                <form action="proses/tambah_ruangan.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <div class="form-group">
                    <label for="kodeRuangan">Kode:</label>
                    <input type="text" class="form-control" id="kodeRuangan" name="kodeRuangan">
                  </div>
                  <div class="form-group">
                    <label for="namaRuangan">Nama:</label>
                    <input type="text" class="form-control" id="namaRuangan" name="namaRuangan" required>
                  </div>
                  <div class="form-group">
                    <label for="galeriRuangan">Galeri:</label>
                    <textarea class="form-control" id="galeriRuangan" name="galeriRuangan" rows="3" placeholder="Pisahkan antara link dengan ;" required><?= $row["galeriRuangan"] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="tipeRuangan">Tipe:</label>
                    <input type="text" class="form-control" id="tipeRuangan" name="tipeRuangan" required>
                  </div>
                  <div class="form-group">
                    <label for="ukuranRuangan">Ukuran:</label>
                    <input type="text" class="form-control" id="ukuranRuangan" name="ukuranRuangan" required>
                  </div>
                  <div class="form-group">
                    <label for="kapasitasRuangan">Kapasitas:</label>
                    <input type="number" class="form-control" id="kapasitasRuangan" name="kapasitasRuangan" required>
                  </div>
                  <div class="form-group">
                    <label for="fasilitasRuangan">Fasilitas:</label>
                    <input type="text" class="form-control" id="fasilitasRuangan" name="fasilitasRuangan" required>
                  </div>
                  <div class="form-group">
                    <label for="hargaRuangan">Harga:</label>
                    <input type="text" class="form-control" id="hargaRuangan" name="hargaRuangan" placeholder="Isi keterangan per hari atau per jam ( / )" required>
                  </div>
                  <div class="form-group">
                    <label for="statusRuangan">Status:</label>
                    <select class="form-control" id="statusRuangan" name="statusRuangan" required>
                      <option value="Tersedia">Tersedia</option>
                      <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
                </form>
              </div>
            </div>
          </div><!-- /. Tambah Data Ruangan -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer -->

  <?php include "../universal/footer.php" ?>

  <!-- /Footer -->

</div>
<!-- ./wrapper -->

<!-- Script -->

<?php include "../universal/script.php" ?>

<script>
  $(document).ready(function() {
    // Cek apakah parameter success=1 ada di URL
    var successParam = new URLSearchParams(window.location.search).get('success');
    var errorParam = new URLSearchParams(window.location.search).get('error');
    
    if (successParam === '1') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Berhasil menambahkan data ruangan.'
      });
    }

    if (successParam === '2') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Berhasil menghapus data ruangan.'
      });
    }

    if (successParam === '3') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Berhasil memperbarui data ruangan.'
      });
    }

    if (errorParam === '1') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal menambahkan data ruangan.'
      });
    }

    if (errorParam === '2') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal, namaRuangan telah terdaftar.'
      });
    }

    if (errorParam === '3') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal menghapus data ruangan.'
      });
    }

    if (errorParam === '4') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal memperbarui data ruangan.'
      });
    }

    if (errorParam === '5') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Tindakan tidak diizinkan.'
      });
    }
  });
</script>
<script>
  $(function () {
    $("#ruanganTable").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    })
  });
</script>

<!-- /Script -->
</body>
</html>