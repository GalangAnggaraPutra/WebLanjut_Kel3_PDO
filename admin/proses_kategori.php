<?php
include 'koneksi.php';

try {
    if ($_GET['proses'] == 'insert') {
        $sql = "INSERT INTO kategori (nama_kategori, keterangan) 
                VALUES (:nama_kategori, :keterangan)";
                
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nama_kategori', $_POST['nama_kategori']);
        $stmt->bindParam(':keterangan', $_POST['keterangan']);
        
        if($stmt->execute()) {
            echo "<script>window.location='index.php?p=kategori'</script>";
        } else {
            throw new Exception("Gagal menyimpan data");
        }
    }

    if ($_GET['proses'] == 'edit') {
        $sql = "UPDATE kategori SET
                nama_kategori = :nama_kategori,
                keterangan = :keterangan 
                WHERE id = :id";
                
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nama_kategori', $_POST['nama_kategori']);
        $stmt->bindParam(':keterangan', $_POST['keterangan']);
        $stmt->bindParam(':id', $_POST['id']);
        
        if($stmt->execute()) {
            echo "<script>window.location='index.php?p=kategori'</script>";
        } else {
            throw new Exception("Gagal mengupdate data");
        }
    }

    if ($_GET['proses'] == 'delete') {
        $sql = "DELETE FROM kategori WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        
        if($stmt->execute()) {
            header('location:index.php?p=kategori');
            exit();
        } else {
            throw new Exception("Gagal menghapus data");
        }
    }

} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "<script>
            alert('Terjadi kesalahan database: Silakan coba lagi atau hubungi administrator');
            window.location='index.php?p=kategori';
          </script>";
} catch(Exception $e) {
    error_log("General Error: " . $e->getMessage());
    echo "<script>
            alert('Terjadi kesalahan: " . $e->getMessage() . "');
            window.location='index.php?p=kategori';
          </script>";
}
?>