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
  <title>Halaman Depan - ReservasiAI</title>

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
        
        <!-- Statistik -->        
        <?php include "statistik.php" ?><!-- /.Statistik -->

        <!-- Browse Room -->
        <?php include "browse.php" ?><!-- /.Browse Room -->
        
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
      // Cek apakah parameter error=1 ada di URL
      var errorParam = new URLSearchParams(window.location.search).get('error');
      
      if (errorParam === '1') {
        Swal.fire({
          icon: 'error',
          title: 'Login Gagal',
          text: 'Silakan coba lagi.'
        });
      }

      if (errorParam === '2') {
        Swal.fire({
          icon: 'error',
          title: 'Ditolak',
          text: 'Anda tidak memiliki akses ke halaman.'
        });
      }
    });
</script>

<!-- /Script -->
</body>
</html>