<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Baca input JSON
$input = json_decode(file_get_contents("php://input"), true);

// Debug log
error_log("JSON Input: " . print_r($input, true));

// Ambil dan sanitasi data dari JSON body
$id = isset($input['id']) ? $conn->real_escape_string($input['id']) : null;
$nip = isset($input['nip']) ? $conn->real_escape_string($input['nip']) : null;
$nama = isset($input['nama']) ? $conn->real_escape_string($input['nama']) : null;
$username = isset($input['username']) ? $conn->real_escape_string($input['username']) : null;
$password = isset($input['password']) ? $conn->real_escape_string($input['password']) : null;

// Validasi ID wajib ada
if (!$id) {
    echo json_encode([
        "status" => false,
        "message" => "ID Admin harus disertakan"
    ]);
    exit();
}

// Build field untuk update
$updateFields = [];
if (!is_null($nip)) $updateFields[] = "nip = '$nip'";
if (!is_null($nama)) $updateFields[] = "nama = '$nama'";
if (!is_null($username)) $updateFields[] = "username = '$username'";
if (!is_null($password)) $updateFields[] = "password = '$password'"; // Tanpa hash

if (empty($updateFields)) {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data yang dikirim untuk diperbarui"
    ]);
    exit();
}

$updateQuery = implode(", ", $updateFields);
$sql = "UPDATE admin SET $updateQuery WHERE id = '$id'";

error_log("Executing SQL: " . $sql);

// Eksekusi query update
if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Data admin berhasil diperbarui.",
        "data" => ["id" => $id]
    ]);
} else {
    error_log("Database error: " . $conn->error);
    echo json_encode([
        "status" => false,
        "message" => "Gagal memperbarui data admin.",
        "error_detail" => $conn->error
    ]);
}

$conn->close();
