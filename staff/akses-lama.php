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
$query_Recordset1 = "SELECT * FROM `admin`";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<h1>DATA AKSES LOG IN
          </h1>
         </section>
<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
<div class="box">
               <div class="box-body"><a href=?page=add_akses><input type=button value="Tambah Akses Login" class="btn btn-success"> </a>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  
    <td>NIM</td>
    <td>PASSWORD</td>
    <td>NAMA</td>
    <td>EMAIL</td>
    <td>TELP</td>
    <td>LEVEL</td>
    <td>BLOKIR</td>
    <td>AKSI</td>
   </thead>
   <tbody>
  <?php do { ?>
 <tr>
      <td><?php echo $row_Recordset1['nim']; ?></td>
      <td><?php echo $row_Recordset1['password']; ?></td>
      <td><?php echo $row_Recordset1['nama_lengkap']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['no_telp']; ?></td>
      <td><?php echo $row_Recordset1['level']; ?></td>
      <td><?php echo $row_Recordset1['blokir']; ?></td>
      <td><a href="?page=edit_akses&nim=<?php echo $row_Recordset1['nim']; ?>">Edit </a><a href="?page=del_akses&nim=<?php echo $row_Recordset1['nim']; ?>&gambar=<?php echo $row_Recordset1['gambar']; ?> ">Del</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
mysql_free_result($Recordset1);
?>
