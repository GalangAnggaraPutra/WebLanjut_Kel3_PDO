<?php
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
    </div>

    

    <div class="table-responsive small">
        <table class="table table-bordered table-striped table-sm" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Nama Lengkap</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Photo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            try {
                $query = "SELECT u.*, l.nama_level 
                         FROM user u 
                         INNER JOIN level l ON l.id = u.level_id";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $no = 1;
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['nama_level'] ?></td>
                        <td><?= $data['nama_lengkap'] ?></td>
                        <td><?= $data['notelp'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td>
                            <?php if (!empty($data['photo'])): ?>
                                <img src="upload/<?= $data['photo'] ?>" width="50">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?p=user&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="proses_user.php?proses=delete&id=<?= $data['id'] ?>&file=<?= $data['photo'] ?>" 
                               class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">
                                <i class="bi bi-x-circle"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
    break;
    
    case 'input':
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah User</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="proses_user.php?proses=insert" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select name="level_id" class="form-control" required>
                        <option value="">Pilih Level</option>
                        <?php
                        $query = "SELECT * FROM level ORDER BY nama_level ASC";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                        while ($level = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$level['id']}'>{$level['nama_level']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="text" name="notelp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php?p=user" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<?php
    break;
    
    case 'edit':
    try {
        $id = $_GET['id'];
        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="proses_user.php?proses=update" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <input type="hidden" name="photo_lama" value="<?= $data['photo'] ?>">
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select name="level_id" class="form-control" required>
                        <option value="">Pilih Level</option>
                        <?php
                        $query = "SELECT * FROM level ORDER BY nama_level ASC";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                        while ($level = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($level['id'] == $data['level_id']) ? 'selected' : '';
                            echo "<option value='{$level['id']}' {$selected}>{$level['nama_level']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="text" name="notelp" class="form-control" value="<?= $data['notelp'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <?php if (!empty($data['photo'])): ?>
                        <div class="mb-2">
                            <img src="upload/<?= $data['photo'] ?>" width="100">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah photo</small>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="index.php?p=user" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<?php
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    break;
}
?>