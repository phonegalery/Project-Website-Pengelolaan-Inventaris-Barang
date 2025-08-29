<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Baca input JSON
$input = json_decode(file_get_contents("php://input"), true);

// Debug log
error_log("JSON Input: " . print_r($input, true));

// Ambil dan sanitasi data dari JSON body
$id = isset($input['id_kategori']) ? $conn->real_escape_string($input['id_kategori']) : null;
$nama_kategori = isset($input['nama_kategori']) ? $conn->real_escape_string($input['nama_kategori']) : null;
$jumlah = isset($input['jumlah']) ? $conn->real_escape_string($input['jumlah']) : null;
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

// Validasi ID (sebagai primary key)
if (!$id) {
    echo json_encode([
        "status" => false,
        "message" => "ID harus disertakan"
    ]);
    exit();
}

// Bangun field yang akan diupdate
$updateFields = [];
if (!is_null($nama_kategori)) $updateFields[] = "nama_kategori = '$nama_kategori'";
if (!is_null($jumlah)) $updateFields[] = "jumlah = '$jumlah'";
if (!is_null($dibuat_tgl)) $updateFields[] = "dibuat_tgl = '$dibuat_tgl'";

if (empty($updateFields)) {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data yang dikirim untuk diperbarui"
    ]);
    exit();
}

$updateQuery = implode(", ", $updateFields);

// Eksekusi query update
$sql = "UPDATE kategori SET $updateQuery WHERE id = '$id'";
error_log("Executing SQL: " . $sql);

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Data kategori berhasil diperbarui.",
        "data" => ["id" => $id]
    ]);
} else {
    error_log("Database error: " . $conn->error);
    echo json_encode([
        "status" => false,
        "message" => "Gagal memperbarui data.",
        "error_detail" => $conn->error
    ]);
}

$conn->close();
