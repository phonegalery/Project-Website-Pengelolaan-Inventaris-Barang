<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT untuk mengambil semua data dari tabel kategori
$sql = "SELECT * FROM kategori";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "Data kategori ditemukan",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data kategori ditemukan"
    ]);
}

$conn->close();
