<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_kategori ada
if (!isset($data['id_kategori']) || empty($data['id_kategori'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Kategori wajib diisi!"
    ]);
    exit();
}

$id_kategori = (int)$data['id_kategori'];

// Periksa apakah kategori dengan ID tersebut ada
$checkQuery = "SELECT id FROM kategori WHERE id = $id_kategori";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Kategori tidak ditemukan!"
    ]);
    exit();
}

// Hapus kategori berdasarkan ID
$deleteQuery = "DELETE FROM kategori WHERE id = $id_kategori";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Kategori berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus kategori: " . $conn->error
    ]);
}

$conn->close();
