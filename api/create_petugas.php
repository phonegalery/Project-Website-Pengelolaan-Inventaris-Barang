<?php
require_once 'connection.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$input = json_decode(file_get_contents("php://input"), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Input bukan JSON yang valid"
    ]);
    exit();
}

$nip = isset($input['nip']) ? (int)$input['nip'] : null;
$nama = isset($input['nama']) ? $conn->real_escape_string(trim($input['nama'])) : null;
$username = isset($input['username']) ? $conn->real_escape_string(trim($input['username'])) : null;
// --- BARIS INI DIUBAH ---
// Menghapus fungsi password_hash() dan hanya mengambil input password apa adanya.
$password = isset($input['password']) ? trim($input['password']) : null;

$sql = "INSERT INTO petugas (nip, nama, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Database error saat prepare statement",
        "error_detail" => $conn->error
    ]);
    exit();
}

$stmt->bind_param("isss", $nip, $nama, $username, $password);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Petugas berhasil ditambahkan",
        "insert_id" => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan petugas",
        "error_detail" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();