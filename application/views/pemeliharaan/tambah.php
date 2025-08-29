<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head.php'); ?>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('partials/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('pemeliharaan'); ?>">
                <!-- Topbar -->
                <?php $this->load->view('partials/topbar.php'); ?>

                <div class="container-fluid">
                    <div class="clearfix mb-3">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title; ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('pemeliharaan'); ?>" class="btn btn-secondary btn-sm">
                                <i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali
                            </a>
                        </div>
                    </div>
                    <hr>

                    <!-- Form Tambah Data -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
                                <div class="card-body">
                                    <form action="<?= base_url('pemeliharaan/proses_tambah'); ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
                                        <!-- Baris 1 -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="kode_barang"><strong>Kode Barang</strong></label>
                                                <select name="kode_barang" id="kode_barang" class="form-control select2" required>
                                                    <option value="">-- Pilih Kode Barang --</option>
                                                    <?php foreach ($barang as $item): ?>
                                                        <option value="<?= $item->kode_barang ?>"><?= $item->kode_barang ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="nama_barang"><strong>Nama Barang</strong></label>
                                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Nama Barang" readonly>
                                            </div>
                                        </div>

                                        <!-- Baris 2 -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pegawai"><strong>Pegawai</strong></label>
                                                <input type="text" name="pegawai" id="pegawai" class="form-control" placeholder="Pegawai" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jabatan"><strong>Jabatan</strong></label>
                                                <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan" readonly>
                                            </div>
                                        </div>

                                        <!-- Baris 3 -->
                                        <div class="form-row">
                                        <div class="form-group col-md-6">
                                                <label for="divisi"><strong>Divisi</strong></label>
                                                <input type="text" name="divisi" id="divisi" class="form-control" placeholder="Jabatan" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="tgl_barang_masuk"><strong>Tanggal Barang Masuk</strong></label>
                                                <input type="date" name="tgl_barang_masuk" id="tgl_barang_masuk" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="kondisi_perangkat_terakhir"><strong>Kondisi Perangkat Terakhir</strong></label>
                                                <select name="kondisi_perangkat_terakhir" id="kondisi_perangkat_terakhir" class="form-control" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <option value="Sudah Diperbaiki">Baik</option>
                                                    <option value="Rusak">Rusak</option>
                                                    <option value="Butuh Perbaikan">Butuh Perbaikan</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="catatan_tambahan"><strong>Catatan Tambahan</strong></label>
                                                <input type="text" class="form-control" id="catatan_tambahan" name="catatan_tambahan" placeholder="Masukkan Catatan Tambahan" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="petugas"><strong>Nama Petugas</strong></label>
                                            <select class="form-control" id="petugas" name="petugas" required>
                                                    <option value="" disabled selected>Pilih Nama Petugas</option>
                                                    <?php foreach ($petugas as $p): ?>
                                                        <option value="<?= htmlspecialchars($p->nama); ?>"><?= htmlspecialchars($p->nama); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="tgl_pemeliharaan_selanjutnya"><strong>Tanggal Pemeliharaan Selanjutnya</strong></label>
                                                <input type="date" class="form-control" id="tgl_pemeliharaan_selanjutnya" name="tgl_pemeliharaan_selanjutnya" placeholder="Masukkan Tanggal" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            
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
                    <!-- End Form -->
                </div>
            </div>

            <!-- Footer -->
            <?php $this->load->view('partials/footer.php'); ?>
        </div>
    </div>

    <?php $this->load->view('partials/js.php'); ?>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script>
 document.addEventListener("DOMContentLoaded", function() {
        const topElement = document.querySelector("body");
        if (topElement && topElement.childNodes.length > 0 && topElement.childNodes[0].nodeName === "#text") {
            topElement.removeChild(topElement.childNodes[0]);
        }
    });
</script>
    <script>
        // Inisialisasi Select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih atau cari kode perangkat",
                allowClear: true,
                width: '100%'
            });

            // AJAX untuk autofill nama barang dan pegawai
            $('#kode_barang').on('change', function() {
                const kodeBarang = $(this).val();

                if (kodeBarang) {
                    $.ajax({
                        url: "<?= base_url('barang/get_data_barang') ?>",
                        method: "POST",
                        data: { kode_barang: kodeBarang },
                        dataType: "json",
                        success: function(response) {
                            if (response.status === "success") {
                                $('#nama_barang').val(response.data.nama_barang || "Data tidak tersedia");
                                $('#pegawai').val(response.data.pegawai || "Data tidak tersedia");
                                $('#jabatan').val(response.data.jabatan || "Data tidak tersedia");
                                $('#divisi').val(response.data.divisi || "Data tidak tersedia");
                            } else {
                                alert(response.message || "Data tidak ditemukan.");
                                $('#nama_barang').val("");
                                $('#pegawai').val("");
                                $('#jabatan').val("");
                                $('#divisi').val("");
                            }
                        },
                        error: function() {
                            alert("Terjadi kesalahan. Silakan coba lagi.");
                        }
                    });
                } else {
                    $('#nama_barang').val("");
                    $('#pegawai').val("");
                    $('#jabatan').val("");
                    $('#divisi').val("");
                }
            });
        });
    </script>
</body>

</html>
