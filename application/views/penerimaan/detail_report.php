<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td><strong>No Terima</strong></td>
					<td>:</td>
					<td><?= $penerimaan->no_terima ?></td>
				</tr>
				<tr>
					<td><strong>Jenis Perangkat</strong></td>
					<td>:</td>
					<td><?= $penerimaan->jenis_perangkat ?></td>
				</tr>
				<tr>
					<td><strong>Nama Perangkat</strong></td>
					<td>:</td>
					<td><?= $penerimaan->nama_perangkat ?></td>
				</tr>
				<tr>
					<td><strong>Waktu Terima</strong></td>
					<td>:</td>
					<td><?= $penerimaan->tgl_terima ?> - <?= $penerimaan->jam_terima ?></td>
				
				<tr>
					<td><strong>Catatan Tambahan</strong></td>
					<td>:</td>
					<td><?= $penerimaan->catatan_tambahan ?></td>
				</tr>

				</tr>
			</table>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td><strong>No</strong></td>
						<td><strong>Jenis Perangkat</strong></td>
						<td><strong>Nama Perangkat</strong></td>
						<td><strong>Jumlah</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_detail_terima as $detail_terima): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $detail_terima->jenis_perangkat ?></td>
							<td><?= $detail_terima->nama_perangkat ?></td>
							<td><?= $detail_terima->jumlah ?> <?= strtolower($detail_terima->satuan) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>