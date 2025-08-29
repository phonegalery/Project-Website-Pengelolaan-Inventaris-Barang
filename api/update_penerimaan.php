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

// [DIUBAH] Ambil 'penerimaanId' dari input JSON agar sesuai dengan yang dikirim Android.
$id = isset($input['penerimaanId']) ? intval($input['penerimaanId']) : null;

// Validasi ID
if (is_null($id) || $id <= 0) {
    http_response_code(400); // Bad Request
    echo json_encode([
        "status" => false,
        "message" => "ID penerimaan tidak valid atau tidak dikirim."
    ]);
    exit();
}

// Ambil dan sanitasi data lainnya
$no_terima = isset($input['no_terima']) ? $conn->real_escape_string($input['no_terima']) : null;
$nama_barang = isset($input['nama_barang']) ? $conn->real_escape_string($input['nama_barang']) : null;
$jenis_barang = isset($input['jenis_barang']) ? $conn->real_escape_string($input['jenis_barang']) : null;
$jumlah = isset($input['jumlah']) ? intval($input['jumlah']) : null;
$tgl_terima = isset($input['tgl_terima']) ? $conn->real_escape_string($input['tgl_terima']) : null;
$jam_terima = isset($input['jam_terima']) ? $conn->real_escape_string($input['jam_terima']) : null;
$supplier = isset($input['supplier']) ? $conn->real_escape_string($input['supplier']) : null;
$catatan_tambahan = isset($input['catatan_tambahan']) ? $conn->real_escape_string($input['catatan_tambahan']) : null;

function ubahFormatTanggal($tanggal) {
    if (empty($tanggal)) return null;
    $date = DateTime::createFromFormat('d-m-Y', $tanggal);
    if ($date) return $date->format('Y-m-d');
    
    $date = DateTime::createFromFormat('d/m/Y', $tanggal);
    if ($date) return $date->format('Y-m-d');
    
    $date = DateTime::createFromFormat('Y-m-d', $tanggal);
    if ($date) return $date->format('Y-m-d');

    return null;
}

// Bangun field yang akan diupdate
$updateFields = [];
if (!is_null($no_terima)) $updateFields[] = "no_terima = '$no_terima'";
if (!is_null($nama_barang)) $updateFields[] = "nama_barang = '$nama_barang'";
if (!is_null($jenis_barang)) $updateFields[] = "jenis_barang = '$jenis_barang'";
if (!is_null($jumlah)) $updateFields[] = "jumlah = '$jumlah'";
if (!is_null($tgl_terima)) {
    $tgl_terima_sql = ubahFormatTanggal($tgl_terima);
    if ($tgl_terima_sql) {
        $updateFields[] = "tgl_terima = '$tgl_terima_sql'";
    } else {
        http_response_code(400);
        echo json_encode(["status" => false, "message" => "Format tanggal terima tidak valid."]);
        exit();
    }
}
if (!is_null($jam_terima)) $updateFields[] = "jam_terima = '$jam_terima'";
if (!is_null($supplier)) $updateFields[] = "supplier = '$supplier'";
if (!is_null($catatan_tambahan)) $updateFields[] = "catatan_tambahan = '$catatan_tambahan'";

if (empty($updateFields)) {
    echo json_encode(["status" => false, "message" => "Tidak ada data yang dikirim untuk diperbarui"]);
    exit();
}

$updateQuery = implode(", ", $updateFields);

// Eksekusi query update menggunakan WHERE id
$sql = "UPDATE penerimaan SET $updateQuery WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Data penerimaan berhasil diperbarui.",
        // [DIUBAH] Menyesuaikan kunci pada respons agar konsisten
        "data" => ["penerimaanId" => $id]
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
?>