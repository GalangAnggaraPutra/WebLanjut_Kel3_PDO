<h2>Data Mata Kuliah</h2>

<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Kode Matakuliah</th>
            <th>Nama Matakuliah</th>
            <th>Semester</th>
            <th>Jenis Matakuliah</th>
            <th>SKS</th>
            <th>Jam</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            include 'admin/koneksi.php';
            
            // Gunakan prepared statement
            $sql = "SELECT * FROM matakuliah";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?= htmlspecialchars($data['id']) ?></td>
                    <td><?= htmlspecialchars($data['kode_matakuliah']) ?></td>
                    <td><?= htmlspecialchars($data['nama_matakuliah']) ?></td>
                    <td><?= htmlspecialchars($data['semester']) ?></td>
                    <td><?= htmlspecialchars($data['jenis_matakuliah']) ?></td>
                    <td><?= htmlspecialchars($data['sks']) ?></td>
                    <td><?= htmlspecialchars($data['jam']) ?></td>
                    <td><?= htmlspecialchars($data['keterangan']) ?></td>
                </tr>
                <?php
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