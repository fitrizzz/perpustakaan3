<?php
include "conn.php"; // Pastikan ada koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qr_data = $_POST['qr_data'];  // Ambil hasil QR Code dari JavaScript

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO scan_results (qr_data) VALUES (?)");
    $stmt->bind_param("s", $qr_data);
    
    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Gagal menyimpan data!";
    }

    $stmt->close();
}
?>
