<?php
include 'koneksi.php';

try {
    if ($_GET['proses'] == 'insert') {
        $sql = "INSERT INTO dosen (nik, nama_dosen, email, prodi_id, notelp, alamat) 
                VALUES (:nik, :nama_dosen, :email, :prodi_id, :notelp, :alamat)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nik' => $_POST['nik'],
            ':nama_dosen' => $_POST['nama_dosen'],
            ':email' => $_POST['email'],
            ':prodi_id' => $_POST['prodi_id'],
            ':notelp' => $_POST['notelp'],
            ':alamat' => $_POST['alamat']
        ]);

        if ($stmt) {
            echo "<script>window.location='index.php?p=dosen'</script>";
        }
    }

    if ($_GET['proses'] == 'edit') {
        $sql = "UPDATE dosen SET 
                nik = :nik,
                nama_dosen = :nama_dosen,
                email = :email,
                prodi_id = :prodi_id,
                notelp = :notelp,
                alamat = :alamat 
                WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nik' => $_POST['nik'],
            ':nama_dosen' => $_POST['nama_dosen'],
            ':email' => $_POST['email'],
            ':prodi_id' => $_POST['prodi_id'],
            ':notelp' => $_POST['notelp'],
            ':alamat' => $_POST['alamat'],
            ':id' => $_POST['id']
        ]);

        if ($stmt) {
            echo "<script>window.location='index.php?p=dosen'</script>";
        }
    }

    if ($_GET['proses'] == 'delete') {
        $sql = "DELETE FROM dosen WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $_GET['id']]);
        
        if ($stmt) {
            header('location:index.php?p=dosen');
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>