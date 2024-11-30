<h2>Data Dosen</h2>

<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>No Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            include 'admin/koneksi.php';
            
            // Gunakan prepared statement
            $sql = "SELECT dosen.*, prodi.nama_prodi 
                   FROM dosen 
                   JOIN prodi ON dosen.prodi_id = prodi.id";
            
            $stmt = $db->prepare($sql);
            $stmt->execute();
            
            $no = 1;
            while($data_dosen = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($data_dosen['nip']) ?></td>
                <td><?= htmlspecialchars($data_dosen['nama_dosen']) ?></td>
                <td><?= htmlspecialchars($data_dosen['email']) ?></td>
                <td><?= htmlspecialchars($data_dosen['nama_prodi']) ?></td> 
                <td><?= htmlspecialchars($data_dosen['notelp']) ?></td>
                <td><?= htmlspecialchars($data_dosen['alamat']) ?></td>
            </tr>
            <?php
                $no++;
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </tbody>
</table>