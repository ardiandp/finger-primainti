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
	
$filename=$_FILES['gambar']['name'];
$move=move_uploaded_file($_FILES['gambar']['tmp_name'],'../foto/'.$filename);
  $insertSQL = sprintf("INSERT INTO `admin` (nim, password, nama_lengkap, inisial, email, no_telp, `level`, blokir, gambar) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nim'], "int"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['inisial'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['blokir'], "text"),
                       GetSQLValueString($filename, "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?>
<h1> Tambah Akses Login</h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                 </div><!-- /.box-header -->
				 <!-- form start -->
                        <div class="box-body">
						
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">

<div class="form-group">
<label for="exampleInputEmail1">Nim</label>
      <td><input type="text" name="nim" value="" class="form-control" id="exampleInputEmail1"></td>
</div>
 
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
      <td><input type="password" name="password" value="" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Nama lengkap</label>
      <td><input type="text" name="nama_lengkap" value="" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Inisial</label>
      <td><input type="text" name="inisial" value="" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Email</label>
      <td><input type="text" name="email" value="" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">No Telp</label>
      <td><input type="text" name="no_telp" value="" class="form-control" id="exampleInputEmail1"></td>
</div>
 
<div class="form-group">
<label for="exampleInputEmail1">level</label>
      <td><select name="level" class="form-control">
        <option value="dosen" <?php if (!(strcmp("dosen", ""))) {echo "SELECTED";} ?>>dosen</option>
        <option value="asisten" <?php if (!(strcmp("asisten", ""))) {echo "SELECTED";} ?>>asisten</option>
      </select></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Blokir</label>
          <td><input type="radio" name="blokir" value="Y" />
            Y</td>
        </tr>
        <tr>
          <td><input type="radio" name="blokir" value="N" />
            N</td>
</div>
 
<div class="form-group">
<label for="exampleInputEmail1">Gambar</label>
      <td><input type="file" name="gambar" value="" id="exampleInputFile"></td>
</div>

      <td><input type="submit" value="Insert record" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>