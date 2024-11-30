<?php
session_start();

try {
    // Hapus semua data session
    $_SESSION = array();
    
    // Hapus cookie session jika ada
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-3600, '/');
    }
    
    // Hancurkan session
    session_destroy();
    
    // Redirect ke halaman home
    header('Location: index.php?p=home');
    exit(); // Pastikan tidak ada kode yang dijalankan setelah redirect
    
} catch(Exception $e) {
    error_log("Logout Error: " . $e->getMessage());
    header('Location: index.php?p=home&error=logout_failed');
    exit();
}
?>