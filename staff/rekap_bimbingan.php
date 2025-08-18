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

$colname_rekap = "-1";
if (isset($_GET['dosen'])) {
  $colname_rekap = $_GET['dosen'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rekap = sprintf("SELECT * FROM mhs_bimbingan WHERE dosen ='$_SESSION[MM_Username]' and status='Proses' ORDER BY id_mhs DESC", GetSQLValueString($colname_rekap, "text"));
$rekap = mysql_query($query_rekap, $koneksi) or die(mysql_error());
$row_rekap = mysql_fetch_assoc($rekap);
$totalRows_rekap = mysql_num_rows($rekap);
?>
<h1>Rekap Bimbingan Mahasiswa Tugas Akhir D III</h1>


        <!-- Main content -->
       <section class="content">
          <div class="row">
            <div class="col-xs-12">
<div class="box">
               <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr> 
    <td>id_mhs</td>
    <td>nim</td>
    <td>nama_mhs</td>
    <td>no_telp</td>
    <td>outline</td>
    <td>judul</td>
    <td>AKSI</td>
</thead>
   <tbody>
  <?php $no=1; do { ?>
  <tr class=gradeX>
      <td><?php echo $no ?></td>
      <td><?php echo $row_rekap['nim']; ?></td>
      <td><?php echo $row_rekap['nama_mhs']; ?></td>
      <td><?php echo $row_rekap['no_telp']; ?></td>
      <td><?php echo $row_rekap['outline']; ?></td>
      <td><?php echo $row_rekap['judul']; ?></td>
      <td><a href="?page=edit_judul_mahasiswa_bimbingan&id_mhs=<?php echo $row_rekap['id_mhs']; ?>">Judul</a> || <a href="?page=input_rekap_bimbingan&nim=<?php echo $row_rekap['nim']; ?>"> Rekap</a></td>
    </tr>
    <?php $no++; } while ($row_rekap = mysql_fetch_assoc($rekap)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rekap);
?>
</section>