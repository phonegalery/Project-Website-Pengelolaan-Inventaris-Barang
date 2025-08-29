<?php
require_once 'connection.php'; // Pastikan file ini ada dan berisi koneksi ke database

// Atur header untuk respons JSON dan CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Aktifkan pelaporan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Baca input raw dari body request
$input = json_decode(file_get_contents("php://input"), true);

// Periksa apakah input adalah JSON yang valid
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Input bukan JSON yang valid. Error: " . json_last_error_msg()
    ]);
    exit();
}

// --- PERBAIKAN DIMULAI DARI SINI ---

// 1. Sanitasi dan penetapan variabel dari input JSON (disesuaikan dengan form penerimaan)
$no_terima = isset($input['no_terima']) ? trim($input['no_terima']) : null;
$nama_barang = isset($input['nama_barang']) ? trim($input['nama_barang']) : null;
$jenis_barang = isset($input['jenis_barang']) ? trim($input['jenis_barang']) : null;
$jumlah = isset($input['jumlah']) ? trim($input['jumlah']) : null;
$tgl_terima = isset($input['tgl_terima']) ? trim($input['tgl_terima']) : null; // Diperbaiki dari 'divisi'
$jam_terima = isset($input['jam_terima']) ? trim($input['jam_terima']) : null;
$supplier = isset($input['supplier']) ? trim($input['supplier']) : null;
$catatan_tambahan = isset($input['catatan_tambahan']) ? trim($input['catatan_tambahan']) : null; // Diperbaiki dari 'catatann_tambahan'

// Validasi input dasar (pastikan field yang wajib diisi tidak kosong)
if (empty($no_terima) || empty($nama_barang) || empty($tgl_terima)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Field wajib (No. Terima, Nama Barang, Tanggal Terima) tidak boleh kosong."
    ]);
    exit();
}


// 2. Fungsi untuk mengubah format tanggal ke format MySQL (Y-m-d)
function ubahFormatTanggal($tanggal)
{
    // Coba format d-m-Y dulu
    $date = DateTime::createFromFormat('d-m-Y', $tanggal);
    if ($date) {
        return $date->format('Y-m-d');
    }
    // Coba format d/m/Y jika format pertama gagal
    $date = DateTime::createFromFormat('d/m/Y', $tanggal);
    if ($date) {
        return $date->format('Y-m-d');
    }
    return null; // Kembalikan null jika format tidak sesuai
}

// 3. Konversi tanggal sebelum dimasukkan ke database
$tgl_terima_sql = ubahFormatTanggal($tgl_terima);

if ($tgl_terima_sql === null) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Format tanggal terima tidak valid. Gunakan format dd-mm-yyyy atau dd/mm/yyyy."
    ]);
    exit();
}


// 4. Prepare SQL (menghilangkan koma berlebih)
$sql = "INSERT INTO penerimaan (
    no_terima, nama_barang, jenis_barang, jumlah, tgl_terima,
    jam_terima, supplier, catatan_tambahan
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; // 8 placeholder

$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Database error saat preparing statement.",
        "error_detail" => $conn->error
    ]);
    exit();
}

// 5. Bind parameter (tipe data dan jumlah variabel disesuaikan)
// Tipe data: s = string, i = integer/number
// no_terima (s), nama_barang (s), jenis_barang (s), jumlah (i), tgl_terima (s), jam_terima (s), supplier (s), catatan_tambahan (s)
$stmt->bind_param(
    "sssissss",
    $no_terima,
    $nama_barang,
    $jenis_barang,
    $jumlah,
    $tgl_terima_sql, // Gunakan tanggal yang sudah diformat
    $jam_terima,
    $supplier,
    $catatan_tambahan
); // 8 variabel, sintaks diperbaiki

// Eksekusi statement
if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        // 6. Pesan sukses disesuaikan
        "message" => "Data penerimaan barang berhasil ditambahkan",
        "insert_id" => $stmt->insert_id
    ]);
} else {
    error_log("Execute failed: " . $stmt->error);
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan data penerimaan barang",
        "error_detail" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
