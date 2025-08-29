<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi input
if (!isset($data['username']) || !isset($data['password']) || !isset($data['level'])) {
    echo json_encode(["status" => false, "error" => "Username, password, and level are required"]);
    $conn->close();
    exit();
}

// Ambil data dari JSON
$username = $conn->real_escape_string($data['username']);
$password = $conn->real_escape_string($data['password']);
$level = $conn->real_escape_string($data['level']);

if ($level === 'admin') {
    $sql = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
} elseif ($level === 'petugas') {
    $sql = "SELECT * FROM `petugas` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
}elseif ($level === 'pengelola') {
        $sql = "SELECT * FROM `pengelola` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
} else {
    echo json_encode(["status" => false, "error" => "Invalid level"]);
    $conn->close();
    exit();
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode([
        "status" => true,
        "message" => "success",
        "id_user" => $user['id'],
        "username" => $user['username'],
        "nip" => $user['nip'],
        "nama" => $user['nama'],
        "level" => $level,
        "user" => $user
    ]);
} else {
    echo json_encode(["status" => false, "error" => "Invalid username or password"]);
}

$conn->close();
