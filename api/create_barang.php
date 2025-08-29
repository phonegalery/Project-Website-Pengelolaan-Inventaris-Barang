<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Debug: Log request
error_log("POST Request received (CREATE)");
error_log("FILES: " . print_r($_FILES, true));
error_log("POST: " . print_r($_POST, true));

// Ambil data dari POST
$kode_barang = isset($_POST['kode_barang']) ? $conn->real_escape_string($_POST['kode_barang']) : null;
$jenis_barang = isset($_POST['jenis_barang']) ? $conn->real_escape_string($_POST['jenis_barang']) : null;
$nama_barang = isset($_POST['nama_barang']) ? $conn->real_escape_string($_POST['nama_barang']) : null;
$tgl_masuk = isset($_POST['tgl_masuk']) ? $conn->real_escape_string($_POST['tgl_masuk']) : null;
$pegawai = isset($_POST['pegawai']) ? $conn->real_escape_string($_POST['pegawai']) : null;
$jabatan = isset($_POST['jabatan']) ? $conn->real_escape_string($_POST['jabatan']) : null;
$divisi = isset($_POST['divisi']) ? $conn->real_escape_string($_POST['divisi']) : null;
$status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : null;
$merk = isset($_POST['merk']) ? $conn->real_escape_string($_POST['merk']) : null;
$type = isset($_POST['type']) ? $conn->real_escape_string($_POST['type']) : null;
$catatan = isset($_POST['catatan_tambahan']) ? $conn->real_escape_string($_POST['catatan_tambahan']) : null;
$kondisi = isset($_POST['kondisi']) ? $conn->real_escape_string($_POST['kondisi']) : null;
$kode_kategori = isset($_POST['kode_kategori']) ? $conn->real_escape_string($_POST['kode_kategori']) : null;

// Validasi wajib
if (!$kode_barang || !$status) {
    echo json_encode([
        "status" => false,
        "message" => "Kode barang dan status wajib diisi"
    ]);
    exit();
}

// Handle Upload Gambar
$gambar_barang = null;
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = __DIR__ . '/../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $file_name = time() . '_' . uniqid() . '.' . $file_ext;
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path)) {
        $gambar_barang = $file_name;
        error_log("File uploaded successfully: " . $gambar_barang);
    } else {
        error_log("Failed to upload file");
        echo json_encode([
            "status" => false,
            "message" => "Gagal upload gambar"
        ]);
        exit();
    }
}

// Insert ke database
$sql = "INSERT INTO barang (
            kode_barang, jenis_barang, nama_barang, tgl_masuk, pegawai, jabatan, divisi,
            status, merk, `type`, catatan_tambahan, kondisi, gambar_barang, kode_kategori
        ) VALUES (
            '$kode_barang', '$jenis_barang', '$nama_barang', '$tgl_masuk', '$pegawai', '$jabatan', '$divisi',
            '$status', '$merk', '$type', '$catatan', '$kondisi', '$gambar_barang', '$kode_kategori'
        )";

error_log("Executing SQL: " . $sql);

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Barang berhasil ditambahkan",
        "data" => ["id" => $conn->insert_id]
    ]);
} else {
    error_log("Database error: " . $conn->error);
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan barang",
        "error_detail" => $conn->error
    ]);
}

$conn->close();
