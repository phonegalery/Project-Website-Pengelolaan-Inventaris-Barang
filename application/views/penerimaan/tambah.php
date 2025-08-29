<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('penerimaan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('penerimaan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('penerimaan/proses_tambah') ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
										<!-- Nomor Terima -->
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="no_terima"><strong>No. Terima</strong></label>
												<input type="text" name="no_terima" value="TR<?= time() ?>" readonly class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label for="nama_barang"><strong>Nama Barang</strong></label>
												<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required>
											</div>
										</div>
										<!-- Jenis Perangkat dan Jumlah -->
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="jenis_barang"><strong>Jenis Barang</strong></label>
												<input type="text" name="jenis_barang" placeholder="Masukkan Jenis Barang" autocomplete="off" class="form-control" required>
											</div>
											<div class="form-group col-md-6">
												<label for="jumlah"><strong>Jumlah</strong></label>
												<input type="text" name="jumlah" placeholder="Masukkan Jumlah" autocomplete="off" class="form-control" required>
											</div>
										</div>
										<!-- Tanggal Terima dan Jam -->
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="tgl_terima"><strong>Tanggal Terima</strong></label>
												<input type="text" name="tgl_terima" value="<?= date('d/m/Y') ?>" readonly class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label for="jam_terima"><strong>Jam Terima</strong></label>
												<input type="text" name="jam_terima" value="<?= date('H:i:s') ?>" readonly class="form-control">
											</div>
										</div>
										<!-- Catatan Tambahan -->
										<div class="form-row">
											<div class="form-group col-md-12">
												<label for="supplier"><strong>Supplier</strong></label>
												<input type="text" name="supplier" placeholder="Masukkan Supplier" autocomplete="off" class="form-control" required>
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-12">
												<label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
												<input type="text" name="catatan_tambahan" placeholder="Masukkan Catatan Tambahan" autocomplete="off" class="form-control" required>
											</div>
										</div>
										<hr>
										<!-- Submit Button -->
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>
								</div>				
							</div>
						</div>
					</div>
			
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>
	
			
		</div>
	</div>
	</div>
</div>


		</div>
	</div>
	</div>
</div>
<script>
	    $(document).ready(function() {
	        $('#dataTable').DataTable();
	    });
		document.addEventListener("DOMContentLoaded", function() {
    const topElement = document.querySelector("body");
    if (topElement && topElement.childNodes.length > 0 && topElement.childNodes[0].nodeName === "#text") {
        topElement.removeChild(topElement.childNodes[0]);
    }
});

	</script>
</body>
</html>