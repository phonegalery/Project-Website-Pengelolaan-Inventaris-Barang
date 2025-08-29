<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['kode_barang'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter kode_barang diperlukan"
    ]);
    exit();
}

$kode_barang = $conn->real_escape_string($data['kode_barang']);

// Query SELECT dengan kondisi kode_barang
$sql = "SELECT nama_barang, pegawai, jabatan, divisi
        FROM barang
        WHERE kode_barang = '$kode_barang'";

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
        "message" => "Tidak ada data untuk kode_barang ini"
    ]);
}

$conn->close();
