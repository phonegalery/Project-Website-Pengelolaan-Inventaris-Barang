<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Load Sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('pemeliharaan') ?>">
                <!-- Load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('pemeliharaan') ?>" class="btn btn-secondary btn-sm">
                                <i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali
                            </a>
                        </div>
                    </div>
                    <hr>

                    <!-- Form Ubah Data -->
                    <div class="card shadow">
                        <div class="card-header">
                            <strong>Isi Form Dibawah Ini!</strong>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('pemeliharaan/proses_ubah/' . $pemeliharaan->kode_barang) ?>" id="form-ubah" method="POST" enctype="multipart/form-data">
                                <!-- Baris 1 -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="kode_barang"><strong>Kode Barang</strong></label>
                                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $pemeliharaan->kode_barang ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nama_barang"><strong>Nama Barang</strong></label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $pemeliharaan->nama_barang ?>" required>
                                    </div>
                                </div>

                                <!-- Baris 2 -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pegawai"><strong>Pegawai</strong></label>
                                        <input type="text" class="form-control" id="pegawai" name="pegawai" value="<?= $pemeliharaan->pegawai?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jabatan"><strong>Jabatan</strong></label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $pemeliharaan->jabatan ?>" required>
                                    </div>
                                </div>

                                <!-- Baris 3 -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="divisi"><strong>Divisi</strong></label>
                                        <input type="text" class="form-control" id="divisi" name="divisi" value="<?= $pemeliharaan->catatan_tambahan ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="tgl_barang_masuk"><strong>Tanggal Barang Masuk</strong></label>
                                        <input type="date" class="form-control" id="tgl_barang_masuk" name="tgl_barang_masuk" value="<?= $pemeliharaan->tgl_barang_masuk ?>" required>
                                    </div>
                                </div>

                                <!-- Baris 4 -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="kondisi_perangkat_terakhir"><strong>Kondisi Perangkat Terakhir</strong></label>
                                        <select class="form-control" id="kondisi_perangkat_terakhir" name="kondisi_perangkat_terakhir" required>
                                            <option value="" disabled selected>-- Silahkan Pilih --</option>
                                            <option value="Sudah Diperbaiki" <?= $pemeliharaan->kondisi_perangkat_terakhir == 'Sudah Diperbaiki' ? 'selected' : '' ?>>Sudah Diperbaiki</option>
                                            <option value="Rusak" <?= $pemeliharaan->kondisi_perangkat_terakhir == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                                            <option value="Butuh Perbaikan" <?= $pemeliharaan->kondisi_perangkat_terakhir == 'Butuh Perbaikan' ? 'selected' : '' ?>>Butuh Perbaikan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
                                    <input type="text" class="form-control" id="catatan_tambahan" name="catatan_tambahan" value="<?= $pemeliharaan->catatan_tambahan ?>" required>
                                </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="petugas"><strong>Nama Petugas</strong></label>
                                        <select class="form-control" id="petugas" name="petugas" required>
                                            <option value="" disabled selected>Pilih Nama Petugas</option>
                                            <?php foreach ($data_petugas as $petugas): ?>
                                                <option value="<?= $petugas->nama; ?>" <?= ($pemeliharaan->petugas == $petugas->nama) ? 'selected' : ''; ?>>
                                                    <?= $petugas->nama; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="tgl_pemeliharaan_selanjutnya"><strong>Tanggal Pemeliharaan Selanjutnya</strong></label>
                                        <input type="date" class="form-control" id="tgl_pemeliharaan_selanjutnya" name="tgl_pemeliharaan_selanjutnya" value="<?= $pemeliharaan->tgl_pemeliharaan_selanjutnya ?>" required>
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
                <!-- End Form -->
            </div>

            <!-- Load Footer -->
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>
</body>



    <!-- Script untuk memperbaiki elemen top -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const topElement = document.querySelector("body");
        if (topElement && topElement.childNodes.length > 0 && topElement.childNodes[0].nodeName === "#text") {
            topElement.removeChild(topElement.childNodes[0]);
        }
    });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




</body>

</html>
