<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT untuk mengambil semua data dari tabel penerimaan
$sql = "SELECT * FROM penerimaan";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "Data penerimaan ditemukan",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data penerimaan ditemukan"
    ]);
}

$conn->close();
