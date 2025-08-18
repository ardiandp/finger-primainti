<?php
session_start();
	// import file koneksi
	include_once("../Connections/koneksi.php"); 
	
	// include file fpdf.php
	include("../fpdf/fpdf.php"); 
	
	// buat objek FPDF baru dengan pengaturan berikut
	$pdf = new FPDF("P","mm","A4");
	// P = posisi page potrait (L untuk landscape)
	// mm = satuan ukuran yang digunakan
	// A4 = ukuran kertas yang digunakan (A5, A4, F4, dll)
	
	//buat halaman baru
	$pdf->AddPage();
	
	// menentukan warna background tulisan (format RGB)
	$pdf->SetFillColor(225,225,225);
	
	// menentukan warna drawing line
	$pdf->SetDrawColor(205,205,205);
	
	// menentukan jenis, ketebalan, dan ukuran font
	// SetFont("jenis", "ketebalan (B untuk bold)", "ukuran");
	$pdf->SetFont('Arial','',9);

	// header tabel
	$pdf->Cell(40,5,"Asisten",1,0,'C',true);
	$pdf->Cell(15,5,"Kelas",1,0,'C',true);
	$pdf->Cell(10,5,"SKS",1,0,'C',true);
	$pdf->Cell(12,5,"Ruang",1,0,'C',true);
	$pdf->Cell(17,5,"Matkul",1,0,'C',true);
	$pdf->Cell(17,5,"Hari",1,0,'C',true);
	$pdf->Cell(25,5,"jam",1,0,'C',true);
	$pdf->Cell(25,5,"Tanggal",1,0,'C',true);
	$pdf->Cell(20,5,"Dosen",1,0,'C',true);

	// ganti  warna fill untuk membedakan cell
	$pdf->SetFillColor(245,245,245);
	
	// query ke MySQL database
$tgl1=$_GET['tgl1'];
$tgl2=$_GET['tgl2'];
$nim=$_SESSION['MM_Username'];
	$hasil_query = mysql_query("SELECT *FROM admin,rekap WHERE rekap.nim=admin.nim AND rekap.nim='$nim' AND rekap.tanggal BETWEEN  '$tgl1' and '$tgl2' "); 
	
	// parsing hasil query
	// tampilkan dengan fungsi FPDF
	while($hasil = mysql_fetch_array($hasil_query)){
		// ganti baris
		$pdf->Ln();
		
		// tampilkan cell
		$pdf->Cell(40,5,$hasil["nama_lengkap"],1,0,'L',true);
		$pdf->Cell(15,5,$hasil["kelas"],1,0,'L',true);
		$pdf->Cell(10,5,$hasil["sks"],1,0,'C',true);
		$pdf->Cell(12,5,$hasil["ruang"],1,0,'L',true);
		$pdf->Cell(17,5,$hasil["kode"],1,0,'L',true);
		$pdf->Cell(17,5,$hasil["hari"],1,0,'L',true);
		$pdf->Cell(25,5,$hasil["jam"],1,0,'L',true);
		$pdf->Cell(25,5,$hasil["tanggal"],1,0,'L',true);
		$pdf->Cell(20,5,$hasil["inisial"],1,0,'L',true);
		
	}
	
	$pdf->Output();
	exit();
?>