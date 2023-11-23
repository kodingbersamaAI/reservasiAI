<?php 
include "../server/sesi.php"; 
include "../server/koneksi.php";

if (isset($_SESSION['username'])) {
    $dashboardLink = ''; // Inisialisasi variabel untuk link dashboard
    if ($_SESSION['role'] === 'admin') {
        $dashboardLink = '../../../admin/dashboard.php';
    } elseif ($_SESSION['role'] === 'user') {
        $dashboardLink = '../../../user/dashboard.php';
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Ruangan - ReservasiAI</title>

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
          <div class="col-12">
            <?php include "carousel.php" ?>
          </div>
          <div class="col-md-4 col-12">
            <div class="card flex-column">
              <div class="card-header text-center">
                <b>Informasi Ruangan</b>
              </div>
              <div class="card-body">
                <?php include "data.php" ?>
              </div>
            </div>
            <div class="card flex-column mt-3">
              <div class="card-header text-center">
                <b>Pesan Sekarang</b>
              </div>
              <div class="card-body text-center">
                <a href="wa.php" class="btn btn-sm btn-success"><li class="fas fa-envelope"></li> WhatsApp</a>
                <a href="email.php" class="btn btn-sm btn-primary"><li class="fas fa-envelope"></li> Email</a>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-12">
            <div class="card">
              <div class="card-header text-center">
                <b>Informasi Daftar Peminjaman</b>
              </div>
              <div class="card-body text-center">
                <?php include "kalendar.php" ?>
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
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: <?php echo json_encode($events); ?>, // Tambahkan data acara
      // ... (Tambahkan konfigurasi lain sesuai kebutuhan)
    });

    // Render kalender
    calendar.render();
  });
</script>


<!-- /Script -->
</body>
</html>