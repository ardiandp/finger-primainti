
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
$query_Recordset1 = "SELECT *from admin WHERE id_level='3'";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<h1>   DATA ASISTEN  </h1>          
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
    <td>email</td>
    <td>no_telp</td>
    <td>blokir</td>
  
  </tr>
                    </thead>
                    <tbody>
  <?php $no=1; do { ?>
 <tr>
  <td><?php echo $no ?></td>
      <td><?php echo $row_Recordset1['nim']; ?></td>
      <td><?php echo $row_Recordset1['password']; ?></td>
      <td><?php echo $row_Recordset1['nama_lengkap']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['no_telp']; ?></td>
     
      <td><?php echo $row_Recordset1['blokir']; ?></td>
      
    </tr>
    <?php $no++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
mysql_free_result($Recordset1);
?>
 </section>
