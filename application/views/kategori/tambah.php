<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
	<style>
    .content-wrapper {
        margin-bottom: 100px; /* Memberikan jarak bawah pada konten */
    }
    footer {
        margin-top: 150px; /* Memberikan jarak atas pada footer */
    }
</style>

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('kategori') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <!-- Konten Form Tambah -->
                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('kategori') ?>" class="btn btn-secondary btn-sm">
                                <i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong>Isi Form Dibawah Ini!</strong>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('kategori/proses_tambah') ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="kode_kategori"><strong>Kode Kategori</strong></label>
                                                <input type="text" name="kode_kategori" placeholder="Masukkan Kode Perangkat" autocomplete="off" class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nama_kategori"><strong>Nama Kategori</strong></label>
                                                <input type="text" name="nama_kategori" placeholder="Masukkan Nama Kategori" autocomplete="off" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dibuat_tgl"><strong>Dibuat Tanggal</strong></label>
                                                <input type="text" name="dibuat_tgl" value="<?= date('d/m/Y') ?>" readonly class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i>&nbsp;&nbsp;Simpan
                                            </button>
                                            <button type="reset" class="btn btn-danger">
                                                <i class="fa fa-times"></i>&nbsp;&nbsp;Batal
                                            </button>
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

    <!-- load JS -->
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
