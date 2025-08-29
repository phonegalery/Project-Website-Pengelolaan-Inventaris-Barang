<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Fungsi untuk generate kode_kategori unik
function generateUniqueKodeKategori($conn)
{
    do {
        $newKode = rand(10000000, 99999999);

        $checkQuery = "SELECT COUNT(*) as total FROM kategori WHERE kode_kategori = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("i", $newKode);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
    } while ($result['total'] > 0); // ulang jika kode sudah ada

    return $newKode;
}

// Panggil fungsi dan kirim respons
$kodeKategoriBaru = generateUniqueKodeKategori($conn);

echo json_encode([
    "status" => true,
    "message" => "Kode kategori unik berhasil dibuat",
    "data" => [
        "kode_kategori" => $kodeKategoriBaru
    ]
]);

$conn->close();
