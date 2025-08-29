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
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
					</div>
					<hr>

					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>

					
					<div class="row">
			            <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-primary shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Barang</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-box fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div>

			            <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-success shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Petugas</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_petugas ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-users fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div>
						
						
						<div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-success shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah admin</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_admin ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-users fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div>

						<div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-success shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pengelola</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pengelola ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-users fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Jenis Perangkat</div>
											<select class="form-control mt-2">
												<option disabled selected>Jenis Barang</option>
												<?php foreach($jumlah_jenis_barang as $barang): ?>
													<option>
														<?= $barang->jenis_barang ?> (<?= $barang->jumlah ?>)
													</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-auto">
											<i class="fas fa-desktop fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>



			            <div class="col-xl-3 col-md-6 mb-4">
			              <div class="card border-left-primary shadow h-100 py-2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah  Penerimaan Barang yang Masuk</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penerimaan ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-box fa-2x text-gray-300"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div> 	
					
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Status Perbaikan Barang</div>
									<select class="form-control mt-2">
										<option disabled selected>Status Perbaikan Barang</option>
										<?php foreach($jumlah_kondisi_perangkat_terakhir as $pemeliharaan): ?>
											<option>
											<?= ($pemeliharaan->kondisi_perangkat_terakhir) ?> (<?= ($pemeliharaan->jumlah) ?>)
											</option>
										<?php endforeach; ?>
									
									</select>
									</div>
									<div class="col-auto">
									<i class="fas fa-tools fa-2x text-gray-300"></i>
									</div>
								</div>
								</div>
							</div>
							</div>


					


					</div>


					
					<!-- Baris Profil Sistem dan User Sedang Login -->
			        <div class="row">
			          	<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Profil Sistem</strong></div>
								<div class="card-body">
									<strong>Nama Sistem : </strong><br>
									<input type="text" value="<?= $toko->nama_toko ?>" readonly class="form-control mt-2 mb-2">
									<strong>Nama Pemilik : </strong><br>
									<input type="text" value="<?= $toko->nama_pemilik ?>" readonly class="form-control mt-2 mb-2">
									<strong>No Telepon : </strong><br>
									<input type="text" value="<?= $toko->no_telepon ?>" readonly class="form-control mt-2 mb-2">
									<strong>Alamat : </strong><br>
									<input type="text" value="<?= $toko->alamat ?>" readonly class="form-control mt-2">
								</div>				
							</div>
			          	</div>
			          	<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>User Sedang Login</strong></div>
								<div class="card-body">
									<strong>Nama : </strong><br>
									<input type="text" value="<?= $this->session->login['nama'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Username : </strong><br>
									<input type="text" value="<?= $this->session->login['username'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Role : </strong><br>
									<input type="text" value="<?= $this->session->login['role'] ?>" readonly class="form-control mt-2 mb-2">
									<strong>Jam Login : </strong><br>
									<input type="text" value="<?= $this->session->login['jam_masuk'] ?>" readonly class="form-control mt-2">
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

	<!-- load js -->
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
		    const topElement = document.querySelector("body");
		    if (topElement && topElement.childNodes.length > 0 && topElement.childNodes[0].nodeName === "#text") {
		        topElement.removeChild(topElement.childNodes[0]);
		    }
		});
	</script>
</body>
</html>
