<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT untuk mengambil semua data dari tabel petugas
$sql = "SELECT * FROM admin";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "Data petugas ditemukan",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data petugas ditemukan"
    ]);
}

$conn->close();
