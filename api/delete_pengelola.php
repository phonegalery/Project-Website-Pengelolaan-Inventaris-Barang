<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_pengelola ada
if (!isset($data['id_pengelola']) || empty($data['id_pengelola'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID pengelola wajib diisi!"
    ]);
    exit();
}

$id_pengelola = (int)$data['id_pengelola'];

// Periksa apakah pengelola dengan ID tersebut ada
$checkQuery = "SELECT id FROM pengelola WHERE id = $id_pengelola";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "pengelola tidak ditemukan!"
    ]);
    exit();
}

// Hapus pengelola berdasarkan ID
$deleteQuery = "DELETE FROM pengelola WHERE id = $id_pengelola";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "pengelola berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus pengelola: " . $conn->error
    ]);
}

$conn->close();
