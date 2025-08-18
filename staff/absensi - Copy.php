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
$query_absen = "SELECT * FROM absensi inner join admin on absensi.nim=admin.nim where absensi.tanggal='$tgl'";
$absen = mysql_query($query_absen, $koneksi) or die(mysql_error());
$row_absen = mysql_fetch_assoc($absen);
$totalRows_absen = mysql_num_rows($absen);
?>
<div id='main-content'>
   <div class='container_12'>
   
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Absensi Asisten Dosen </h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
  <table id='table-example' class='table'>	  
	         
   <thead><tr>	
    <td>NO</td>
    <td>hari</td>
    <td>jam_masuk</td>
    <td>jam_keluar</td>
    <td>keterangan</td>
   </thead>
   <tbody>
  <?php $no=1; do  { ?>
  <?php $ket=$row_absen['keterangan']; ?>
  <tr class=gradeX>
      <td><?php echo $no ?></td>
      <td><?php echo $row_absen['nama_lengkap']; ?></td>
      <td><?php echo $row_absen['jam_masuk']; ?></td>
      <td><?php echo $row_absen['jam_keluar']; ?></td>
<?php
if($ket=='Sudah Datang')
{
	echo "<td>Sudah Berada Di Kampus</td>";
}
else
{
	echo "<td>Pulang Dari Kampus</td>";
} ?>
     
    </tr>
    <?php $no++;} while ($row_absen = mysql_fetch_assoc($absen)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($absen);
?>
