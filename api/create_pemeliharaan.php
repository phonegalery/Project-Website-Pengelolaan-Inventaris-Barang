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
$kode_barang = isset($input['kode_barang']) ? $conn->real_escape_string(trim($input['kode_barang'])) : null;
$nama_barang = isset($input['nama_barang']) ? $conn->real_escape_string(trim($input['nama_barang'])) : null;
$pegawai = isset($input['pegawai']) ? $conn->real_escape_string(trim($input['pegawai'])) : null;
$jabatan = isset($input['jabatan']) ? $conn->real_escape_string(trim($input['jabatan'])) : null;
$divisi = isset($input['divisi']) ? $conn->real_escape_string(trim($input['divisi'])) : null;
$tgl_barang_masuk = isset($input['tanggal_barang_masuk']) ? $conn->real_escape_string(trim($input['tanggal_barang_masuk'])) : null;
$kondisi = isset($input['kondisi']) ? $conn->real_escape_string(trim($input['kondisi'])) : null;
$catatan = isset($input['catatan_tambahan']) ? $conn->real_escape_string(trim($input['catatan_tambahan'])) : null;
$petugas = isset($input['nama_petugas']) ? $conn->real_escape_string(trim($input['nama_petugas'])) : null;
$tgl_pemeliharaan_selanjutnya = isset($input['tanggal_pemeliharaan_selanjutnya']) ? $conn->real_escape_string(trim($input['tanggal_pemeliharaan_selanjutnya'])) : null;

function ubahFormatTanggal($tanggal)
{
    $date = DateTime::createFromFormat('d-m-Y', $tanggal);
    if ($date) {
        return $date->format('Y-m-d');
    }
    return null;  // atau bisa dikembalikan string kosong jika format salah
}

// Konversi tanggal sebelum bind_param
$tgl_barang_masuk = ubahFormatTanggal($tgl_barang_masuk);
$tgl_pemeliharaan_selanjutnya = ubahFormatTanggal($tgl_pemeliharaan_selanjutnya);


// Prepare SQL
$sql = "INSERT INTO pemeliharaan (
    kode_barang, nama_barang, pegawai, jabatan, divisi,
    tgl_barang_masuk, kondisi_perangkat_terakhir, catatan_tambahan,
    petugas, tgl_pemeliharaan_selanjutnya
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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

$stmt->bind_param(
    "ssssssssss",
    $kode_barang,
    $nama_barang,
    $pegawai,
    $jabatan,
    $divisi,
    $tgl_barang_masuk,
    $kondisi,
    $catatan,
    $petugas,
    $tgl_pemeliharaan_selanjutnya
);

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Data pemeliharaan berhasil ditambahkan",
        "insert_id" => $stmt->insert_id
    ]);
} else {
    error_log("Execute failed: " . $stmt->error);
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan data pemeliharaan",
        "error_detail" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
