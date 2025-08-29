<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_admin ada
if (!isset($data['id_admin']) || empty($data['id_admin'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Admin wajib diisi!"
    ]);
    exit();
}

$id_admin = (int)$data['id_admin'];

// Periksa apakah admin dengan ID tersebut ada
$checkQuery = "SELECT id FROM admin WHERE id = $id_admin";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Admin tidak ditemukan!"
    ]);
    exit();
}

// Hapus admin berdasarkan ID
$deleteQuery = "DELETE FROM admin WHERE id = $id_admin";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Admin berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus admin: " . $conn->error
    ]);
}

$conn->close();
