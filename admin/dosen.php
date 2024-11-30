<?php
require_once 'koneksi.php'; // Pastikan file koneksi sudah menggunakan PDO
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
        ?>
        <div class="row">


            <div class="table-responsive small">
                <table class="table table-bordered">
                    <tr>
                        <th>id</th>
                        <th>nik</th>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>NO Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    try {
                        $stmt = $db->query("SELECT dosen.*, prodi.nama_prodi 
                                            FROM dosen 
                                            JOIN prodi ON dosen.prodi_id = prodi.id");
                        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($data['id']) ?></td>
                                <td><?= htmlspecialchars($data['nik']) ?></td>
                                <td><?= htmlspecialchars($data['nama_dosen']) ?></td>
                                <td><?= htmlspecialchars($data['email']) ?></td>
                                <td><?= htmlspecialchars($data['nama_prodi']) ?></td>
                                <td><?= htmlspecialchars($data['notelp']) ?></td>
                                <td><?= htmlspecialchars($data['alamat']) ?></td>
                                <td>
                                    <a href="index.php?p=dosen&aksi=edit&id=<?= htmlspecialchars($data['id']) ?>" class="btn btn-success">Edit</a>
                                    <a href="proses_dosen.php?proses=delete&id=<?= htmlspecialchars($data['id']) ?>" class="btn btn-danger"
                                        onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>

                </table>
            </div>
        </div>

        <?php
        break;

    case 'input':
        ?>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Registrasi Dosen</h3>
            </div>
            <div class="card-body">
                <form action="proses_dosen.php?proses=insert" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="number" class="form-control" name="nik" placeholder="nik">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama_dosen" placeholder="Nama Dosen">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            </div>
                            <select name="prodi_id" class="form-control">
                                <option value="">Pilih Prodi</option>
                                <?php
                                try {
                                    $stmt = $db->query("SELECT * FROM prodi");
                                    while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . htmlspecialchars($data_prodi['id']) . "'>" . 
                                             htmlspecialchars($data_prodi['nama_prodi']) . "</option>";
                                    }
                                } catch(PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" name="notelp" placeholder="No Telp">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat"></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

        <?php
        break;

    case 'edit':
        try {
            $stmt = $db->prepare("SELECT * FROM dosen WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $data_dosen = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data_dosen) {
                echo "Data dosen tidak ditemukan";
                exit;
            }
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Dosen</h3>
                </div>
                <div class="card-body">
                    <form action="proses_dosen.php?proses=edit" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($data_dosen['id']) ?>">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="number" name="nik" value="<?= htmlspecialchars($data_dosen['nik']) ?>"
                                placeholder="nik">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="nama_dosen" value="<?= htmlspecialchars($data_dosen['nama_dosen']) ?>"
                                placeholder="Nama Dosen">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" value="<?= htmlspecialchars($data_dosen['email']) ?>"
                                placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>Prodi</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                </div>
                                <select name="prodi_id" class="form-control">
                                    <option value="" selected>Pilih Prodi</option>
                                    <?php
                                    $stmt = $db->query("SELECT * FROM prodi");
                                    while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = ($data_dosen['prodi_id'] == $data_prodi['id']) ? 'selected' : '';
                                        echo "<option value='" . htmlspecialchars($data_prodi['id']) . "' $selected>" . 
                                             htmlspecialchars($data_prodi['nama_prodi']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="number" name="notelp" value="<?= htmlspecialchars($data_dosen['notelp']) ?>"
                                placeholder="No Telp">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            <textarea class="form-control" rows="3" name="alamat"
                                placeholder="Alamat"><?= htmlspecialchars($data_dosen['alamat']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <?php
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
}
?>