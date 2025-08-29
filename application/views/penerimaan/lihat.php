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
        <?php $this->load->view('partials/sidebar.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('penerimaan') ?>">
                <?php $this->load->view('partials/topbar.php') ?>
                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right">
                        
                        
                        <a href="<?= base_url('penerimaan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                       
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
                    <div class="card-header"><strong>Daftar Penerimaan</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>No Terima</td>
                                        <td>Nama Barang</td>
                                        <td>Jenis Barang</td>
                                        <td>Jumlah</td>
                                        <td>Supplier</td>
                                        <td>Tanggal Terima</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($all_penerimaan as $penerimaan): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $penerimaan->no_terima ?></td>
                                        <td><?= $penerimaan->nama_barang ?></td>
                                        <td><?= $penerimaan->jenis_barang ?></td>
                                        <td><?= $penerimaan->jumlah ?></td>
                                        <td><?= $penerimaan->supplier ?></td>
                                        <td><?= $penerimaan->tgl_terima ?> <?= $penerimaan->jam_terima ?></td>
                                        <td>
                                            <a href="<?= base_url('penerimaan/ubah/' . $penerimaan->no_terima) ?>" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>&nbsp;&nbsp;Edit
                                            </a>
                                            <a onclick="return confirm('Apakah anda yakin?')" href="<?= base_url('penerimaan/hapus/' . $penerimaan->no_terima) ?>" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus
                                            </a>
                                           
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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