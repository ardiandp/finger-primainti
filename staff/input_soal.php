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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
$penulis=$_POST['penulis'];
$judul=$_POST['judul'];
$filename=$_FILES['file']['name'];
$p=' - ';
$nama_file_unix=$penulis.$p.$filename;
$move=move_uploaded_file($_FILES['file']['tmp_name'],'../upload/latihan/'.$nama_file_unix);
  $insertSQL = sprintf("INSERT INTO soal (penulis, kode, judul, keterangan, `file`, tanggal) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['penulis'], "text"),
                       GetSQLValueString($_POST['kode'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($nama_file_unix, "text"),
                       GetSQLValueString($_POST['tgl'], "date"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
 echo "<script>alert ('Data Tersimpan'); document.location='?page=latihan_soal' </script>";
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT kode, nama_matakuliah FROM matkul";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<form name="form" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data">
<h1> Edit Jadwall Mengajar Asisten</h1>
        
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
						
<div class="form-group">
<label for="exampleInputEmail1">Nama Penulis</label>
        <input type="text" name="penulis" id="penulis" value="<?php echo $_SESSION['nama_lengkap'] ?>" readonly="readonly" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Mata Kuliah</label>
        <select name="kode" class="form-control">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset1['kode']?>"><?php echo $row_Recordset1['nama_matakuliah']?></option>
          <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
        </select>
</div>
 
<div class="form-group">
<label for="exampleInputEmail1">Judul</label>
        <input type="text" name="judul" id="judul" required placeholder="Judul Latihan" class="form-control" id="exampleInputEmail1"></td>
</DIV>

<div class="form-group">
<label for="exampleInputEmail1">Keterangan</label>
        <textarea class="form-control" name="keterangan" id="keterangan" cols="45" rows="5" placeholder="Keterangan" required></textarea>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Upload file</label>
        <input type="file" name="file" id="gambar">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Tanggal</label>
        <input type="text" name="tgl" readonly="readonly" value="<?php echo date('Y-m-d') ?>" readonly="readonly" class="form-control" id="exampleInputEmail1"></td>
      
<input type="submit" name="simpan" value="SIMPAN DATA" class="btn btn-primary"/></td>
<input type="hidden" name="MM_insert" value="form">
</form>
<?php
mysql_free_result($Recordset1);
?>


</section>

