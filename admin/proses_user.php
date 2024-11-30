<?php
include 'koneksi.php';

try {
    if ($_GET['proses'] == 'insert') {
        // Handle file upload
        $photo = '';
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
            $target_dir = "upload/";
            $photo = time() . "_" . basename($_FILES["fileToUpload"]["name"]);
            $target_file = $target_dir . $photo;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }

        $query = "INSERT INTO user (email, password, level_id, nama_lengkap, notelp, alamat, photo) 
                 VALUES (:email, :password, :level_id, :nama_lengkap, :notelp, :alamat, :photo)";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', md5($_POST['password']));
        $stmt->bindParam(':level_id', $_POST['level_id']);
        $stmt->bindParam(':nama_lengkap', $_POST['nama_lengkap']);
        $stmt->bindParam(':notelp', $_POST['notelp']);
        $stmt->bindParam(':alamat', $_POST['alamat']);
        $stmt->bindParam(':photo', $photo);
        
        $result = $stmt->execute();
        
        if ($result) {
            header("Location: index.php?p=user&aksi=list");
        }
    } 
    else if ($_GET['proses'] == 'edit') {
        $photo = '';
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
            $target_dir = "upload/";
            $photo = time() . "_" . basename($_FILES["fileToUpload"]["name"]);
            $target_file = $target_dir . $photo;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            
            $query = "UPDATE user SET 
                     email = :email,
                     password = :password,
                     level_id = :level_id,
                     nama_lengkap = :nama_lengkap,
                     notelp = :notelp,
                     alamat = :alamat,
                     photo = :photo 
                     WHERE id = :id";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':photo', $photo);
        } else {
            $query = "UPDATE user SET 
                     email = :email,
                     password = :password,
                     level_id = :level_id,
                     nama_lengkap = :nama_lengkap,
                     notelp = :notelp,
                     alamat = :alamat 
                     WHERE id = :id";
            
            $stmt = $db->prepare($query);
        }
        
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', md5($_POST['password']));
        $stmt->bindParam(':level_id', $_POST['level_id']);
        $stmt->bindParam(':nama_lengkap', $_POST['nama_lengkap']);
        $stmt->bindParam(':notelp', $_POST['notelp']);
        $stmt->bindParam(':alamat', $_POST['alamat']);
        $stmt->bindParam(':id', $_POST['id']);
        
        $result = $stmt->execute();
        
        if ($result) {
            header("Location: index.php?p=user&aksi=list");
        }
    } 
    else if ($_GET['proses'] == 'delete') {
        // Hapus file foto jika ada
        if (!empty($_GET['file'])) {
            $file_path = "upload/" . $_GET['file'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        $query = "DELETE FROM user WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $_GET['id']);
        $result = $stmt->execute();
        
        if ($result) {
            header("Location: index.php?p=user&aksi=list");
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>