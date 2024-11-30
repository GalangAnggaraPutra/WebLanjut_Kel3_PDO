<?php
include 'koneksi.php';

try {
    $proses = $_GET['proses'];
    switch ($proses) {
        case 'insert':
            if (isset($_POST['submit'])) {
                $nama_prodi = $_POST['nama_prodi'];
                $jenjang_std = $_POST['jenjang_std'];

                $stmt = $db->prepare("INSERT INTO prodi (nama_prodi, jenjang_std) VALUES (?, ?)");
                $stmt->execute([$nama_prodi, $jenjang_std]);

                header("Location: index.php?p=prodi&pesan=Data berhasil ditambahkan");
            }
            break;

        case 'update':
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $nama_prodi = $_POST['nama_prodi'];
                $jenjang_std = $_POST['jenjang_std'];

                $stmt = $db->prepare("UPDATE prodi SET nama_prodi = ?, jenjang_std = ? WHERE id = ?");
                $stmt->execute([$nama_prodi, $jenjang_std, $id]);

                header("Location: index.php?p=prodi&pesan=Data berhasil diupdate");
            }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $stmt = $db->prepare("DELETE FROM prodi WHERE id = ?");
                $stmt->execute([$id]);

                header("Location: index.php?p=prodi&pesan=Data berhasil dihapus");
            }
            break;

        default:
            header("Location: index.php?p=prodi");
            break;
    }
} catch(PDOException $e) {
    // Tangani error
    echo "Error: " . $e->getMessage();
    // Atau redirect ke halaman error
    // header("Location: index.php?p=prodi&pesan=Terjadi kesalahan: " . urlencode($e->getMessage()));
}
?>