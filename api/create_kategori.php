<?php
require_once 'connection.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Baca input raw JSON
$input = json_decode(file_get_contents("php://input"), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Input bukan JSON yang valid"
    ]);
    exit();
}

// Sanitasi dan assign dari input JSON
$kode_kategori = isset($input['kode_kategori']) ? $conn->real_escape_string(trim($input['kode_kategori'])) : null;
$nama_kategori = isset($input['nama_kategori']) ? $conn->real_escape_string(trim($input['nama_kategori'])) : null;
$jumlah = isset($input['jumlah']) ? $conn->real_escape_string(trim($input['jumlah'])) : null;
if (isset($input['dibuat_tgl'])) {
    $date = DateTime::createFromFormat('d-m-Y', trim($input['dibuat_tgl']));
    if ($date) {
        $dibuat_tgl = $date->format('Y-m-d');
    } else {
        $dibuat_tgl = date('Y-m-d');
    }
} else {
    $dibuat_tgl = date('Y-m-d');
}

// Validasi data wajib
if (empty($kode_kategori) || empty($nama_kategori)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Kode kategori dan nama kategori harus diisi"
    ]);
    exit();
}

// Validasi kode_kategori harus angka
if (!is_numeric($kode_kategori)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Kode kategori harus berupa angka"
    ]);
    exit();
}
$kode_kategori = (int)$kode_kategori;

// Cek apakah kode_kategori sudah ada
$check_sql = "SELECT COUNT(*) as count FROM kategori WHERE kode_kategori = ?";
$check_stmt = $conn->prepare($check_sql);
if (!$check_stmt) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Database error",
        "error_detail" => $conn->error
    ]);
    exit();
}
$check_stmt->bind_param("i", $kode_kategori);
$check_stmt->execute();
$check_result = $check_stmt->get_result();
$row = $check_result->fetch_assoc();
$check_stmt->close();

if ($row['count'] > 0) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Kode kategori sudah digunakan, silakan gunakan kode yang lain"
    ]);
    exit();
}

// Prepare SQL untuk insert
$sql = "INSERT INTO kategori (
    kode_kategori, nama_kategori, jumlah, dibuat_tgl
) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Database error",
        "error_detail" => $conn->error
    ]);
    exit();
}

// Bind parameter
$stmt->bind_param(
    "isis",
    $kode_kategori,
    $nama_kategori,
    $jumlah,
    $dibuat_tgl
);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode([
        "status" => true,
        "message" => "Data kategori berhasil ditambahkan",
        "insert_id" => $stmt->insert_id,
        "data" => [
            "id" => $stmt->insert_id,
            "kode_kategori" => $kode_kategori,
            "nama_kategori" => $nama_kategori,
            "jumlah" => $jumlah,
            "dibuat_tgl" => $dibuat_tgl
        ]
    ]);
} else {
    error_log("Execute failed: " . $stmt->error);
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan data kategori",
        "error_detail" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
