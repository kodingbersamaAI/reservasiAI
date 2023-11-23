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
        
        <?php include "menu.php" ?>

        <div class="row">
          <div class="col-12">
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

<!-- /Script -->
</body>
</html>