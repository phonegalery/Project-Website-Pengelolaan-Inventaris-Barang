<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_pemeliharaan ada
if (!isset($data['id_pemeliharaan']) || empty($data['id_pemeliharaan'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Pemeliharaan wajib diisi!"
    ]);
    exit();
}

$id_pemeliharaan = (int)$data['id_pemeliharaan'];

// Periksa apakah pemeliharaan dengan ID tersebut ada
$checkQuery = "SELECT id FROM pemeliharaan WHERE id = $id_pemeliharaan";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data pemeliharaan tidak ditemukan!"
    ]);
    exit();
}

// Hapus data pemeliharaan berdasarkan ID
$deleteQuery = "DELETE FROM pemeliharaan WHERE id = $id_pemeliharaan";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Data pemeliharaan berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus data pemeliharaan: " . $conn->error
    ]);
}

$conn->close();
