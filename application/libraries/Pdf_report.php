<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf/fpdf.php');

class Pdf_report extends FPDF {
    function __construct() {
        parent::__construct();
    }

    // Method untuk header PDF
    function Header() {
        $this->SetFont('Arial', 'B', 18); // Ukuran font lebih besar
        $this->Cell(0, 10, 'Laporan Data Barang Perangkat IT', 0, 1, 'C'); // Kolom diatur agar berada di tengah dengan 'C'
        $this->Ln(10);
    }

    // Method untuk footer PDF
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }

    // Method untuk membuat tabel
    function generate_report($data_barang) {
        // Header tabel
        $this->SetFont('Arial', 'B', 10);

        // Set lebar kolom
        $this->Cell(10, 10, 'No', 1, 0, 'C'); // Kolom nomor
        $this->Cell(30, 10, 'Kode Perangkat', 1, 0, 'C');
        $this->Cell(40, 10, 'Nama Perangkat', 1, 0, 'C');
        $this->Cell(30, 10, 'Jenis', 1, 0, 'C');
        $this->Cell(40, 10, 'Pengguna', 1, 0, 'C');
        $this->Cell(40, 10, 'Lokasi', 1, 0, 'C');
        $this->Cell(30, 10, 'Status', 1, 1, 'C'); // Pindah ke baris berikutnya dengan 1,1

        // Isi tabel
        $this->SetFont('Arial', '', 10);
        $no = 1; // Inisialisasi nomor urut
        foreach ($data_barang as $barang) {
            $this->Cell(10, 10, $no++, 1, 0, 'C'); // Kolom nomor urut
            $this->Cell(30, 10, $barang->kode_perangkat, 1);
            $this->Cell(40, 10, $barang->nama_perangkat, 1);
            $this->Cell(30, 10, $barang->jenis_perangkat, 1);
            $this->Cell(40, 10, $barang->pengguna, 1);
            $this->Cell(40, 10, $barang->lokasi, 1);
            $this->Cell(30, 10, $barang->status, 1);
            $this->Ln(); // Pindah ke baris berikutnya
        }
    }
}
