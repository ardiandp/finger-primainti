
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
$query_indo = "SELECT * FROM informasi ORDER BY tanggal DESC";
$indo = mysql_query($query_indo, $koneksi) or die(mysql_error());
$row_indo = mysql_fetch_assoc($indo);
$totalRows_indo = mysql_num_rows($indo);
?>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
      <a href="?page=add_informasi" class="btn btn-success">Tambah Informasi</a>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Menu </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
    <td>No</td>
    <td>Ditulis Oleh</td>
    <td>Judul</td>
    <td>Tanggal</td>
    <td>Publish</td>
    <td>Terbaru</td>
    <td>Aksi</td>
  </tr>
   </thead>
                    <tbody>
  <?php $no=1;do { ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_indo['penulis']; ?></td>
      <td><?php echo $row_indo['judul']; ?></td>
      <td><?php echo $row_indo['tanggal']; ?></td>
      <td><?php echo $row_indo['publish']; ?></td>
      <td><?php echo $row_indo['new']; ?></td>
      <td><a href="?page=edit_informasi&id_informasi=<?php echo $row_indo['id_informasi']; ?>">Edit </a><a href="?page=del_informasi&id_informasi=<?php echo $row_indo['id_informasi']; ?>">Del</a></td>
    </tr>
    <?php $no++; } while ($row_indo = mysql_fetch_assoc($indo)); ?>
 </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
<?php
mysql_free_result($indo);
?>
</section>