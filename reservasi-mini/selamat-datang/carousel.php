<?php
$kodeRuangan = isset($_GET['kodeRuangan']) ? $_GET['kodeRuangan'] : ''; // Mendapatkan nilai kodeRuangan dari parameter URL

$queryRuangan = "SELECT * FROM ruangan WHERE kodeRuangan = '$kodeRuangan'";
$stmtRuangan = mysqli_prepare($conn, $queryRuangan);

if ($stmtRuangan && mysqli_stmt_execute($stmtRuangan)) {
    $resultRuangan = mysqli_stmt_get_result($stmtRuangan);

    // Periksa apakah ada hasil yang cocok
    if ($resultRuangan && mysqli_num_rows($resultRuangan) > 0) {
        while ($rowRuangan = mysqli_fetch_assoc($resultRuangan)) {
            // Anda perlu mendapatkan nilai $galeriRuangan di dalam loop agar setiap ruangan memiliki galeri yang berbeda
            $galeriRuangan = explode(';', $rowRuangan['galeriRuangan']);
            ?>
            <div id="carouselBrowseRoom<?php echo $rowRuangan['kodeRuangan']; ?>" class="carousel slide" data-ride="false">
                <ol class="carousel-indicators">
                    <?php
                    // Generate carousel indicators
                    for ($i = 0; $i < count($galeriRuangan); $i++) {
                        $activeClass = ($i == 0) ? 'active' : '';
                        ?>
                        <li data-target="#carouselBrowseRoom<?php echo $rowRuangan['kodeRuangan']; ?>" data-slide-to="<?php echo $i; ?>" class="<?php echo $activeClass; ?>"></li>
                        <?php
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    // Generate carousel items
                    foreach ($galeriRuangan as $index => $gambar) {
                        $activeClass = ($index == 0) ? 'active' : '';
                        ?>
                        <div class="carousel-item <?php echo $activeClass; ?>">
                            <img class="d-block mx-auto" style="max-width: 100%" src="<?php echo $gambar; ?>" alt="Slide <?php echo $index + 1; ?>">
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselBrowseRoom<?php echo $rowRuangan['kodeRuangan']; ?>" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Sebelumnya</span>
                </a>
                <a class="carousel-control-next" href="#carouselBrowseRoom<?php echo $rowRuangan['kodeRuangan']; ?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Selanjutnya</span>
                </a>
            </div>
            <?php
        }
    } else {
        echo "";
    }
} else {
    echo "";
}
?>
<br>
<style type="text/css">
.carousel-control-prev-icon {
  background-image: none; /* Hapus URL SVG */
}

.carousel-control-prev-icon::before {
  content: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
}

.carousel-control-next-icon {
  background-image: none; /* Hapus URL SVG */
}

.carousel-control-next-icon::before {
  content: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
}

</style>