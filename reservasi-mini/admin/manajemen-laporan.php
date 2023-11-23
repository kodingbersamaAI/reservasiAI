<?php 
include "../server/sesi.php"; 
include "../server/koneksi.php";
include "akses.php";

// Query untuk menghitung jumlah totalBayar pada tabel reservasi
$queryTotalBayar = "SELECT SUM(totalBayar) AS totalPendapatan FROM reservasi WHERE statusReservasi = 'Terbayar'";
$resultTotalBayar = $conn->query($queryTotalBayar);

if ($resultTotalBayar) {
    $rowTotalBayar = $resultTotalBayar->fetch_assoc();
    $totalPendapatan = $rowTotalBayar['totalPendapatan'];
} else {
    $totalPendapatan = 0;
}

$queryTotalUtang = "SELECT SUM(totalBayar) AS totalPendapatanTerutang FROM reservasi WHERE statusReservasi = 'Terutang'";
$resultTotalUtang = $conn->query($queryTotalUtang);

if ($resultTotalUtang) {
    $rowTotalUtang = $resultTotalUtang->fetch_assoc();
    $totalPendapatanTerutang = $rowTotalUtang['totalPendapatanTerutang'];
} else {
    $totalPendapatanTerutang = 0;
}
                
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan - ReservasiAI</title>

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

        <!-- Rekap Transaksi -->
        <div class="row">
          <!-- Rekap Pendapatan -->
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Total Pendapatan
              </div>
              <div class="card-body">
                <h4>Rp. <?php echo number_format($totalPendapatan, 0, ',', '.'); ?></h4>
              </div>
            </div>
          </div>
          <!-- Rekap Terutang -->
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Total Pendapatan Terutang
              </div>
              <div class="card-body">
                <h4>Rp. <?php echo number_format($totalPendapatanTerutang, 0, ',', '.'); ?></h4>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                Rekap Transaksi
              </div>
              <div class="card-body">
                <table id="rekapTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Peminjam</th>
                      <th>Ruangan</th>
                      <th>Awal Peminjaman</th>
                      <th>Akhir Peminjaman</th>
                      <th>Total Bayar</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  // Query SQL untuk mengambil data reservasi
                  $queryRekap = "SELECT * FROM reservasi ORDER BY username ASC";
                  $resultRekap = $conn->query($queryRekap);

                  if ($resultRekap->num_rows > 0) {
                    while ($row = $resultRekap->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["username"] . "</td>";
                      echo "<td>" . $row["kodeRuangan"] . "</td>";
                      echo "<td>" . date('j F Y', strtotime($row["tanggalPeminjaman"])) . "</td>";
                      echo "<td>" . date('j F Y', strtotime($row["tanggalPengembalian"])) . "</td>";
                      echo "<td>Rp. " . number_format($row["totalBayar"], 0, ',', '.') . "</td>";
                      echo "<td>" . $row["statusReservasi"] . "</td>";
                    }
                  } else {
                      echo '<tr><td colspan="3">Tidak ada data reservasi.</td></tr>';
                  }
                  $conn->close();
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.Rekap Rekap -->
        </div><!-- /.row -->

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
    $("#rekapTable").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#rekapTable_wrapper .col-md-6:eq(0)');
  });
</script>

<!-- /Script -->
</body>
</html>