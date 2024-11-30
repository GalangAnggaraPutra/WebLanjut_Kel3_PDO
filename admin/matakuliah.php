<?php
require_once 'koneksi.php';

// Cek koneksi
if (!isset($db)) {
    die('Koneksi database tidak tersedia');
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
        ?>
        <div class="table-responsive small">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Kode Matakuliah</th>
                        <th>Nama Matakuliah</th>
                        <th>Semester</th>
                        <th>Jenis Matakuliah</th>
                        <th>Sks</th>
                        <th>Jam</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM matakuliah";
                    $stmt = $db->query($sql);
                    $data = $stmt->fetchAll();
                    foreach ($data as $row) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['kode_matkul']) ?></td>
                            <td><?= htmlspecialchars($row['nama_matkul']) ?></td>
                            <td><?= htmlspecialchars($row['semester']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_matkul']) ?></td>
                            <td><?= htmlspecialchars($row['sks']) ?></td>
                            <td><?= htmlspecialchars($row['jam']) ?></td>
                            <td><?= htmlspecialchars($row['keterangan']) ?></td>
                            <td>
                                <a href="index.php?p=matkul&aksi=edit&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-success">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="proses_matakuliah.php?proses=delete&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger"
                                    onclick="return confirm('Yakin mau dihapus?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        break;

    case 'input':
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Mata Kuliah</h3>
            </div>
            <div class="card-body">
                <form action="proses_matakuliah.php?proses=insert" method="post">
                    <!-- Hidden field for the id -->
                    <input type="hidden" name="id">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                        </div>
                        <input type="text" class="form-control" name="kode_matkul" placeholder="Kode Matakuliah" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama_matkul" placeholder="Nama Matakuliah" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                        </div>
                        <input type="number" class="form-control" name="semester" placeholder="Semester" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                        </div>
                        <select class="form-control" name="jenis_matkul" required>
                            <option value="">Pilih Jenis Matakuliah</option>
                            <option value="Teori">Teori</option>
                            <option value="Praktek">Praktek</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        </div>
                        <input type="number" class="form-control" name="sks" placeholder="SKS" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        </div>
                        <input type="number" class="form-control" name="jam" placeholder="Jam" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                        </div>
                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary"> Submit</button>
                        <button type="reset" class="btn btn-warning"> Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        break;

    case 'edit':
        try {
            $stmt = $db->prepare("SELECT * FROM matakuliah WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $data = $stmt->fetch();
            
            if (!$data) {
                throw new Exception("Data tidak ditemukan");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Edit Mata Kuliah</h3>
            </div>
            <div class="card-body">
                <form action="proses_matakuliah.php?proses=edit" method="post">
                    <!-- Hidden field for the id - Added value attribute -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                        </div>
                        <input type="text" class="form-control" name="kode_matkul"
                            value="<?= htmlspecialchars($data['kode_matkul']) ?>" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama_matkul"
                            value="<?= htmlspecialchars($data['nama_matkul']) ?>" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                        </div>
                        <input type="number" class="form-control" name="semester"
                            value="<?= htmlspecialchars($data['semester']) ?>" min="1" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                        </div>
                        <select class="form-control" name="jenis_matkul" required>
                            <option value="">Pilih Jenis Matakuliah</option>
                            <option value="Teori" <?= ($data['jenis_matkul'] == 'Teori') ? 'selected' : '' ?>>Teori</option>
                            <option value="Praktek" <?= ($data['jenis_matkul'] == 'Praktek') ? 'selected' : '' ?>>Praktek
                            </option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        </div>
                        <input type="number" class="form-control" name="sks" value="<?= htmlspecialchars($data['sks']) ?>"
                            min="1" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        </div>
                        <input type="number" class="form-control" name="jam" value="<?= htmlspecialchars($data['jam']) ?>"
                            min="1" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                        </div>
                        <input type="text" class="form-control" name="keterangan"
                            value="<?= htmlspecialchars($data['keterangan']) ?>">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        break;
}
?>
<script>
    new DataTable('#example');
</script>