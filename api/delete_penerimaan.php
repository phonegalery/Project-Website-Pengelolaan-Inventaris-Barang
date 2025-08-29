<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// [DIUBAH] Periksa apakah parameter "id" ada, bukan "id_penerimaan"
if (!isset($data['id']) || empty($data['id'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter 'id' wajib diisi!"
    ]);
    exit();
}

$penerimaanId = (int)$data['id'];

// [AMAN] Menggunakan Prepared Statement untuk mencegah SQL Injection
// Hapus data penerimaan berdasarkan ID
$deleteQuery = "DELETE FROM penerimaan WHERE id = ?";
$stmt = $conn->prepare($deleteQuery);

// Periksa apakah prepare berhasil
if ($stmt === false) {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menyiapkan query: " . $conn->error
    ]);
    exit();
}

// Bind parameter ke query
$stmt->bind_param("i", $penerimaanId); // "i" berarti tipe data integer

// Eksekusi query
if ($stmt->execute()) {
    // Periksa apakah ada baris yang benar-benar terhapus
    if ($stmt->affected_rows > 0) {
        echo json_encode([
            "status" => true,
            "message" => "Data penerimaan berhasil dihapus!"
            // "data" tidak terlalu diperlukan untuk respons hapus, pesan saja sudah cukup
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Data dengan ID tersebut tidak ditemukan."
        ]);
    }
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus data: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();