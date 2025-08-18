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
$query_rekap = "SELECT rekap.id_rekap,rekap.nim,rekap.kelas,rekap.sks,rekap.ruang,rekap.kode,rekap.hari,rekap.jam,rekap.inisial,rekap.tanggal,admin.nama_lengkap FROM rekap INNER JOIN admin ON rekap.nim=admin.nim and rekap.tanggal='$tgl'";
$rekap = mysql_query($query_rekap, $koneksi) or die(mysql_error());
$row_rekap = mysql_fetch_assoc($rekap);
$totalRows_rekap = mysql_num_rows($rekap);
?>

   
<h1>REKAP ASISTEN HARI INI :  <?php echo "  $hari_ini, ";  echo tgl_indo(date("Y m d")); ?></h1>


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
        <div class="box">     
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr> 
    <td>NO</td>
    <td>nim</td>
    <td>kelas</td>
    <td>sks</td>
    <td>ruang</td>
    <td>kode</td>
    <td>hari</td>
    <td>jam</td>
    <td>inisial</td>
    <td>tanggal</td>
    <td>nama_lengkap</td>
    <td>Aksi</td>
</thead>
   <tbody>
  <?php $no=1; do { ?>
 <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_rekap['nim']; ?></td>
      <td><?php echo $row_rekap['kelas']; ?></td>
      <td><?php echo $row_rekap['sks']; ?></td>
      <td><?php echo $row_rekap['ruang']; ?></td>
      <td><?php echo $row_rekap['kode']; ?></td>
      <td><?php echo $row_rekap['hari']; ?></td>
      <td><?php echo $row_rekap['jam']; ?></td>
      <td><?php echo $row_rekap['inisial']; ?></td>
      <td><?php echo $row_rekap['tanggal']; ?></td>
      <td><?php echo $row_rekap['nama_lengkap']; ?></td>
      <td><a href="?page=hapus_rekap&id_rekap=<?php echo $row_rekap['id_rekap']; ?>">Del</a></td>
    </tr>
    <?php $no++; } while ($row_rekap = mysql_fetch_assoc($rekap)); ?>
</tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
mysql_free_result($rekap);
?>
</section>
