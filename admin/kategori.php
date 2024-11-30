<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
        ?>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
                <?php
                try {
                    include 'koneksi.php';
                    $stmt = $db->prepare("SELECT * FROM kategori");
                    $stmt->execute();
                    
                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($data['id']) ?></td>
                            <td><?= htmlspecialchars($data['nama_kategori']) ?></td>
                            <td><?= htmlspecialchars($data['keterangan']) ?></td>
                            <td>
                                <a href="index.php?p=kategori&aksi=edit&id=<?= $data['id'] ?>" 
                                   class="btn btn-success">Edit</a>
                                <a href="proses_kategori.php?proses=delete&id=<?= $data['id'] ?>" 
                                   class="btn btn-danger"
                                   onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } catch(PDOException $e) {
                    error_log("Error: " . $e->getMessage());
                    echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data</div>";
                }
                ?>
            </table>
        </div>
        <?php
        break;

    case 'input':
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Data Kategori</h3>
            </div>
            <div class="card-body">
                <form action="proses_kategori.php?proses=insert" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama_kategori" 
                               placeholder="Nama Kategori" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                        </div>
                        <textarea class="form-control" name="keterangan" rows="3" 
                                  placeholder="Keterangan" required></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        break;

    case 'edit':
        try {
            include 'koneksi.php';
            $stmt = $db->prepare("SELECT * FROM kategori WHERE id = :id");
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            
            $data_kategori = $stmt->fetch(PDO::FETCH_ASSOC);
            if($data_kategori) {
                ?>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Kategori</h3>
                    </div>
                    <div class="card-body">
                        <form action="proses_kategori.php?proses=edit" method="post">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($data_kategori['id']) ?>">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama_kategori"
                                       value="<?= htmlspecialchars($data_kategori['nama_kategori']) ?>" 
                                       placeholder="Nama Kategori" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                </div>
                                <textarea class="form-control" name="keterangan" rows="5"
                                          placeholder="Keterangan" required><?= htmlspecialchars($data_kategori['keterangan']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            } else {
                echo "<div class='alert alert-danger'>Data kategori tidak ditemukan</div>";
            }
        } catch(PDOException $e) {
            error_log("Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data</div>";
        }
        break;
}
?>