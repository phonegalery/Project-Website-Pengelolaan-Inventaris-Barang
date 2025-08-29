<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Fungsi untuk generate kode unik secara acak
function generateUniqueKodeBarang($conn)
{
    do {
        $newKode = rand(10000000, 99999999);

        $checkQuery = "SELECT COUNT(*) as total FROM barang WHERE kode_barang = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("i", $newKode);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
    } while ($result['total'] > 0); // ulang jika kode sudah ada

    return $newKode;
}

// Panggil fungsi dan kirim respons
$kodeBarangBaru = generateUniqueKodeBarang($conn);

echo json_encode([
    "status" => true,
    "message" => "Kode barang unik berhasil dibuat",
    "data" => [
        "kode_barang" => $kodeBarangBaru
    ]
]);

$conn->close();
?>
