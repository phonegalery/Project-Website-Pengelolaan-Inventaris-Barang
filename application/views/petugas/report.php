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
            padding: 8px; /* Tambahkan padding untuk memberikan jarak */
            text-align: left; /* Opsional, untuk rata kiri */
        }
        th {
            background-color: #f2f2f2; /* Tambahkan warna latar untuk header */
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>No</td>
					<td>NIP</td>
					<td>Nama</td>
					<td>Username</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_petugas as $petugas): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $petugas->nip ?></td>
						<td><?= $petugas->nama ?></td>
						<td><?= $petugas->username ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>
