<h2>Data Prodi</h2>

<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>Prodi ID</th>
            <th>Nama Prodi</th>
            <th>Jenjang Studi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            include 'admin/koneksi.php';

            // Gunakan prepared statement
            $sql = "SELECT * FROM prodi";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $no = 1;
            while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= htmlspecialchars($data_prodi['id']) ?></td>
                    <td><?= htmlspecialchars($data_prodi['nama_prodi']) ?></td>
                    <td><?= htmlspecialchars($data_prodi['jenjang_std']) ?></td>
                </tr>
                <?php
                $no++;
            }
        } catch (PDOException $e) {
            // Log error dan tampilkan pesan user-friendly
            error_log("Database Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.</div>";
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            echo "<div class='alert alert-danger'>Terjadi kesalahan. Silakan coba lagi nanti.</div>";
        }
        ?>
    </tbody>
</table>