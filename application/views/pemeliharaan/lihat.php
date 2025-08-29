<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('pemeliharaan') ?>">
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                           
                            <a href="<?= base_url('pemeliharaan/tambah') ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah
                            </a>
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

                    <div class="card shadow">
                        <div class="card-header"><strong>Daftar Data Pemeliharaan</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Kode Barang</td>
                                            <td>Nama Barang</td>
                                            <td>Pegawai</td>
                                            <td>jabatan</td>
                                            <td>Divisi</td>
                                            <td>Tanggal Barang Masuk</td>
                                            <td>Kondisi Perangkat Terakhir</td>
                                            <td>Catatan Tambahan</td>
                                            <td>Petugas</td>
                                            <td>Tanggal Pemeliharaan Selanjutnya</td>
                                            <td>Aksi</td>                                    
                                        </tr>
                                    </thead>
                                    <tbody id="pemeliharaanTableBody">
                                        <?php foreach ($all_pemeliharaan as $pemeliharaan): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $pemeliharaan->kode_barang ?></td>
                                                <td><?= $pemeliharaan->nama_barang ?></td>
                                                <td><?= $pemeliharaan->pegawai  ?></td>
                                                <td><?= $pemeliharaan->jabatan  ?></td>
                                                <td><?= $pemeliharaan->divisi  ?></td>
                                                <td><?= $pemeliharaan->tgl_barang_masuk ?></td>
                                                <td><?= $pemeliharaan->kondisi_perangkat_terakhir ?></td>
                                                <td><?= $pemeliharaan->catatan_tambahan?></td>
                                                <td><?= $pemeliharaan->petugas?></td>
                                                <td><?= $pemeliharaan->tgl_pemeliharaan_selanjutnya ?></td>
                                                <td style="white-space: nowrap;"> <a href="<?= base_url('pemeliharaan/ubah/' . $pemeliharaan->kode_barang) ?>" class="btn btn-success btn-sm">
                                                        <i class="fa fa-edit"></i>&nbsp;&nbsp;Edit
                                                    </a>
                                                    <a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('pemeliharaan/hapus/' . $pemeliharaan->kode_barang) ?>" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>

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