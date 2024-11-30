<h1>Berita</h1>

<div class="row">
    <?php
    try {
        include 'admin/koneksi.php';
        
        // Gunakan prepared statement
        $sql = "SELECT * FROM berita ORDER BY id DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        while($berita = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="col-4 mb-3">
            <div class="card">
                <img src="admin/uploads/<?= htmlspecialchars($berita['file_upload']) ?>" 
                     class="card-img-top" 
                     alt="<?= htmlspecialchars($berita['judul']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($berita['judul']) ?></h5>
                    <p class="card-text">
                        <?= htmlspecialchars(substr($berita['isi_berita'], 0, 150)) ?>...
                    </p>
                    <a href="#" class="btn btn-primary">Readmore..</a>
                </div>
            </div>
        </div>
        <?php
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</div>