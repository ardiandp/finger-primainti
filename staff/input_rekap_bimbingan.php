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

$colname_mhs = "-1";
if (isset($_GET['nim'])) {
  $colname_mhs = $_GET['nim'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_mhs = "SELECT * FROM mhs_bimbingan WHERE nim ='$_GET[nim]' ";
$mhs = mysql_query($query_mhs, $koneksi) or die(mysql_error());
$row_mhs = mysql_fetch_assoc($mhs);
$totalRows_mhs = mysql_num_rows($mhs);

mysql_select_db($database_koneksi, $koneksi);
$query_rekap = "SELECT mhs_bimbingan.nama_mhs,rekap_bimbingan.catatan,rekap_bimbingan.tanggal,rekap_bimbingan.id_rek_bim,admin.nama_lengkap FROM admin,mhs_bimbingan,rekap_bimbingan WHERE admin.nim=rekap_bimbingan.dosen and rekap_bimbingan.nim=mhs_bimbingan.nim and rekap_bimbingan.nim='$_GET[nim]'";
$rekap = mysql_query($query_rekap, $koneksi) or die(mysql_error());
$row_rekap = mysql_fetch_assoc($rekap);
$totalRows_rekap = mysql_num_rows($rekap);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$nim=$_GET['nim'];
  $insertSQL = sprintf("INSERT INTO rekap_bimbingan (nim, catatan, tanggal, dosen) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['nim'], "text"),
                       GetSQLValueString($_POST['catatan'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['dosen'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  echo "<script>alert('rekap tersimpan'); document.location='?page=input_rekap_bimbingan&nim=$nim' </script> ";
}
?>
<h1>REKAP BIMBINGAN : <?php echo $row_rekap['nama_mhs']; ?></h1>  
     
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
            <!-- form start -->
         <div class="box-body">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 <div class="form-group">
 <label for="exampleInputEmail1">NIM</label>
         <input type="hidden" name="nim" value="<?php echo $row_mhs['nim']; ?>" size="32" class="form-control" /></td>
</div>
<div class="form-group">
 <label for="exampleInputEmail1">NAMA MAHASISWA</label>
      <td><input type="text" name="tanggal" value="<?php echo $row_mhs['nama_mhs'] ?>" size="32" class="form-control" readonly /></td>
</div>
<div class="form-group">
 <label for="exampleInputEmail1">CATATAN</label>
      <td><textarea name="catatan" cols="50" rows="5" class="form-control" /></textarea></td>
</div>
<div class="form-group">
 <label for="exampleInputEmail1">TANGGAL</label>
      <td><input type="text" name="tanggal" value="<?php echo date ('Y-m-d') ?>" size="32" class="form-control" readonly /></td>
</div>
      <td><input type="hidden" name="dosen" value="<?php echo $row_mhs['dosen']; ?>" size="32" /></td>
   
   <p class=inline-small-label> 
      <td><input type="submit" value="Insert record" class="btn btn-primary"></td>  
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<hr />
<div id='main-content'>
   <div class='container_12'>
      
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h3>REKAP BIMBINGAN PERIODE</h3>
   <span></span> 
   </div>
   <div class='block-content'>
		  
  <table id='table-example' class='table'>	  
	         
   <thead><tr>	  
    <td>NO</td>
    <td>NAMA MAHASISWA</td>
    <td>TANGGAL</td>
    <td>NAMA</td>
    <td>DETAIL</td>
</thead>
   <tbody>
  <?php $no=1; do { ?>
  <tr class=gradeX>
     <td><?php echo $no ?></td>
      <td><?php echo $row_rekap['nama_mhs']; ?></td>
      <td><?php echo $row_rekap['tanggal']; ?></td>
      <td><?php echo $row_rekap['nama_lengkap']; ?></td>
      <td><a href="?page=detail_rekap_bimbingan&id_rek_bim=<?php echo $row_rekap['id_rek_bim']; ?>">Detail</a></td>
    </tr>
    <?php $no++; } while ($row_rekap = mysql_fetch_assoc($rekap)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($mhs);

mysql_free_result($rekap);
?>
   </section>
