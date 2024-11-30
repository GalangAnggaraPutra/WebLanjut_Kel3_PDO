<?php
include 'koneksi.php';

try {
    // Mengambil data statistik menggunakan PDO
    $stats = [
        'mahasiswa' => $db->query("SELECT COUNT(*) FROM mahasiswa")->fetchColumn(),
        'dosen' => $db->query("SELECT COUNT(*) FROM dosen")->fetchColumn(),
        'kategori' => $db->query("SELECT COUNT(*) FROM kategori")->fetchColumn(),
        'berita' => $db->query("SELECT COUNT(*) FROM berita")->fetchColumn()
    ];
    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Mahasiswa -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= htmlspecialchars($stats['mahasiswa']) ?></h3>
                        <p>Jumlah Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="index.php?p=mhs" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- Dosen -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= htmlspecialchars($stats['dosen']) ?></h3>
                        <p>Jumlah Dosen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="index.php?p=dosen" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- Kategori -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= htmlspecialchars($stats['kategori']) ?></h3>
                        <p>Jumlah Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <a href="index.php?p=kategori" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Berita Section -->
        <h1>Berita</h1>

        <div class="row">
            <?php
            $stmt = $db->query("SELECT b.*, k.nama_kategori, u.email as penulis 
                               FROM berita b 
                               JOIN kategori k ON b.kategori_id = k.id 
                               JOIN user u ON b.user_id = u.id 
                               ORDER BY b.id DESC");

            while ($berita = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <?php if ($berita['file_upload'] && file_exists("uploads/" . $berita['file_upload'])): ?>
                            <img src="uploads/<?= htmlspecialchars($berita['file_upload']) ?>" class="card-img-top"
                                alt="<?= htmlspecialchars($berita['judul']) ?>" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($berita['judul']) ?></h5>
                            <p class="text-muted small">
                                Kategori: <?= htmlspecialchars($berita['nama_kategori']) ?> |
                                Penulis: <?= htmlspecialchars($berita['penulis']) ?>
                            </p>
                            <p class="card-text">
                                <?= htmlspecialchars(substr($berita['isi_berita'], 0, 100)) ?>...
                            </p>
                            <a href="berita_detail.php?id=<?= $berita['id'] ?>" class="btn btn-primary mt-auto">Read More</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- Chart -->
        <div class="card mt-4">
            <div class="card-body">
                <canvas id="beritaChart" style="height: 400px; width: 100%;"></canvas>
            </div>
        </div>

        <script>
            // ChartJS setup untuk statistik
            var ctx = document.getElementById('beritaChart').getContext('2d');
            var beritaChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mahasiswa', 'Dosen', 'Kategori', 'Berita'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [
                            <?= $stats['mahasiswa'] ?>,
                            <?= $stats['dosen'] ?>,
                            <?= $stats['kategori'] ?>,
                            <?= $stats['berita'] ?>
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>

    <?php
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "<div class='alert alert-danger'>
            Terjadi kesalahan saat mengambil data. 
            Silakan coba lagi atau hubungi administrator.
          </div>";
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
}
?>