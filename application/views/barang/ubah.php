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
                            <a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('barang/proses_ubah/' . $barang->kode_barang) ?>" id="form-ubah" method="POST" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="kode_barang"><strong>Kode Barang</strong></label>
                                                <input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= $barang->kode_barang ?>" maxlength="8" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jenis_barang"><strong>Jenis Barang</strong></label>
                                                <select name="kode_kategori" class="form-control" required>
                                                    <option value="">Pilih Jenis Perangkat</option>
                                                    <?php foreach ($kategori as $kat): ?>
                                                        <option value="<?= $kat->kode_kategori ?>" 
                                                            <?= ($kat->kode_kategori == $barang->kode_kategori) ? 'selected' : '' ?>>
                                                            <?= $kat->nama_kategori ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama_barang"><strong>Nama Barang</strong></label>
                                                <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required value="<?= $barang->nama_barang ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tgl_masuk"><strong>Tanggal Barang Masuk</strong></label>
                                                <input type="date" name="tanggal_masuk" id="tgl_masuk" class="form-control" required value="<?= $barang->tgl_masuk ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pegawai"><strong>Pegawai</strong></label>
                                                <input type="text" name="pegawai" placeholder="Masukkan Pegawai" autocomplete="off" class="form-control" required value="<?= $barang->pegawai ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jabatan"><strong>Jabatan</strong></label>
                                                <select name="jabatan" id="jabatan" class="form-control" required>
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    <?php foreach ($all_jabatan as $j): ?>
                                                        <option value="<?= $j->nama_jabatan ?>" <?= ($barang->jabatan == $j->nama_jabatan) ? 'selected' : '' ?>>
                                                            <?= $j->nama_jabatan ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="divisi"><strong>Divisi</strong></label>
                                                <select name="divisi" id="divisi" class="form-control" required>
                                                    <option value="">-- Pilih Divisi --</option>
                                                    <?php foreach ($all_divisi as $d): ?>
                                                        <option value="<?= $d->nama_divisi ?>" <?= ($barang->divisi == $d->nama_divisi) ? 'selected' : '' ?>>
                                                            <?= $d->nama_divisi ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status"><strong>Status</strong></label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <option value="milik dinas" <?= $barang->status == 'milik dinas' ? 'selected' : '' ?>>Milik Dinas</option>
                                                    <option value="sewa" <?= $barang->status == 'sewa' ? 'selected' : '' ?>>Sewa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="merk"><strong>Merk</strong></label>
                                                <input type="text" name="merk" placeholder="Masukkan Merk" autocomplete="off" class="form-control" required value="<?= $barang->merk ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="type"><strong>Type</strong></label>
                                                <input type="text" name="type" placeholder="Masukkan Type" autocomplete="off" class="form-control" required value="<?= $barang->type ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="kondisi"><strong>Kondisi</strong></label>
                                                <select name="kondisi" id="kondisi" class="form-control" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <option value="baik" <?= $barang->kondisi == 'baik' ? 'selected' : '' ?>>Baik</option>
                                                    <option value="rusak" <?= $barang->kondisi == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gambar_produk"><strong>Gambar Barang</strong></label>
                                                <?php if($barang->gambar_barang): ?>
                                                    <img src="<?= base_url('uploads/'.$barang->gambar_barang) ?>" alt="Gambar Produk" width="150" class="mb-2 d-block">
                                                <?php endif; ?>
                                                <input type="file" name="gambar_barang" class="form-control" accept="image/*">
                                                <input type="hidden" name="gambar_lama" value="<?= $barang->gambar_barang ?>">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
                                                
                                                <textarea name="catatan_tambahan" id="catatan_tambahan" style="resize: none;" placeholder="Masukkan Catatan Tambahan" class="form-control" required><?= isset($barang->catatan_tambahan) ? htmlspecialchars($barang->catatan_tambahan) : '' ?></textarea>

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
            
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>
</body>
</html>