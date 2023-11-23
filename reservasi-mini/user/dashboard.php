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
  <title>Dashboard - ReservasiAI</title>

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
        <div class="row">
          <div class="col-md-4 col-12">
            <div class="card">
              <div class="card-header">
                Tata Tertib Penggunaan Ruangan
              </div>
              <div class="card-body">
                <h5><b>Peraturan Umum</b></h5>
                <ol>
                  <li><p>Pengguna/penyewa bersedia menyelesaikan administrasi sebelum menggunakan, apabila urusan administrasi sampai dengan (H-3) belum diselesaikan maka peminjam dianggap membatalkan/mengundurkan diri dan pengelola berwenang untuk memberikan ijin penggunaan kepada peminjam lain yang membutuhkan.</p></li>
                  <li><p>Pengguna/penyewa tidak diperkenankan membawa senjata tajam, berkelahi, mengkonsumsi/membawa minuman keras, narkoba dan obat-obatan lain yang memabukkan.</p></li>
                  <li><p>Pengguna/penyewa tidak diperkenankan merusak gedung dan fasilitas yang ada, corat-coret, merokok dan membuang sampah sembarangan.</p></li>
                  <li><p>Pengguna/penyewa peminjam bersedia/wajib menjaga keamanan dan ketertiban agar tidak terjadi kericuhan.</p></li>
                  <li><p>Pengguna/penyewa bersedia/wajib menjaga sopan santun dalam berpakaian dan berperilaku.</p></li>
                  <li><p>Apabila terjadi kehilangan dan atau kerusakan fasilitas yang ada, maka pemakai/peminjam bertanggungjawab untuk mengganti barang yang hilang atau rusak sesuai aslinya.</p></li>
                  <li><p>Pengguna/penyewa dilarang memindahkan tangan atau meminjamkan fasilitas kepada pihak lain tanpa seijin pengelola.</p></li>
                </ol>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-12">
            <div class="card">
              <div class="card-header">
                Daftar Ruangan Reservasi
              </div>
              <div class="card-body">
                <table id="transaksiTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID Reservasi</th>
                      <th>Kode Ruangan</th>
                      <th>Awal Peminjaman</th>
                      <th>Akhir Peminjaman</th>
                      <th>Jam Reservasi</th>
                      <th>Status Reservasi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  $usernameSesi = $_SESSION['username']; // Ambil username dari sesi

                  // Query SQL untuk mengambil data transaksi
                  $queryTransaksi = "SELECT * FROM reservasi WHERE username = '$usernameSesi' ORDER BY tanggalPeminjaman ASC";
                  $resultTransaksi = $conn->query($queryTransaksi);

                  if ($resultTransaksi->num_rows > 0) {
                    while ($row = $resultTransaksi->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["idReservasi"] . "</td>";
                      echo "<td>" . $row["kodeRuangan"] . "</td>";
                      echo '<td>' . date('d F Y', strtotime($row['tanggalPeminjaman'])) . '</td>';
                      echo '<td>' . date('d F Y', strtotime($row['tanggalPengembalian'])) . '</td>';
                      echo "<td>" . $row["jamReservasi"] . "</td>";
                      echo "<td>" . $row["statusReservasi"] . "</td>";
                    }
                  } else {
                      echo '<tr><td colspan="6">Tidak ada data transaksi.</td></tr>';
                  }
                  $conn->close();
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
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
  $(function () {
    $("#transaksiTable").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    })
  });
</script>

<!-- /Script -->
</body>
</html>