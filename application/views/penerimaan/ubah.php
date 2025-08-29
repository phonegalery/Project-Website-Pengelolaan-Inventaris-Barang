<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
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
                            <a href="<?= base_url('penerimaan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="card shadow">
                        <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                        <div class="card-body">
                            <form action="<?= base_url('penerimaan/proses_ubah/' . $penerimaan->no_terima) ?>" id="form-tambah" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="no_terima"><strong>No. Terima</strong></label>
                                        <input type="text" name="no_terima" value="<?= $penerimaan->no_terima ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nama_barang"><strong>Nama Barang</strong></label>
                                        <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required value="<?= $penerimaan->nama_barang ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="jenis_barang"><strong>Jenis Barang</strong></label>
                                        <input type="text" name="jenis_barang" placeholder="Masukkan Jenis Barang" autocomplete="off" class="form-control" required value="<?= $penerimaan->jenis_barang ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jumlah"><strong>Jumlah</strong></label>
                                        <input type="number" name="jumlah" placeholder="Masukkan Jumlah" autocomplete="off" class="form-control" required value="<?= $penerimaan->jumlah ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tgl_terima"><strong>Tanggal Terima</strong></label>
                                        <input type="text" name="tgl_terima" value="<?= $penerimaan->tgl_terima ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jam_terima"><strong>Jam Terima</strong></label>
                                        <input type="text" name="jam_terima" value="<?= $penerimaan->jam_terima ?>" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="supplier"><strong>Supplier</strong></label>
                                        <input type="text" name="supplier" placeholder="Masukkan Supplier" autocomplete="off" class="form-control" required value="<?= $penerimaan->supplier ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
                                        <input type="text" name="catatan_tambahan" placeholder="Masukkan Catatan Tambahan" autocomplete="off" class="form-control" required value="<?= $penerimaan->catatan_tambahan ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan Perubahan</button>
                                    <a href="<?= base_url('penerimaan') ?>" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</a>
                                </div>
                            </form>
                        </div>                      
                    </div>
                </div>
            </div>
            
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>
</body>
</html>