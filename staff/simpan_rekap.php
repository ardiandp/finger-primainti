<?php
/*if ($_SESSION['ip']=='127.0.0.1')
{
echo "<script>alert('Gunakan Koneksi Kampus Untuk Rekap'); document.location='media.php?page=home' </script>";
}
else
{ */

$jadwal=mysql_query("select *from jadwal_asisten where id_jadwal='$_GET[id]'");
$jad=mysql_fetch_array($jadwal);

	$nim=$jad['nim'];
	$sks=$jad['sks'];
	$kelas=$jad['kelas'];
	$ruang=$jad['ruang'];
	$kode=$jad['kode'];
	$hari=$jad['hari'];
	$jam=$jad['jam'];
	$tgl=date('Y-m-d');
	$inisial=$jad['inisial'];
	
	
	$save=mysql_query("insert into rekap values ('','$nim','$kelas','$sks','$ruang','$kode','$hari','$jam','$inisial','$tgl') ") or die (" gagal simpan "); 
	echo "<script>alert ('rekap tersimpan'); document.location='?page=input_rekap_harian' </script> ";
	/* } */																																   
																																	   

?>