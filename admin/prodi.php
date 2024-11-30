<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
        ?>

        <div class="row">
            <div class="table-responsive small">
                <table id="example" class="table table-striped table-bordered">
                    <thead> 
                        <tr>
                            <th>ID</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang Studi</th>
                            <th>Aksi</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            include 'koneksi.php';
                            $stmt = $db->query("SELECT * FROM prodi");
                            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?= $data['id'] ?></td>
                                    <td><?= $data['nama_prodi'] ?></td>
                                    <td><?= $data['jenjang_std'] ?></td>
                                    <td>
                                        <a href="index.php?p=prodi&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success">
                                            <i class="bi bi-pencil"></i>Edit
                                        </a>
                                        <a href="proses_prodi.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger"
                                            onclick="return confirm('Yakin mau dihapus?')">
                                            <i class="bi bi-trash"></i>Delete
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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Form Data Prodi</h3>
                </div>
                <div class="card-body">
                    <form action="proses_prodi.php?proses=insert" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_prodi" placeholder="Nama Prodi">
                        </div>

                        <div class="form-group">
                            <label>Jenjang Studi</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                </div>
                                <select class="form-control" name="jenjang_std">
                                    <option selected>~ Pilih Jenjang Studi ~</option>
                                    <?php
                                    $jenjang_std = ['D3', 'D4', 'S1', 'S2'];
                                    foreach ($jenjang_std as $jenjangprodi) {
                                        echo "<option value='" . $jenjangprodi . "'>" . $jenjangprodi . "</option>";
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
                <!-- /.card-body -->
            </div>

            <?php
            break;

    case 'edit':
        ?>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Prodi</h3>
                </div>
                <div class="card-body">
                    <form action="proses_prodi.php?proses=insert" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_prodi" placeholder="Nama Prodi">
                        </div>

                        <div class="form-group">
                            <label>Jenjang Studi</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                </div>
                                <select class="form-control" name="jenjang_std">
                                    <option selected>~ Pilih Jenjang Studi ~</option>
                                    <?php
                                    $jenjang_std = ['D3', 'D4', 'S1', 'S2'];
                                    foreach ($jenjang_std as $jenjangprodi) {
                                        echo "<option value='" . $jenjangprodi . "'>" . $jenjangprodi . "</option>";
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
                <!-- /.card-body -->
            </div>

            <?php
            break;

}
?>