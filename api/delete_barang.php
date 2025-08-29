<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_barang ada
if (!isset($data['id_barang']) || empty($data['id_barang'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Barang wajib diisi!"
    ]);
    exit();
}

$id_barang = (int)$data['id_barang'];

// Periksa apakah barang dengan ID tersebut ada
$checkQuery = "SELECT id FROM barang WHERE id = $id_barang";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Barang tidak ditemukan!"
    ]);
    exit();
}

// Hapus barang berdasarkan ID
$deleteQuery = "DELETE FROM barang WHERE id = $id_barang";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Barang berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus barang: " . $conn->error
    ]);
}

$conn->close();
