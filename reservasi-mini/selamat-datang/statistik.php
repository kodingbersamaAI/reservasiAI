<?php
// Menghitung jumlah buku dalam koleksi
$queryRuangan = "SELECT COUNT(*) AS totalRuangan FROM ruangan";
$resultRuangan = $conn->query($queryRuangan);

if ($resultRuangan) {
    $rowRuangan = $resultRuangan->fetch_assoc();
    $totalRuangan = $rowRuangan['totalRuangan'];
} else {
    $totalRuangan = 0;
}

// Menghitung jumlah anggota dari tabel pengguna dengan role anggota
$queryAnggota = "SELECT COUNT(*) AS totalAnggota FROM pengguna WHERE role = 'user'";
$resultAnggota = $conn->query($queryAnggota);

if ($resultAnggota) {
    $rowAnggota = $resultAnggota->fetch_assoc();
    $totalAnggota = $rowAnggota['totalAnggota'];
} else {
    $totalAnggota = 0;
}

// Menghitung jumlah peminjaman dengan status dipinjam
$queryReservasi = "SELECT COUNT(*) AS totalReservasi FROM reservasi";
$resultReservasi = $conn->query($queryReservasi);

if ($resultReservasi) {
    $rowReservasi = $resultReservasi->fetch_assoc();
    $totalReservasi = $rowReservasi['totalReservasi'];
} else {
    $totalReservasi = 0;
}
?>

        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-home"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Ruangan</span>
                <span class="info-box-number"><?php echo "$totalRuangan"; ?> Ruangan</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Peminjam Aktif</span>
                <span class="info-box-number"><?php echo "$totalAnggota"; ?> Member</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi Reservasi</span>
                <span class="info-box-number"><?php echo "$totalReservasi"; ?> Reservasi</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div><hr>
        <!-- /.row -->