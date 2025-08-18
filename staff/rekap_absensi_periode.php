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

$query_Recordset1 = "SELECT *FROM absensi INNER JOIN admin ON absensi.nim=admin.nim where absensi.tanggal BETWEEN '$_POST[tgl1]' and '$_POST[tgl2]'";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <form method="post" action="cetak_absensi_pdf.php">
   <input type="hidden" name="tgl1" value="<?php echo $_POST['tgl1'] ?>">
   <input type="hidden" name="tgl2" value="<?php echo $_POST['tgl2'] ?>">
   <input type="submit" formtarget="_blank" value="Cetak Rekap Absensi Periode" class="button">
   </form>  
  
  </div>
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Rekap Absensi Asisten Dosen Dari <?php echo $_POST['tgl1'] ?> s/d <?php echo $_POST['tgl2'] ?> </h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
  <table id='table-example' class='table'>	  
	         
   <thead><tr>	
    <td>No</td>
    <td>Nama</td>
    <td>hari</td>
    <td>jam_masuk</td>
    <td>jam_keluar</td>
   </thead>
   <tbody>
  <?php $no=1; do { ?>
     <tr class=gradeX>
      <td><?php echo $no ?></td>
      <td><?php echo $row_Recordset1['nama_lengkap']; ?></td>
      <td><?php echo $row_Recordset1['hari']; ?></td>
      <td><?php echo $row_Recordset1['jam_masuk']; ?></td>
      <td><?php echo $row_Recordset1['jam_keluar']; ?></td>
    </tr>
    <?php $no++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

