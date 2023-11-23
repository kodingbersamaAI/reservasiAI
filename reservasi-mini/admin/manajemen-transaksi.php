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
  <title>Transaksi - ReservasiAI</title>

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

        <!-- Data Transaksi -->
        <div class="row">
          <div class="col-md-9 col-12">
            <div class="card">
              <div class="card-header">
                Data Transaksi
              </div>
              <div class="card-body">
                <table id="reservasiTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID Reservasi</th>
                      <th>Nama Peminjam</th>
                      <th>Kode Ruangan</th>
                      <th>Awal Reservasi</th>
                      <th>Akhir Reservasi</th>
                      <th>Jam Reservasi</th>
                      <th>Total Bayar</th>
                      <th>Status Reservasi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  // Query SQL untuk mengambil data reservasi
                  $queryTransaksi = "SELECT * FROM reservasi ORDER BY statusReservasi ASC";
                  $resultTransaksi = $conn->query($queryTransaksi);

                  if ($resultTransaksi->num_rows > 0) {
                    while ($row = $resultTransaksi->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["idReservasi"] . "</td>";
                      echo "<td>" . $row["username"] . "</td>";
                      echo "<td>" . $row["kodeRuangan"] . "</td>";
                      echo '<td>' . date('d F Y', strtotime($row['tanggalPeminjaman'])) . '</td>';
                      echo '<td>' . date('d F Y', strtotime($row['tanggalPengembalian'])) . '</td>';
                      echo "<td>" . $row["jamReservasi"] . "</td>";
                      echo "<td>Rp. " . number_format($row["totalBayar"], 0, ',', '.') . "</td>";
                      echo "<td>" . $row["statusReservasi"] . "</td>";
                      echo "<td>";
                      // Tombol Edit dengan Modal
                      echo "<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalUpdate" . $row["id"] . "' alt='Edit Data Transaksi'><i class='fas fa-edit'></i></button>&nbsp;";
                      // Tombol Hapus dengan Modal
                      echo "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalHapus" . $row["id"] . "' alt='Hapus Data Transaksi'><i class='fas fa-trash'></i></button>&nbsp;";
                      echo "</td>";
                      echo "</tr>";
                      // Modal untuk Memperbarui Status Data Transaksi
                      echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalUpdate" . $row["id"] . "'>
                              <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <div class='modal-title'>Perbarui Data Transaksi</div>
                                  </div>
                                  <div class='modal-body'>
                                    <form action='proses/update_transaksi.php' method='POST'>
                                      <input type='hidden' name='csrf_token' readonly value= '" . generateCSRFToken() . "'>
                                      <input type='hidden' class='form-control' id='id' name='id' value='" . $row["id"] . "' readonly>
                                    <div class='form-group'>
                                      <label for='username'>Nama Peminjam:</label>
                                      <input type='text' class='form-control' id='username' name='username' value='" . $row["username"] . "' readonly>
                                    </div>
                                    <div class='form-group'>
                                      <label for='kodeRuangan'>Kode Ruangan:</label>
                                      <input type='text' class='form-control' id='kodeRuangan' name='kodeRuangan' value='" . $row["kodeRuangan"] . "'>
                                    </div>
                                    <div class='form-group'>
                                      <label for='tanggalPeminjaman'>Awal Reservasi:</label>
                                      <input type='date' class='form-control' id='tanggalPeminjaman' name='tanggalPeminjaman' value='" . $row["tanggalPeminjaman"] . "'>
                                    </div>
                                    <div class='form-group'>
                                      <label for='tanggalPengembalian'>Akhir Reservasi:</label>
                                      <input type='date' class='form-control' id='tanggalPengembalian' name='tanggalPengembalian' value='" . $row["tanggalPengembalian"] . "'>
                                    </div>
                                    <div class='form-group'>
                                      <label for='jamReservasi'>Jam Reservasi:</label>
                                      <input type='text' class='form-control' id='jamReservasi' name='jamReservasi' value='" . $row["jamReservasi"] . "'>
                                    </div>
                                    <div class='form-group'>
                                      <label for='totalBayar'>Total Bayar:</label>
                                      <input type='number' class='form-control' id='totalBayar' name='totalBayar' value='" . $row["totalBayar"] . "'>
                                    </div>
                                    <div class='form-group'>
                                      <label for='statusReservasi'>Status Reservasi:</label>
                                      <select class='form-control' id='statusReservasi' name='statusReservasi'>
                                        <option value='Terbayar'>Terbayar</option>
                                        <option value='Terutang'>Terutang</option>
                                      </select>
                                    </div>

                                      <button type='submit' class='btn btn-success btn-sm'>Simpan Perubahan</button>
                                      <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Batal</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>";
                      // Modal untuk Hapus Data Transaksi
                      echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalHapus" . $row["id"] . "'>
                              <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <div class='modal-title'>Hapus Data Transaksi</div>
                                  </div>
                                  <div class='modal-body'>
                                    <form action='proses/hapus_transaksi.php' method='POST'>
                                      <input type='hidden' name='csrf_token' readonly value= '" . generateCSRFToken() . "'>
                                      <input type='hidden' class='form-control' id='id' name='id' value='" . $row["id"] . "'>
                                      <p>Apakah Anda yakin akan menghapus data reservasi dari <b>" . $row["username"] . "</b> yang meminjam ruangan <b>" . $row["kodeRuangan"] . "</b></p>
                                      <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                                      <button type='button' class='btn btn-secondary btn-sm' data-dismiss='modal'>Batal</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>";
                    }
                  } else {
                      echo '<tr><td colspan="6">Tidak ada data reservasi.</td></tr>';
                  }
                  $conn->close();
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.Data Transaksi -->
          <!-- Tambah Data Transaksi -->
          <div class="col-md-3 col-12">
            <div class="card">
              <div class="card-header">
                Tambah Data Transaksi
              </div>
              <div class="card-body">
                <form action="proses/tambah_transaksi.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <?php
                  // Membuat kode acak sepanjang 6 karakter tanpa simbol
                  $idReservasi = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
                  ?>
                  <div class="form-group">
                    <label for="idReservasi">ID Reservasi:</label>
                    <input type="text" class="form-control" id="idReservasi" name="idReservasi" value="<?php echo $idReservasi; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="username">Nama Peminjam:</label>
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="form-group">
                    <label for="kodeRuangan">Kode Ruangan:</label>
                    <input type="text" class="form-control" id="kodeRuangan" name="kodeRuangan">
                  </div>
                  <div class="form-group">
                    <label for="tanggalPeminjaman">Awal Reservasi:</label>
                    <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalPeminjaman">
                  </div>
                  <div class="form-group">
                    <label for="tanggalPengembalian">Akhir Reservasi:</label>
                    <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian">
                  </div>
                  <div class="form-group">
                    <label for="jamReservasi">Jam Reservasi:</label>
                    <input type="text" class="form-control" id="jamReservasi" name="jamReservasi">
                  </div>
                  <div class="form-group">
                    <label for="totalBayar">Total Bayar:</label>
                    <input type="number" class="form-control" id="totalBayar" name="totalBayar">
                  </div>
                  <div class="form-group">
                    <label for="statusReservasi">Status Reservasi:</label>
                    <select class="form-control" id="statusReservasi" name="statusReservasi" required>
                      <option value="Terbayar">Terbayar</option>
                      <option value="Terutang">Terutang</option>
                    </select>
                  </div>
                  <input type="hidden" class="form-control" id="status" name="status" value="Dipinjam">
                  <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                </form>
              </div>
            </div>
          </div><!-- /. Tambah Data Transaksi -->
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
        text: 'Berhasil menambahkan data reservasi.'
      });
    }

    if (successParam === '2') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Reservasi berhasil dikembalikan'
      });
    }

    if (successParam === '3') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Data reservasi berhasil dihapus'
      });
    }

    if (errorParam === '1') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Gagal menambahkan data reservasi.'
      });
    }

    if (errorParam === '2') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Pengguna telah meminjam lebih dari 3 reservasi.'
      });
    }

    if (errorParam === '3') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Reservasi gagal dikembalikan.'
      });
    }

    if (errorParam === '4') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Sisa reservasi tidak ada.'
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
    $("#reservasiTable").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    })
  });
</script>

<!-- /Script -->
</body>
</html>