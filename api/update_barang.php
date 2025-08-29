<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Debug: Log request data
error_log("POST Request received");
error_log("FILES: " . print_r($_FILES, true));
error_log("POST: " . print_r($_POST, true));

// Ambil data dari $_POST
$id = isset($_POST['id_barang']) ? $conn->real_escape_string($_POST['id_barang']) : null;
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

// Gambar: dari $_FILES (pastikan nama field sama dengan yang dikirim Android)
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


// Validasi
if (!$id) {
    echo json_encode([
        "status" => false,
        "message" => "ID Barang tidak ditemukan"
    ]);
    exit();
}

// Build query update
$updateFields = [];
if (!is_null($jenis_barang)) $updateFields[] = "jenis_barang = '$jenis_barang'";
if (!is_null($nama_barang)) $updateFields[] = "nama_barang = '$nama_barang'";
if (!is_null($tgl_masuk)) $updateFields[] = "tgl_masuk = '$tgl_masuk'";
if (!is_null($pegawai)) $updateFields[] = "pegawai = '$pegawai'";
if (!is_null($jabatan)) $updateFields[] = "jabatan = '$jabatan'";
if (!is_null($divisi)) $updateFields[] = "divisi = '$divisi'";
if (!is_null($status)) $updateFields[] = "status = '$status'";
if (!is_null($merk)) $updateFields[] = "merk = '$merk'";
if (!is_null($type)) $updateFields[] = "`type` = '$type'";
if (!is_null($catatan)) $updateFields[] = "catatan_tambahan = '$catatan'";
if (!is_null($kondisi)) $updateFields[] = "kondisi = '$kondisi'";
if (!is_null($kode_kategori)) $updateFields[] = "kode_kategori = '$kode_kategori'";
if (!is_null($gambar_barang)) $updateFields[] = "gambar_barang = '$gambar_barang'";

if (empty($updateFields)) {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data yang diupdate"
    ]);
    exit();
}

$updateQuery = implode(", ", $updateFields);
$sql = "UPDATE barang SET $updateQuery WHERE id = '$id'";

error_log("Executing SQL: " . $sql);

// Eksekusi dan response
if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "Data barang berhasil diperbarui.",
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