<?php
include 'koneksi.php';

try {
    // Validasi ID
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID berita tidak valid");
    }

    // Ambil data berita dengan prepared statement
    $sql = "SELECT berita.*, kategori.nama_kategori, user.email as penulis 
            FROM berita 
            JOIN kategori ON berita.kategori_id = kategori.id 
            JOIN user ON berita.user_id = user.id 
            WHERE berita.id = :id";
            
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    
    $berita = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$berita) {
        throw new Exception("Berita tidak ditemukan");
    }
    ?>

    <div class="container my-5">
        <div class="card shadow-lg">
            <?php if($berita['file_upload'] && file_exists("uploads/" . $berita['file_upload'])): ?>
                <img src="uploads/<?= htmlspecialchars($berita['file_upload']) ?>" 
                     class="card-img-top img-fluid" 
                     alt="<?= htmlspecialchars($berita['judul']) ?>"
                     style="max-height: 400px; object-fit: cover;">
            <?php endif; ?>
            
            <div class="card-body">
                <h2 class="card-title text-center mb-4"><?= htmlspecialchars($berita['judul']) ?></h2>
                
                <div class="mb-3 text-muted">
                    <small>
                        Kategori: <?= htmlspecialchars($berita['nama_kategori']) ?> | 
                        Penulis: <?= htmlspecialchars($berita['penulis']) ?> | 
                        Tanggal: <?= date('d/m/Y H:i', strtotime($berita['created_at'])) ?>
                    </small>
                </div>
                
                <p class="card-text text-justify" style="line-height: 1.6;">
                    <?= nl2br(htmlspecialchars($berita['isi_berita'])) ?>
                </p>
                
                <div class="mt-4">
                    <a href="index.php?p=dashboard" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-text {
            font-size: 16px;
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .text-justify {
            text-align: justify;
        }
    </style>

    <?php
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "<div class='alert alert-danger'>
            Terjadi kesalahan saat mengambil data. 
            Silakan coba lagi atau hubungi administrator.
          </div>";
} catch(Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
}
?>