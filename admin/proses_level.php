<?php
include 'koneksi.php';

try {
    if ($_GET['proses'] == 'insert') {
        $query = "INSERT INTO level (nama_level, keterangan) VALUES (:nama_level, :keterangan)";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(':nama_level', $_POST['nama_level']);
        $stmt->bindParam(':keterangan', $_POST['keterangan']);
        $result = $stmt->execute();
        
        if ($result) {
            header('Location: index.php?p=level');
        }
    } 
    else if ($_GET['proses'] == 'edit') {
        $query = "UPDATE level SET 
                 nama_level = :nama_level, 
                 keterangan = :keterangan 
                 WHERE id = :id";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nama_level', $_POST['nama_level']);
        $stmt->bindParam(':keterangan', $_POST['keterangan']);
        $stmt->bindParam(':id', $_POST['id']);
        $result = $stmt->execute();
        
        if ($result) {
            header('Location: index.php?p=level');
        }
    } 
    else if ($_GET['proses'] == 'delete') {
        // Hapus data level
        $query = "DELETE FROM level WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $_GET['id']);
        $result = $stmt->execute();
        
        if ($result) {
            header('Location: index.php?p=level');
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>