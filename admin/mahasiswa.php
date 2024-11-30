<?php
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
        ?>
        <div class="table-responsive small">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal Lahir</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = "SELECT mahasiswa.*, prodi.nama_prodi 
                               FROM mahasiswa 
                               JOIN prodi ON mahasiswa.prodi_id = prodi.id";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        
                        $no = 1;
                        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($data['nama_mhs']) ?></td>
                                <td><?= htmlspecialchars($data['tgl_lahir']) ?></td>
                                <td><?= htmlspecialchars($data['email']) ?></td>
                                <td><?= htmlspecialchars($data['notelp']) ?></td>
                                <td><?= htmlspecialchars($data['alamat']) ?></td>
                                <td><?= htmlspecialchars($data['nama_prodi']) ?></td>
                                <td>
                                    <a href="index.php?p=mhs&aksi=edit&nim=<?= $data['nim'] ?>" class="btn btn-success">Edit</a>
                                    <a href="proses_mahasiswa.php?proses=delete&nim=<?= $data['nim'] ?>" 
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
                </tbody>
            </table>
        </div>
        <?php
        break;

    case 'input':
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Registrasi Mahasiswa</h3>
            </div>
            <div class="card-body">
                <form action="proses_mahasiswa.php?proses=insert" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="number" class="form-control" name="nim" placeholder="NIM" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-4">
                                <select class="form-control" name="tgl" required>
                                    <option value="">-Tgl-</option>
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="bln" required>
                                    <option value="">-Bln-</option>
                                    <?php
                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    foreach ($bulan as $indexbulan => $namabulan) {
                                        echo "<option value='" . $indexbulan . "'>" . $namabulan . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="thn" required>
                                    <option value="">-Thn-</option>
                                    <?php
                                    for ($i = 2024; $i >= 1900; $i--) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="L" name="jekel" required>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="P" name="jekel">
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Hobi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="Membaca" name="hobi[]">
                            <label class="form-check-label">Membaca</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="Olahraga" name="hobi[]">
                            <label class="form-check-label">Olahraga</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="Travelling" name="hobi[]">
                            <label class="form-check-label">Travelling</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" name="notelp" placeholder="No Telp" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            </div>
                            <select class="form-control" name="prodi_id" required>
                                <option value="">Pilih Prodi</option>
                                <?php
                                try {
                                    $stmt = $db->query("SELECT * FROM prodi");
                                    while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $data_prodi['id'] . "'>" . 
                                             htmlspecialchars($data_prodi['nama_prodi']) . "</option>";
                                    }
                                } catch(PDOException $e) {
                                    error_log("Error loading prodi: " . $e->getMessage());
                                    echo "<option value=''>Error loading prodi</option>";
                                }
                                ?>
                            </select>
                        </div>
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
            $nim = $_GET['nim'];
            
            $stmt = $db->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
            $stmt->bindParam(':nim', $nim);
            $stmt->execute();
            
            $data_mhs = $stmt->fetch(PDO::FETCH_ASSOC);
            if($data_mhs) {
                $tgl = explode("-", $data_mhs['tgl_lahir']);
                $hobies = explode(",", $data_mhs['hobi']);
                ?>
                
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <form action="proses_mahasiswa.php?proses=edit" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="number" class="form-control" name="nim" 
                                       value="<?= htmlspecialchars($data_mhs['nim']) ?>" readonly>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama" 
                                       value="<?= htmlspecialchars($data_mhs['nama_mhs']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="row">
                                    <div class="col-4">
                                        <select class="form-control" name="tgl" required>
                                            <option value="">-Tgl-</option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = ($tgl[2] == $i) ? 'selected' : '';
                                                echo "<option value='" . $i . "' $selected>" . $i . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" name="bln" required>
                                            <option value="">-Bln-</option>
                                            <?php
                                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            foreach ($bulan as $indexbulan => $namabulan) {
                                                $selected = ($tgl[1] == $indexbulan) ? 'selected' : '';
                                                echo "<option value='" . $indexbulan . "' $selected>" . $namabulan . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" name="thn" required>
                                            <option value="">-Thn-</option>
                                            <?php
                                            for ($i = 2024; $i >= 1900; $i--) {
                                                $selected = ($tgl[0] == $i) ? 'selected' : '';
                                                echo "<option value='" . $i . "' $selected>" . $i . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="L" name="jekel" 
                                           <?= ($data_mhs['jekel'] == 'L') ? 'checked' : '' ?> required>
                                    <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="P" name="jekel" 
                                           <?= ($data_mhs['jekel'] == 'P') ? 'checked' : '' ?>>
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Hobi</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="Membaca" name="hobi[]" 
                                           <?= in_array('Membaca', $hobies) ? 'checked' : '' ?>>
                                    <label class="form-check-label">Membaca</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="Olahraga" name="hobi[]" 
                                           <?= in_array('Olahraga', $hobies) ? 'checked' : '' ?>>
                                    <label class="form-check-label">Olahraga</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="Travelling" name="hobi[]" 
                                           <?= in_array('Travelling', $hobies) ? 'checked' : '' ?>>
                                    <label class="form-check-label">Travelling</label>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" 
                                       value="<?= htmlspecialchars($data_mhs['email']) ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="number" class="form-control" name="notelp" 
                                       value="<?= htmlspecialchars($data_mhs['notelp']) ?>" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                <textarea class="form-control" rows="3" name="alamat" required><?= htmlspecialchars($data_mhs['alamat']) ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Prodi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                    </div>
                                    <select class="form-control" name="prodi_id" required>
                                        <option value="">Pilih Prodi</option>
                                        <?php
                                        try {
                                            $stmt_prodi = $db->query("SELECT * FROM prodi");
                                            while ($data_prodi = $stmt_prodi->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = ($data_mhs['prodi_id'] == $data_prodi['id']) ? 'selected' : '';
                                                echo "<option value='" . $data_prodi['id'] . "' $selected>" . 
                                                     htmlspecialchars($data_prodi['nama_prodi']) . "</option>";
                                            }
                                        } catch(PDOException $e) {
                                            error_log("Error loading prodi: " . $e->getMessage());
                                            echo "<option value=''>Error loading prodi</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            } else {
                echo "<div class='alert alert-danger'>Data mahasiswa tidak ditemukan</div>";
            }
        } catch(PDOException $e) {
            error_log("Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data</div>";
        }
        break;
}
?>
<script>
    new DataTable('#example');
</script>