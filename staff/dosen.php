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
$query_dosen = "select *from admin where level='2'";
$dosen = mysql_query($query_dosen, $koneksi) or die(mysql_error());
$row_dosen = mysql_fetch_assoc($dosen);
$totalRows_dosen = mysql_num_rows($dosen);
?>
<h1> Data Dosen          </h1>
          
      
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
    <td>password</td>
    <td>nama_lengkap</td>
    <td>inisial</td>
    <td>email</td>
    <td>no_telp</td>
    <td>blokir</td>
</tr>
 </thead>
<tbody>
  <?php $no=1; do { ?>
 <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_dosen['nim']; ?></td>
      <td><?php echo $row_dosen['password']; ?></td>
      <td><?php echo $row_dosen['nama_lengkap']; ?></td>
      <td><?php echo $row_dosen['inisial']; ?></td>
      <td><?php echo $row_dosen['email']; ?></td>
      <td><?php echo $row_dosen['no_telp']; ?></td>
    
      <td><?php echo $row_dosen['blokir']; ?></td>
    </tr>
    <?php $no++; } while ($row_dosen = mysql_fetch_assoc($dosen)); ?>
</tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
mysql_free_result($dosen);
?>
  </section>
