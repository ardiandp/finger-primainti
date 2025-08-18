<?php //require_once('../Connections/koneksi.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$foto="foto-";
$nim=$_POST['nim'];
$ext=".jpg";
$filename=$_FILES['gambar']['name'];
$nama_file_unix=$foto.$nim.$ext;
$move=move_uploaded_file($_FILES['gambar']['tmp_name'],'../upload/foto/'.$nama_file_unix);
  $insertSQL = sprintf("INSERT INTO `admin` ( nim, password, nama_lengkap, inisial, email, no_telp, `id_level`, blokir, gambar) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['nim'], "int"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['inisial'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['blokir'], "text"),
                       GetSQLValueString($nama_file_unix, "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

$datadiri=mysql_query("insert into datadiri (nim,nama_lengkap,status) values ('$_POST[nim]','$_POST[nama_lengkap]','$_POST[blokir]')") or die (mysql_error());
  echo "<script>document.location='?page=users' </script>";
}

mysql_select_db($database_koneksi, $koneksi);
$query_level = "SELECT * FROM `level`";
$level = mysql_query($query_level, $koneksi) or die(mysql_error());
$row_level = mysql_fetch_assoc($level);
$totalRows_level = mysql_num_rows($level);
?>
 <section class="content-header">     
          
      
    
  <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Input Users</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
<div class="box-body">                   
    <div class="form-group">
                      <label for="exampleInputPassword1">NIM</label>
      <td><input type="text" name="nim" class="form-control" value="" size="32" /></td>
 </div>
  <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
      <td><input type="password" name="password" class="form-control" value="" size="32" /></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">Nama Lengkap</label>
      <td><input type="text" name="nama_lengkap" class="form-control" value="" size="32" /></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">Inisial</label>
      <td><input type="text" name="inisial" value="" class="form-control" size="32" /></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
      <td><input type="text" name="email" value="" class="form-control" size="32" /></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">No Telp</label>
      <td><input type="text" name="no_telp" value="" class="form-control" size="32" /></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">Level</label>
      <td><select name="level" class="form-control">
        <?php 
do {  
?> 
        <option value="<?php echo $row_level['id_level']?>" ><?php echo $row_level['level']?></option>
        <?php
} while ($row_level = mysql_fetch_assoc($level));
?>
      </select></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">Blokir</label>
      <td><input type="text" name="blokir" value="" class="form-control" size="32" /></td>
</div>
 <div class="form-group">
                      <label for="exampleInputPassword1">Gambar</label>
      <td><input type="file" name="gambar" value="" class="form-control" size="32" /></td>
</div>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Data" class="btn btn-primary" /></td>
    </tr>
  </table>

  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($level);
?>
  </section>
