<h2>Data Mahasiswa</h2>

<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Prodi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            include 'admin/koneksi.php';
            
            // Gunakan prepared statement
            $sql = "SELECT mahasiswa.*, prodi.nama_prodi 
                   FROM mahasiswa 
                   JOIN prodi ON mahasiswa.prodi_id = prodi.id";
                   
            $stmt = $db->prepare($sql);
            $stmt->execute();
            
            $no = 1;
            while($data_mhs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($data_mhs['nim']) ?></td>
                <td><?= htmlspecialchars($data_mhs['nama_mhs']) ?></td>
                <td><?= htmlspecialchars($data_mhs['email']) ?></td>
                <td><?= htmlspecialchars($data_mhs['notelp']) ?></td>
                <td><?= htmlspecialchars($data_mhs['alamat']) ?></td>
                <td><?= htmlspecialchars($data_mhs['nama_prodi']) ?></td>
            </tr>
            <?php
                $no++;
            }
        } catch(PDOException $e) {
            // Log error dan tampilkan pesan user-friendly
            error_log("Database Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.</div>";
        } catch(Exception $e) {
            error_log("General Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan. Silakan coba lagi nanti.</div>";
        }
        ?>
    </tbody>
</table>