<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Barang</title>
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
            /* Ensures content does not break out of cells */
            word-wrap: break-word; 
        }
        th {
            background-color: #f2f2f2;
        }
        .kop-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative; /* Required for positioning elements inside */
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }
        .kop-header img {
            position: absolute; /* Positions the logo */
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
        .item-image {
            max-width: 80px; /* Limits the image size in the table cell */
            height: auto;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="kop-header">
        <?php
            // Using Base64 to ensure the logo appears in the PDF
            $logo_path = FCPATH . 'uploads/logo.png'; // FCPATH is an absolute path in CodeIgniter
            if (file_exists($logo_path)) {
                $logo_type = pathinfo($logo_path, PATHINFO_EXTENSION);
                $logo_data = file_get_contents($logo_path);
                $logo_base64 = 'data:image/' . $logo_type . ';base64,' . base64_encode($logo_data);
                echo '<img src="' . $logo_base64 . '" alt="Logo PLN">';
            } else {
                // Display text if the logo is not found
                echo '<div style="position: absolute; top: 0; right: 0; font-style: italic; color: #888;">Logo Not Found</div>';
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
                    <th>Jenis Barang</th>
                    <th>Nama Barang</th>
                    <th>Pegawai</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Status</th>
                    <th>Merk</th>
                    <th>Type</th>
                    <th>Kondisi</th>
                    <th>Gambar</th>
                    <th>Catatan Tambahan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($all_barang)): ?>
                    <?php foreach ($all_barang as $index => $barang): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($barang->kode_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->jenis_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->nama_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->pegawai, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->jabatan, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->divisi, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->status, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->merk, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->type, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($barang->kondisi, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php if (!empty($barang->base64Image)): ?>
                                    <img src="<?= $barang->base64Image ?>" alt="Gambar Barang" class="item-image">
                                <?php else: ?>
                                    <span>Tidak Ada</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($barang->catatan_tambahan, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="13" style="text-align: center;">Data tidak tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>