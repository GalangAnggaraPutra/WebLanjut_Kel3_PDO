<?php
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
        ?>
        <div class="table-responsive small">
            <table class="table table-bordered table-striped table-sm" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = "SELECT berita.*, kategori.nama_kategori, user.email 
                               FROM berita 
                               JOIN user ON user.id = berita.user_id 
                               JOIN kategori ON kategori.id = berita.kategori_id";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();

                        $no = 1;
                        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($data['judul']) ?></td>
                                <td><?= htmlspecialchars($data['nama_kategori']) ?></td>
                                <td><?= htmlspecialchars($data['email']) ?></td>
                                <td><?= htmlspecialchars($data['created_at']) ?></td>
                                <td>
                                    <a href="index.php?p=berita&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="proses_berita.php?proses=delete&id=<?= $data['id'] ?>&file=<?= urlencode($data['file_upload']) ?>"
                                        class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">
                                        <i class="bi bi-x-circle"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } catch (PDOException $e) {
                        error_log("Error: " . $e->getMessage());
                        echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data</div>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        break;

    case 'input':
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Berita</h3>
            </div>
            <div class="card-body">
                <form action="proses_berita.php?proses=insert" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div>
                        <input type="text" class="form-control" name="judul" placeholder="Judul" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            </div>
                            <select class="form-control" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                <?php
                                try {
                                    $stmt = $db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC");
                                    while ($data_kategori = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $data_kategori['id'] . "'>" . 
                                             htmlspecialchars($data_kategori['nama_kategori']) . "</option>";
                                    }
                                } catch (PDOException $e) {
                                    error_log("Error loading kategori: " . $e->getMessage());
                                    echo "<option value=''>Error loading kategori</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file-upload" 
                                   name="fileToUpload" accept="image/*" required>
                            <label class="custom-file-label" for="file-upload">Choose file</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preview Gambar</label>
                        <img src="#" alt="Preview Uploaded Image" id="file-preview" 
                             width="300" style="display: none;">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                        </div>
                        <textarea class="form-control" name="isi_berita" rows="5" 
                                  placeholder="Isi Berita" required></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.getElementById("file-upload").addEventListener("change", function (event) {
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById("file-preview");
                    output.src = reader.result;
                    output.style.display = "block";
                };
                reader.readAsDataURL(event.target.files[0]);

                // Update label with file name
                var fileName = event.target.files[0].name;
                document.querySelector('.custom-file-label').textContent = fileName;
            });
        </script>
        <?php
        break;

    case 'edit':
        try {
            $stmt = $db->prepare("SELECT * FROM berita WHERE id = :id");
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            
            $data_berita = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data_berita) {
                ?>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Berita</h3>
                    </div>
                    <div class="card-body">
                        <form action="proses_berita.php?proses=edit" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($data_berita['id']) ?>">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                </div>
                                <input type="text" class="form-control" name="judul" 
                                       value="<?= htmlspecialchars($data_berita['judul']) ?>" 
                                       placeholder="Judul" required>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <select class="form-control" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php
                                        try {
                                            $stmt_kategori = $db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC");
                                            while ($data_kategori = $stmt_kategori->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($data_kategori['id'] == $data_berita['kategori_id']) ? 'selected' : '';
                                                echo "<option value='" . $data_kategori['id'] . "' $selected>" . 
                                                     htmlspecialchars($data_kategori['nama_kategori']) . "</option>";
                                            }
                                        } catch (PDOException $e) {
                                            error_log("Error loading kategori: " . $e->getMessage());
                                            echo "<option value=''>Error loading kategori</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileToUpload" 
                                           id="file-upload" accept="image/*">
                                    <label class="custom-file-label" for="file-upload">Choose new file</label>
                                </div>
                                <input type="hidden" name="existing_image" 
                                       value="<?= htmlspecialchars($data_berita['file_upload']) ?>">
                            </div>

                            <div class="mb-3">
                                <label>Gambar Saat Ini:</label>
                                <img src="uploads/<?= htmlspecialchars($data_berita['file_upload']) ?>" 
                                     alt="Current Image" width="300" class="d-block mb-2">
                                
                                <label>Preview Gambar Baru:</label>
                                <img src="#" alt="Preview Image" id="file-preview" 
                                     width="300" style="display: none;">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                                </div>
                                <textarea class="form-control" name="isi_berita" rows="5" 
                                          required><?= htmlspecialchars($data_berita['isi_berita']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                <a href="index.php?p=berita" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    document.getElementById("file-upload").addEventListener("change", function (event) {
                        var reader = new FileReader();
                        reader.onload = function () {
                            var output = document.getElementById('file-preview');
                            output.src = reader.result;
                            output.style.display = 'block';
                        };
                        reader.readAsDataURL(event.target.files[0]);

                        // Update label with file name
                        var fileName = event.target.files[0].name;
                        document.querySelector('.custom-file-label').textContent = fileName;
                    });
                </script>
                <?php
            } else {
                echo "<div class='alert alert-danger'>Data berita tidak ditemukan</div>";
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data</div>";
        }
        break;
}
?>