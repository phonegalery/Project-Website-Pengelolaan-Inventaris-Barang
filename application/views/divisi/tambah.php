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
			<div id="content" data-url="<?= base_url('divisi') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('divisi') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				
				<div class="card shadow">
    <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
    <div class="card-body">
        <form action="<?= base_url('divisi/proses_tambah') ?>" id="form-tambah" method="POST">
            <div class="form-row">
                <!-- Nama Divisi -->
                <div class="form-group col-md-6">
                    <label for="nama_divisi"><strong>Nama Divisi</strong></label>
                    <input type="text" name="nama_divisi" placeholder="Masukkan Nama Divisi" autocomplete="off" class="form-control" required>
                </div>
                <!-- Kepala Divisi -->
                <div class="form-group col-md-6">
                    <label for="kepala_divisi"><strong>Kepala Divisi</strong></label>
                    <input type="text" name="kepala_divisi" placeholder="Masukkan Nama Kepala Divisi" autocomplete="off" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <!-- Jumlah Barang -->
                <div class="form-group col-md-6">
                    <label for="jumlah_barang"><strong>Jumlah Barang</strong></label>
                    <input type="number" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" autocomplete="off" class="form-control" required>
                </div>
                <!-- Catatan Tambahan -->
                <div class="form-group col-md-6">
                    <label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
                    <input type="text" name="catatan_tambahan" placeholder="Masukkan Catatan Tambahan" autocomplete="off" class="form-control" required>
                </div>
            </div>
            <hr>
            <div class="form-group text-right">
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