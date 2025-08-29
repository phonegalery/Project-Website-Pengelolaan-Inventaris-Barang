<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_petugas ada
if (!isset($data['id_petugas']) || empty($data['id_petugas'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Petugas wajib diisi!"
    ]);
    exit();
}

$id_petugas = (int)$data['id_petugas'];

// Periksa apakah petugas dengan ID tersebut ada
$checkQuery = "SELECT id FROM petugas WHERE id = $id_petugas";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Petugas tidak ditemukan!"
    ]);
    exit();
}

// Hapus petugas berdasarkan ID
$deleteQuery = "DELETE FROM petugas WHERE id = $id_petugas";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Petugas berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus petugas: " . $conn->error
    ]);
}

$conn->close();
