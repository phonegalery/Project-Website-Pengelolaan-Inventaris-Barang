<!DOCTYPE html>
<html lang="en">
<head>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        .kop-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-header img {
            float: right;
            max-width: 100px;
            height: auto;
        }
        .kop-header h3, .kop-header p {
            margin: 0;
        }
        .kop-info {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="kop-header">
            <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo PLN">
            <h3>PT PLN Indonesia Power</h3>
            <p class="kop-info">
                Alamat: JL Imam Bonjol No 207 Semarang<br>
                Telepon: (024) 12345678 | Email: info@pln-indonesia-power.co.id
            </p>
        </div>
        <div class="card shadow">
            <div class="card-header">
                <h2 align="center"><strong><?= $title ?></strong><br></h1>
                
                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                <small>Dicetak pada: <?= date('d-m-Y H:i:s') ?> WIB</small>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>merk</th>
                            <th>Type</th>
                            <th>Kondisi Barang</th>
                            <th>Jumlah Perbaikan</th>
                            <th>Gambar</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($all_barang)): ?>
                            <?php foreach ($all_barang as $index => $barang): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($barang->kode_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($barang->nama_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($barang->jenis_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($barang->merk, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($barang->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($barang->kondisi_barang, ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($barang->jumlah_perbaikan, ENT_QUOTES, 'UTF-8'); ?></td>

                                    <td>
                                        <?php if (!empty($barang->base64Image)): ?>
                                            <img src="<?= $barang->base64Image ?>" alt="Gambar Produk">
                                        <?php else: ?>
                                            <p>Tidak Ada Gambar</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($barang->catatan_tambahan, ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="13" class="text-center">Data tidak tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
