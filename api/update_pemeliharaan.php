<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Baca input JSON
$input = json_decode(file_get_contents("php://input"), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid JSON format: " . json_last_error_msg()
    ]);
    exit();
}

// Debug log
error_log("JSON Input: " . print_r($input, true));

// Ambil dan sanitasi data dari JSON body
$kode_barang = isset($input['kode_barang']) ? $conn->real_escape_string($input['kode_barang']) : null;
$nama_barang = isset($input['nama_barang']) ? $conn->real_escape_string($input['nama_barang']) : null;
$pegawai = isset($input['pegawai']) ? $conn->real_escape_string($input['pegawai']) : null;
$jabatan = isset($input['jabatan']) ? $conn->real_escape_string($input['jabatan']) : null;
$divisi = isset($input['divisi']) ? $conn->real_escape_string($input['divisi']) : null;
$tgl_barang_masuk = isset($input['tanggal_barang_masuk']) ? $conn->real_escape_string($input['tanggal_barang_masuk']) : null;
$kondisi = isset($input['kondisi']) ? $conn->real_escape_string($input['kondisi']) : null;
$catatan = isset($input['catatan_tambahan']) ? $conn->real_escape_string($input['catatan_tambahan']) : null;
$petugas = isset($input['nama_petugas']) ? $conn->real_escape_string($input['nama_petugas']) : null;
$tgl_pemeliharaan_selanjutnya = isset($input['tanggal_pemeliharaan_selanjutnya']) ? $conn->real_escape_string($input['tanggal_pemeliharaan_selanjutnya']) : null;

function ubahFormatTanggal($tanggal)
{
    if (empty($tanggal)) return null;

    $date = DateTime::createFromFormat('d-m-Y', $tanggal);
    if ($date) {
        return $date->format('Y-m-d');
    }
    return null;
}

// Konversi tanggal sebelum bind_param
$tgl_barang_masuk = ubahFormatTanggal($tgl_barang_masuk);
$tgl_pemeliharaan_selanjutnya = ubahFormatTanggal($tgl_pemeliharaan_selanjutnya);

// Validasi kode_barang
if (!$kode_barang) {
    echo json_encode([
        "status" => false,
        "message" => "kode_barang harus disertakan"
    ]);
    exit();
}

// Bangun field yang akan diupdate
$updateFields = [];
if (!is_null($nama_barang)) $updateFields[] = "nama_barang = '$nama_barang'";
if (!is_null($pegawai)) $updateFields[] = "pegawai = '$pegawai'";
if (!is_null($jabatan)) $updateFields[] = "jabatan = '$jabatan'";
if (!is_null($divisi)) $updateFields[] = "divisi = '$divisi'";
if (!is_null($tgl_barang_masuk)) $updateFields[] = "tgl_barang_masuk = '$tgl_barang_masuk'";
if (!is_null($kondisi)) $updateFields[] = "kondisi_perangkat_terakhir = '$kondisi'";
if (!is_null($catatan)) $updateFields[] = "catatan_tambahan = '$catatan'";
if (!is_null($petugas)) $updateFields[] = "petugas = '$petugas'";
if (!is_null($tgl_pemeliharaan_selanjutnya)) $updateFields[] = "tgl_pemeliharaan_selanjutnya = '$tgl_pemeliharaan_selanjutnya'";

if (empty($updateFields)) {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data yang dikirim untuk diperbarui"
    ]);
    exit();
}

$updateQuery = implode(", ", $updateFields);

// Eksekusi query update
$sql = "UPDATE pemeliharaan SET $updateQuery WHERE kode_barang = '$kode_barang'";
error_log("Executing SQL: " . $sql);

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Data pemeliharaan berhasil diperbarui.",
        "data" => ["kode_barang" => $kode_barang]
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
