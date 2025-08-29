<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pemeliharaan Barang</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        .kop-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative; /* Diperlukan untuk positioning elemen di dalamnya */
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }
        .kop-header img {
            position: absolute; /* Mengatur posisi logo */
            top: 0;
            right: 0;
            max-width: 100px;
            height: auto;
        }
        .kop-header h3, .kop-header p {
            margin: 0;
        }
        .kop-info {
            font-size: 12px;
        }
        .report-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 5px;
        }
        .print-info {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="kop-header">
        <?php
            // Menggunakan Base64 untuk memastikan logo muncul di PDF
            $logo_path = FCPATH . 'uploads/logo.png'; // FCPATH adalah path absolut CodeIgniter
            if (file_exists($logo_path)) {
                $logo_type = pathinfo($logo_path, PATHINFO_EXTENSION);
                $logo_data = file_get_contents($logo_path);
                $logo_base64 = 'data:image/' . $logo_type . ';base64,' . base64_encode($logo_data);
                echo '<img src="' . $logo_base64 . '" alt="Logo PLN">';
            } else {
                // Tampilkan teks jika logo tidak ditemukan
                echo '<div style="position: absolute; top: 0; right: 0; font-style: italic; color: #888;">Logo PLN</div>';
            }
        ?>
        <h3>PT PLN Indonesia Power</h3>
        <p class="kop-info">
            Alamat: JL Imam Bonjol No 207 Semarang<br>
            Telepon: (024) 12345678 | Email: info@pln-indonesia-power.co.id
        </p>
    </div>

    <h2 class="report-title"><strong><?= $title ?></strong></h2>
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <p class="print-info">
        Dicetak pada: <?= date('d-m-Y H:i:s') ?> WIB
    </p>

    <div class="card-body" style="padding: 0;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Pegawai</th>
                    <th>Tanggal Barang Masuk</th>
                    <th>Kondisi Perangkat Terakhir</th>
                    <th>Catatan Tambahan</th>
                    <th>Petugas</th>
                    <th>Tanggal Pemeliharaan Selanjutnya</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($all_pemeliharaan)): ?>
                    <?php foreach ($all_pemeliharaan as $index => $pemeliharaan): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->kode_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->nama_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->pegawai, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->tgl_barang_masuk, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->kondisi_perangkat_terakhir, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->catatan_tambahan, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->petugas, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($pemeliharaan->tgl_pemeliharaan_selanjutnya, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Data tidak tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>