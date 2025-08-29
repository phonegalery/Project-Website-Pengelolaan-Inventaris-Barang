<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT untuk mengambil data riwayat pemeliharaan beserta informasi barang dan kategori
$sql = "
SELECT 
    p.id AS id_pemeliharaan,
    p.kode_barang,
    p.nama_barang,
    b.jenis_barang,
    k.nama_kategori,
    p.pegawai,
    p.jabatan,
    p.divisi,
    p.tgl_barang_masuk,
    p.kondisi_perangkat_terakhir AS kondisi,
    p.catatan_tambahan,
    p.petugas,
    p.tgl_pemeliharaan_selanjutnya,
    b.status,
    b.merk,
    b.type,
    b.kondisi AS kondisi_barang,
    b.gambar_barang
FROM pemeliharaan p
JOIN barang b ON p.kode_barang = b.kode_barang
LEFT JOIN kategori k ON b.kode_kategori = k.kode_kategori
ORDER BY p.id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "Data pemeliharaan ditemukan",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data pemeliharaan ditemukan"
    ]);
}

$conn->close();
