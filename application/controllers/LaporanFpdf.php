<?php
require('application/libraries/FPDF/fpdf.php');
$CI =& get_instance(); // Mendapatkan instance CodeIgniter
$CI->load->database(); // Menggunakan database di CodeIgniter

class PDF_Report extends FPDF {
    // Header halaman
    function Header() {
        // Logo (sesuaikan path logo Anda)
        $this->Image('path/to/logo.png', 10, 6, 30); 
        // Set font untuk judul
        $this->SetFont('Arial','B',12);
        // Judul
        $this->Cell(190,10,'Data Barang Perangkat IT',0,1,'C');
        $this->Ln(10); // Pindah baris
    }

    // Footer halaman
    function Footer() {
        // Posisi 1,5 cm dari bawah
        $this->SetY(-15);
        // Font Arial italic 8
        $this->SetFont('Arial','I',8);
        // Nomor halaman
        $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Tabel Data Barang
    function CreateTable($header, $data) {
        // Lebar kolom (40 untuk kolom gambar)
        $widths = array(20, 40, 30, 30, 20, 25, 25, 40); 
        // Header tabel
        for($i=0;$i<count($header);$i++) {
            $this->Cell($widths[$i],7,$header[$i],1,0,'C');
        }
        $this->Ln();
        
        // Isi tabel
        foreach($data as $row) {
            $this->Cell($widths[0],6,$row['kode'],1,0,'C');
            $this->Cell($widths[1],6,$row['jenis'],1,0,'C');
            $this->Cell($widths[2],6,$row['nama'],1,0,'C');
            $this->Cell($widths[3],6,$row['pengguna'],1,0,'C');
            $this->Cell($widths[4],6,$row['lokasi'],1,0,'C');
            $this->Cell($widths[5],6,$row['status'],1,0,'C');
            $this->Cell($widths[6],6,$row['merk'],1,0,'C');
            
            // Menambahkan gambar produk (40px)
            if (!empty($row['gambar']) && file_exists($row['gambar'])) {
                $this->Cell($widths[7], 20, $this->Image($row['gambar'], $this->GetX(), $this->GetY(), 20, 20), 1, 0, 'C');
            } else {
                // Jika tidak ada gambar
                $this->Cell($widths[7], 20, 'No Image', 1, 0, 'C');
            }

            $this->Ln();
        }
    }
}

// Mengambil data dari database
$query = $CI->db->query("SELECT kode, jenis, nama, pengguna, lokasi, status, merk, gambar_produk FROM tabel_barang");
$data = array();
foreach ($query->result() as $row) {
    $data[] = array(
        'kode' => $row->kode,
        'jenis' => $row->jenis,
        'nama' => $row->nama,
        'pengguna' => $row->pengguna,
        'lokasi' => $row->lokasi,
        'status' => $row->status,
        'merk' => $row->merk,
        // Path lengkap ke gambar
        'gambar' => 'uploads/' . $row->gambar_produk
        
    );
}

// Pembuatan PDF
$pdf = new PDF_Report();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

// Header tabel
$header = array('Kode', 'Jenis', 'Nama', 'Pengguna', 'Lokasi', 'Status', 'Merk', 'Gambar Produk');
$pdf->CreateTable($header, $data);

$pdf->Output();
?>
