<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query total untuk masing-masing tabel
$sql_admin = "SELECT COUNT(*) AS total_admin FROM admin";
$sql_petugas = "SELECT COUNT(*) AS total_petugas FROM petugas";
$sql_divisi = "SELECT COUNT(*) AS total_divisi FROM divisi";
$sql_pengelola = "SELECT COUNT(*) AS total_pengelola FROM pengelola";
$sql_barang = "SELECT COUNT(*) AS total_barang FROM barang";
$sql_kategori = "SELECT COUNT(*) AS total_kategori FROM kategori";
$sql_pemeliharaan = "SELECT COUNT(*) AS total_pemeliharaan FROM pemeliharaan";
$sql_penerimaan = "SELECT COUNT(*) AS total_penerimaan FROM penerimaan";


// Eksekusi query
$result_admin = $conn->query($sql_admin);
$result_petugas = $conn->query($sql_petugas);
$result_divisi = $conn->query($sql_divisi);
$result_pengelola = $conn->query($sql_pengelola);
$result_barang = $conn->query($sql_barang);
$result_kategori = $conn->query($sql_kategori);
$result_pemeliharaan = $conn->query($sql_pemeliharaan);
$result_penerimaan = $conn->query($sql_penerimaan);

if (
    $result_admin &&
    $result_petugas &&
    $result_divisi &&
    $result_pengelola &&
    $result_barang &&
    $result_kategori &&
    $result_pemeliharaan &&
    $result_penerimaan

) {
    $data = [
        "total_admin" => (int)$result_admin->fetch_assoc()['total_admin'],
        "total_petugas" => (int)$result_petugas->fetch_assoc()['total_petugas'],
        "total_divisi" => (int)$result_divisi->fetch_assoc()['total_divisi'],
        "total_pengelola" => (int)$result_pengelola->fetch_assoc()['total_pengelola'],
        "total_barang" => (int)$result_barang->fetch_assoc()['total_barang'],
        "total_kategori" => (int)$result_kategori->fetch_assoc()['total_kategori'],
        "total_pemeliharaan" => (int)$result_pemeliharaan->fetch_assoc()['total_pemeliharaan'],
        "total_penerimaan" => (int)$result_penerimaan->fetch_assoc()['total_penerimaan']
    ];

    echo json_encode([
        "status" => true,
        "message" => "Total semua data berhasil dihitung",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghitung total data",
        "data" => null
    ]);
}

$conn->close();
