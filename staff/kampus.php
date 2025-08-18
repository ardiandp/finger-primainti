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
$query_kampus = "SELECT * FROM kampus";
$kampus = mysql_query($query_kampus, $koneksi) or die(mysql_error());
$row_kampus = mysql_fetch_assoc($kampus);
$totalRows_kampus = mysql_num_rows($kampus);
?>
<section class="content-header">  
         
        
    <section class="content">    <a href="?page=add_kampus" class="btn btn-success">Tambah Kampus</a>
          <div class="row">
            <div class="col-xs-12">
  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Kampus </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
    <th>No</td>
    <th>Kode</td>
    <th>Nama Kampus</td>
    <th>Telp</td>
    <th>Alamat</td>
    <th>KK</td>
    <th>Maps</td>
    <th>Aksi</td>
   </tr>
                    </thead>
                    <tbody>
  <?php $no=1;do { ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_kampus['kode']; ?></td>
      <td><?php echo $row_kampus['namakampus']; ?></td>
      <td><?php echo $row_kampus['telp']; ?></td>
      <td><?php echo $row_kampus['alamat']; ?></td>
      <td><?php echo $row_kampus['kk']; ?></td>
      <td><?php echo $row_kampus['maps']; ?></td>
      <td><a href="?page=edit_kampus&idkampus=<?php echo $row_kampus['idkampus']; ?>">Edit  </a> || <a href="?page=del_kampus&idkampus=<?php echo $row_kampus['idkampus']; ?>">Del</a></td>
    </tr>
    <?php $no++; } while ($row_kampus = mysql_fetch_assoc($kampus)); ?>
 </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
mysql_free_result($kampus);
?>
 </section>   
