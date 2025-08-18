<?php //require_once('Connections/menu.php'); ?>
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
$query_Recordset1 = "SELECT * FROM `level`";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<div class="col-md-6">
<a href="?page=add_group" class="btn btn-primary">Tambah Group Baru</a>
<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Group / Role</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-condensed">
                    <tr>
                      <th >id</th>
                      <th>level</th>                      
                      <th >Aktif</th>
                      <th> Aksi </th>
                    </tr>
                    <tr>
    
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_level']; ?></td>
      <td><?php echo $row_Recordset1['level']; ?></td>
      <td><?php echo $row_Recordset1['aktif']; ?></td>
      <td><a href="?page=add_akses&id=<?php echo $row_Recordset1['id_level']; ?>" class="badge bg-green">Hak Akses</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>



                      
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>