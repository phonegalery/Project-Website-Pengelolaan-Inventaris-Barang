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
			<div id="content" data-url="<?= base_url('kategori') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('kategori') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
								<form action="<?= base_url('kategori/proses_ubah/' . $kategori->kode_kategori) ?>" id="form-ubah" method="POST" enctype="multipart/form-data">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_kategori"><strong>Kode Kategori</strong></label>
											<input type="text" name="kode_kategori" class="form-control" required value="<?= $kategori->kode_kategori ?>" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_kategori"><strong>Nama Kategori</strong></label>
											<input type="text" name="nama_kategori" class="form-control" required value="<?= $kategori->nama_kategori ?>">
										</div>
									</div>
									<div class="form-row">
									<div class="form-group col-md-6">
										<label for="jumlah"><strong>Jumlah</strong></label>
										<input type="text" name="jumlah" value="<?= $kategori->jumlah ?>" readonly class="form-control">
									</div>

										<div class="form-group col-md-6">
											<label for="dibuat_tgl"><strong>Dibuat Tanggal</strong></label>
											<input type="text" name="dibuat_tgl" value="<?= date('d/m/Y', strtotime($kategori->dibuat_tgl)) ?>" readonly class="form-control">
										</div>
									</div>
									
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
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
