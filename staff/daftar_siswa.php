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
$query_daftarsiswa = "SELECT * FROM aji_daftar_siswa";
$daftarsiswa = mysql_query($query_daftarsiswa, $koneksi) or die(mysql_error());
$row_daftarsiswa = mysql_fetch_assoc($daftarsiswa);
$totalRows_daftarsiswa = mysql_num_rows($daftarsiswa);
?>
<h1>Data Siswa Calon PMB</h1>
</section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
        <div class="box">     
                <div class="box-body"><a href=?page=input_siswa_psb><input type="button" value="Tambah Siswa PSB" class="btn btn-success"> </a>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
  <tr>
    <th>NO</th>
    <th>JENIS SEKOLAH</th>
    <th>KATEGORI</th>
    <th>NAMA SEKOLAH</th>
    <th>KABUPATEN</th>
    <th>CP GURU</th>
    <th>HP</th>
    <th>AKSI</th>
     </tr>
                    </thead>
                    <tbody>
  <?php $no=1; do { ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_daftarsiswa['jenis_sekolah']; ?></td>
      <td><?php echo $row_daftarsiswa['kategori']; ?></td>
      <td><?php echo $row_daftarsiswa['nama_sekolah']; ?></td>
      <td><?php echo $row_daftarsiswa['kabupaten']; ?></td>
      <td><?php echo $row_daftarsiswa['cp_guru']; ?></td>
      <td><?php echo $row_daftarsiswa['hp']; ?></td>
      <td><a href="?page=edit_siswa_psb&no=<?php echo $row_daftarsiswa['no']; ?>">Edit || </a><a href="?page=del_siswa_pmb&no=<?php echo $row_daftarsiswa['no']; ?>">Del</a></td>
    </tr>
    <?php $no++; } while ($row_daftarsiswa = mysql_fetch_assoc($daftarsiswa)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($daftarsiswa);
?>
