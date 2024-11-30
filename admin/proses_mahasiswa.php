<?php
include 'koneksi.php';

try {
    if ($_GET['proses'] == 'insert') {
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(",", $_POST['hobi']);

        $sql = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, jekel, hobi, email, notelp, alamat, prodi_id) 
                VALUES (:nim, :nama, :tgl, :jekel, :hobi, :email, :notelp, :alamat, :prodi_id)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nim', $_POST['nim']);
        $stmt->bindParam(':nama', $_POST['nama']);
        $stmt->bindParam(':tgl', $tgl);
        $stmt->bindParam(':jekel', $_POST['jekel']);
        $stmt->bindParam(':hobi', $hobies);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':notelp', $_POST['notelp']);
        $stmt->bindParam(':alamat', $_POST['alamat']);
        $stmt->bindParam(':prodi_id', $_POST['prodi_id']);

        if ($stmt->execute()) {
            echo "<script>window.location='index.php?p=mhs'</script>";
        } else {
            throw new Exception("Gagal menyimpan data");
        }
    }

    if ($_GET['proses'] == 'edit') {
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(",", $_POST['hobi']);

        $sql = "UPDATE mahasiswa SET 
                nama_mhs = :nama,
                tgl_lahir = :tgl,
                jekel = :jekel,
                hobi = :hobi,
                email = :email,
                notelp = :notelp,
                alamat = :alamat,
                prodi_id = :prodi_id
                WHERE nim = :nim";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nama', $_POST['nama']);
        $stmt->bindParam(':tgl', $tgl);
        $stmt->bindParam(':jekel', $_POST['jekel']);
        $stmt->bindParam(':hobi', $hobies);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':notelp', $_POST['notelp']);
        $stmt->bindParam(':alamat', $_POST['alamat']);
        $stmt->bindParam(':prodi_id', $_POST['prodi_id']);
        $stmt->bindParam(':nim', $_POST['nim']);

        if ($stmt->execute()) {
            echo "<script>window.location='index.php?p=mhs'</script>";
        } else {
            throw new Exception("Gagal mengupdate data");
        }
    }

    if ($_GET['proses'] == 'delete') {
        $sql = "DELETE FROM mahasiswa WHERE nim = :nim";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nim', $_GET['nim']);

        if ($stmt->execute()) {
            header('location:index.php?p=mhs');
            exit();
        } else {
            throw new Exception("Gagal menghapus data");
        }
    }

} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "<script>
            alert('Terjadi kesalahan database: Silakan coba lagi atau hubungi administrator');
            window.location='index.php?p=mhs';
          </script>";
} catch (Exception $e) {
    error_log("General Error: " . $e->getMessage());
    echo "<script>
            alert('Terjadi kesalahan: " . $e->getMessage() . "');
            window.location='index.php?p=mhs';
          </script>";
}
?>