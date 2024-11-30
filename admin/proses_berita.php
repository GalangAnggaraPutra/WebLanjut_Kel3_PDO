<?php
include 'koneksi.php';
session_start();

try {
    $target_dir = "uploads/";
    $uploadOk = 1;
    
    if ($_GET['proses'] == 'insert') {
        // Handle file upload
        $nama_file = rand() . '-' . basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $nama_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }
        }

        if (file_exists($target_file)) {
            throw new Exception("Sorry, file already exists.");
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            throw new Exception("Sorry, your file is too large.");
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Upload file
        if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            throw new Exception("Sorry, there was an error uploading your file.");
        }

        // Insert data
        $sql = "INSERT INTO berita (user_id, kategori_id, judul, file_upload, isi_berita, created_at) 
                VALUES (:user_id, :kategori_id, :judul, :file_upload, :isi_berita, :created_at)";
        
        $stmt = $db->prepare($sql);
        $created_at = date('Y-m-d H:i:s');
        
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':kategori_id', $_POST['kategori_id']);
        $stmt->bindParam(':judul', $_POST['judul']);
        $stmt->bindParam(':file_upload', $nama_file);
        $stmt->bindParam(':isi_berita', $_POST['isi_berita']);
        $stmt->bindParam(':created_at', $created_at);
        
        if(!$stmt->execute()) {
            throw new Exception("Gagal menyimpan berita!");
        }
        
        header('Location: index.php?p=berita');
        exit();
    }

    if ($_GET['proses'] == 'edit') {
        $id = $_POST['id'];
        $existing_image = $_POST['existing_image'];
        $file_upload = $existing_image;

        // Handle new file upload if exists
        if ($_FILES['fileToUpload']['name']) {
            $file_upload = rand() . '-' . $_FILES['fileToUpload']['name'];
            $target_file = $target_dir . $file_upload;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate new file
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }

            if ($_FILES["fileToUpload"]["size"] > 500000) {
                throw new Exception("Sorry, your file is too large.");
            }

            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Upload new file
            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                throw new Exception("Sorry, there was an error uploading your file.");
            }

            // Delete old file
            if (file_exists($target_dir . $existing_image)) {
                unlink($target_dir . $existing_image);
            }
        }

        // Update data
        $sql = "UPDATE berita SET 
                judul = :judul,
                kategori_id = :kategori_id,
                file_upload = :file_upload,
                isi_berita = :isi_berita 
                WHERE id = :id";
                
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':judul', $_POST['judul']);
        $stmt->bindParam(':kategori_id', $_POST['kategori_id']);
        $stmt->bindParam(':file_upload', $file_upload);
        $stmt->bindParam(':isi_berita', $_POST['isi_berita']);
        $stmt->bindParam(':id', $id);
        
        if(!$stmt->execute()) {
            throw new Exception("Gagal mengupdate berita!");
        }
        
        header('Location: index.php?p=berita');
        exit();
    }

    if ($_GET['proses'] == 'delete') {
        // Get file name before delete
        $stmt = $db->prepare("SELECT file_upload FROM berita WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        
        $file_to_delete = $stmt->fetchColumn();

        // Delete data
        $stmt = $db->prepare("DELETE FROM berita WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        
        if($stmt->execute()) {
            // Delete file if exists
            if (file_exists($target_dir . $file_to_delete)) {
                unlink($target_dir . $file_to_delete);
            }
            header('Location: index.php?p=berita');
            exit();
        } else {
            throw new Exception("Gagal menghapus berita!");
        }
    }

} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "<script>
            alert('Terjadi kesalahan database: Silakan coba lagi atau hubungi administrator');
            window.location='index.php?p=berita';
          </script>";
} catch(Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.location='index.php?p=berita';
          </script>";
}
?>\