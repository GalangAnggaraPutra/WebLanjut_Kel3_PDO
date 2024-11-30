<?php
require_once 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    try {
        $sql = "INSERT INTO matakuliah (kode_matkul, nama_matkul, semester, jenis_matkul, sks, jam, keterangan) 
                VALUES (:kode_matkul, :nama_matkul, :semester, :jenis_matkul, :sks, :jam, :keterangan)";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':kode_matkul' => $_POST['kode_matkul'],
            ':nama_matkul' => $_POST['nama_matkul'],
            ':semester' => $_POST['semester'],
            ':jenis_matkul' => $_POST['jenis_matkul'],
            ':sks' => $_POST['sks'],
            ':jam' => $_POST['jam'],
            ':keterangan' => $_POST['keterangan']
        ]);
        
        header('Location: index.php?p=matkul');
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_GET['proses'] == 'edit') {
    try {
        $sql = "UPDATE matakuliah SET 
                kode_matkul = :kode_matkul,
                nama_matkul = :nama_matkul,
                semester = :semester,
                jenis_matkul = :jenis_matkul,
                sks = :sks,
                jam = :jam,
                keterangan = :keterangan
                WHERE id = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':kode_matkul' => $_POST['kode_matkul'],
            ':nama_matkul' => $_POST['nama_matkul'],
            ':semester' => $_POST['semester'],
            ':jenis_matkul' => $_POST['jenis_matkul'],
            ':sks' => $_POST['sks'],
            ':jam' => $_POST['jam'],
            ':keterangan' => $_POST['keterangan'],
            ':id' => $_POST['id']
        ]);
        
        header('Location: index.php?p=matkul');
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_GET['proses'] == 'delete') {
    try {
        $sql = "DELETE FROM matakuliah WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $_GET['id']]);
        
        header('Location: index.php?p=matkul');
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>