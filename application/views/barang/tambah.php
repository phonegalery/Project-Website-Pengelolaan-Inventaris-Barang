<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('barang') ?>">
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm">
                                <i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali
                            </a>
                        </div>
                    </div>
                    <hr>

                    <div class="card shadow">
                        <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                        <div class="card-body">
                            <form id="form-tambah-barang" action="<?= base_url('barang/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="kode_barang"><strong>Kode Barang</strong></label>
                                        <input type="text" name="kode_barang" placeholder="Masukkan Kode Perangkat" autocomplete="off" class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jenis_barang"><strong>Jenis Barang</strong></label>
                                        <select name="kode_kategori" class="form-control" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k->kode_kategori ?>"><?= $k->nama_kategori ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nama_barang"><strong>Nama Barang</strong></label>
                                        <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tanggal_masuk"><strong>Tanggal Masuk</strong></label>
                                        <input type="date" name="tanggal_masuk" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pengguna"><strong>Pegawai</strong></label>
                                        <input type="text" name="pegawai" placeholder="Masukkan Nama Pegawai" autocomplete="off" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jabatan"><strong>Jabatan</strong></label>
                                        <select name="jabatan" id="jabatan" class="form-control" required>
                                            <option value="">-- Pilih Jabatan --</option>
                                            <?php foreach ($all_jabatan as $jabatan): ?>
                                                <option value="<?= $jabatan->nama_jabatan ?>"><?= $jabatan->nama_jabatan ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="divisi"><strong>Divisi</strong></label>
                                        <select name="divisi" id="divisi" class="form-control" required>
                                            <option value="">-- Pilih Divisi --</option>
                                            <?php foreach ($all_divisi as $divisi): ?>
                                                <option value="<?= $divisi->nama_divisi ?>"><?= $divisi->nama_divisi ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status"><strong>Status</strong></label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="milik dinas">Milik Dinas</option>
                                            <option value="sewa">Sewa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="merk"><strong>Merk</strong></label>
                                        <input type="text" name="merk" placeholder="Masukkan Merk" autocomplete="off" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="type"><strong>Type</strong></label>
                                        <input type="text" name="type" placeholder="Masukkan Type" autocomplete="off" class="form-control" required>
                                    </div>
                                </div>
                        
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="kondisi"><strong>Kondisi</strong></label>
                                        <select name="kondisi" id="kondisi" class="form-control" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="baik">Baik</option>
                                            <option value="rusak">Rusak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gambar_produk"><strong>Gambar Barang</strong></label>
                                        <input type="file" name="gambar_barang" class="form-control" accept="image/*" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
                                    <textarea name="catatan_tambahan" id="catatan_tambahan" style="resize: none;" class="form-control" placeholder="Masukkan Catatan Tambahan" required></textarea>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                </div>
                            </form>

                            <div id="notif" style="display:none;"></div>
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