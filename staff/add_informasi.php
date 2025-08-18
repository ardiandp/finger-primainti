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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO informasi (id_informasi, penulis, judul, keteranagn, tanggal, `new`, publish) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_informasi'], "int"),
                       GetSQLValueString($_POST['penulis'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['keteranagn'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['new'], "text"),
                       GetSQLValueString($_POST['publish'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  //awal log atifitas
$username=$_SESSION['MM_Username'];
$keterangan="Menambahkan Informasi Baru";
$waktu=date('Y-m-d H:i:s');
$hari=$hari_ini;
$logact=mysql_query("insert into log_aktifitas (username,keterangan,hari,waktu) values ('$username','$keterangan','$hari','$waktu')") or die (mysql_error());
//akhir simpan log
  echo "<script>alert('Data Tersimpan');document.location='?page=informasi' </script>";
}
?>
 <section class="content-header">     
          
        </section>
    
  <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tulis Informasi Baru</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="box-body">
                   
    <div class="form-group">
                      <label for="exampleInputPassword1">id</label>
      <td><input type="text" name="id_informasi" class="form-control" value="" size="32" /></td>
</div>
    <div class="form-group">
                      <label for="exampleInputPassword1">Penulis</label
      <td><input type="text" name="penulis" class="form-control" readonly value="<?php echo $_SESSION['nama_lengkap'] ?>" size="32" /></td>
</div>
    <div class="form-group">
                      <label for="exampleInputPassword1">Judul</label
      <td><input type="text" name="judul" class="form-control" value="" size="32" /></td>
</div>
    <div class="form-group">
                      <label for="exampleInputPassword1">Keterangan</label
      <td><textarea name="keteranagn" class="form-control" cols="50" rows="5"></textarea></td>
</div>
    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal</label
      <td><input type="text" class="form-control" name="tanggal" value="<?php echo date('Y-m-d H:i:s') ?>" size="32" /></td>
</div>
    <div class="form-group">
                      <label for="exampleInputPassword1">New</label
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="new" value="Y" />
            Ya</td>
        </tr>
        <tr>
          <td><input type="radio" name="new" value="N" />
            Tidak</td>
        </tr>
      </table></td>
</div>
    <div class="form-group">
                      <label for="exampleInputPassword1">Publish</label
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="publish" value="Y" />
            Ya</td>
        </tr>
        <tr>
          <td><input type="radio" name="publish" value="N" />
            Tidak</td>
        </tr>
      </table></td>
</div>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Informasi" class="btn btn-primary" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>

 </section>