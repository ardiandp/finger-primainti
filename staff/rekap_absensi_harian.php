<?php require_once('../Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_koneksi, $koneksi);
$query_rekap_absensi_harian = "SELECT *from absensi inner join admin on absensi.nim=admin.nim WHERE absensi.tanggal='2015-05-26'";
$rekap_absensi_harian = mysql_query($query_rekap_absensi_harian, $koneksi) or die(mysql_error());
$row_rekap_absensi_harian = mysql_fetch_assoc($rekap_absensi_harian);
$totalRows_rekap_absensi_harian = mysql_num_rows($rekap_absensi_harian);
?>
<div id='main-content'>
   <div class='container_12'>
   
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Rekap Absensi Asisten Dosen Harian </h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
  <table id='table-example' class='table'>	  
	         
   <thead><tr>
    <td>No</td>
    <td>tanggal</td>
    <td>Nama Lengkap</td>
    <td>hari</td>
    <td>jam_masuk</td>
    <td>jam_keluar</td>
   </thead>
   <tbody>
  <?php $no=1; do { ?>
     <tr class=gradeX>
      <td><?php echo $no ?></td>
      <td><?php echo $row_rekap_absensi_harian['tanggal']; ?></td>
      <td><?php echo $row_rekap_absensi_harian['nama_lengkap']; ?></td>
      <td><?php echo $row_rekap_absensi_harian['hari']; ?></td>
      <td><?php echo $row_rekap_absensi_harian['jam_masuk']; ?></td>
      <td><?php echo $row_rekap_absensi_harian['jam_keluar']; ?></td>
    </tr>
    <?php $no++;} while ($row_rekap_absensi_harian = mysql_fetch_assoc($rekap_absensi_harian)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rekap_absensi_harian);
?>
