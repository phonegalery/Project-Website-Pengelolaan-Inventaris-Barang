<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT JOIN barang dengan kategori
$sql = "SELECT 
    barang.id,
    barang.kode_barang,
    barang.jenis_barang,
    barang.nama_barang,
    barang.tgl_masuk,
    barang.pegawai,
    barang.jabatan,
    barang.divisi,
    barang.status,
    barang.merk,
    barang.type,
    barang.catatan_tambahan,
    barang.kondisi,
    barang.gambar_barang,
    barang.kode_kategori,
    kategori.nama_kategori,
    kategori.jumlah,
    kategori.dibuat_tgl
FROM barang
LEFT JOIN kategori ON barang.kode_kategori = kategori.kode_kategori 
ORDER BY barang.id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "Data ditemukan",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data yang ditemukan"
    ]);
}

$conn->close();
