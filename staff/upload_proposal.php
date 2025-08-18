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

$filename=$_FILES['fpdf']['name'];
$id=$_POST['idproposal'];
$p='file';
$ext='.pdf';
$nama_file_pdf=$p.$id.$ext;

$filename=$_FILES['fword']['name'];
$id=$_POST['idproposal'];
$p='file';
$ext='.doc';
$nama_file_word=$p.$id.$ext;

$move=move_uploaded_file($_FILES['fpdf']['tmp_name'],'../upload/proposal/'.$nama_file_pdf);
$move=move_uploaded_file($_FILES['fword']['tmp_name'],'../upload/proposal/'.$nama_file_word);
  $insertSQL = sprintf("INSERT INTO proposal (idproposal, judul, kampus, keterangan, ormawa, dikirimpada, tanggalacara,  fword, fpdf, diupload) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['idproposal'], "int"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['kampus'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['ormawa'], "text"),
                       GetSQLValueString($_POST['dikirimpada'], "date"),
                       GetSQLValueString($_POST['tanggalacara'], "text"),                      
                       GetSQLValueString($nama_file_word, "text"),
                       GetSQLValueString($nama_file_pdf, "text"),
                       GetSQLValueString($_POST['diupload'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  echo "<script>alert('Proses Data'); document.location='?page=proposal' </script> ";
}

mysql_select_db($database_koneksi, $koneksi);
$query_kampus = "SELECT * FROM kampus";
$kampus = mysql_query($query_kampus, $koneksi) or die(mysql_error());
$row_kampus = mysql_fetch_assoc($kampus);
$totalRows_kampus = mysql_num_rows($kampus);

mysql_select_db($database_koneksi, $koneksi);
$query_ormawa = "SELECT * FROM ormawa";
$ormawa = mysql_query($query_ormawa, $koneksi) or die(mysql_error());
$row_ormawa = mysql_fetch_assoc($ormawa);
$totalRows_ormawa = mysql_num_rows($ormawa);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
  
   <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Pengajuan Proposal</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    

      <input type="hidden" class="form-control" value="PRO<?php echo date('ymds') ?>" name="idproposal" value="" size="32" />

<div class="form-group">
                      <label for="exampleInputEmail1">Judul Proposal</label>
      <td><input type="text" class="form-control"  name="judul" value="" size="32" /></td>
</div>
<div class="form-group">
                      <label for="exampleInputEmail1">Pilih Kampus</label>
      <select name="kampus" class="form-control">
        <?php 
do {  
?>
        <option value="<?php echo $row_kampus['kode']?>" ><?php echo $row_kampus['namakampus']?></option>
        <?php
} while ($row_kampus = mysql_fetch_assoc($kampus));
?>
      </select>
</div>
<div class="form-group">
                      <label for="exampleInputEmail1">Keterangan</label>
      <td><input type="text" class="form-control" name="keterangan" value="" size="32" /></td>
</div>
<div class="form-group">
                      <label for="exampleInputEmail1">Ormawa</label>
      <td><select name="ormawa" class="form-control">
        <?php 
do {  
?>
        <option value="<?php echo $row_ormawa['namaormawa']?>" ><?php echo $row_ormawa['namaormawa']?></option>
        <?php
} while ($row_ormawa = mysql_fetch_assoc($ormawa));
?>
      </select></td>
</div>
<div class="form-group">
                      <label for="exampleInputEmail1">Dikirim Pada</label>
      <td><input type="text" class="form-control" readonly name="dikirimpada"  size="32" value="<?php echo date('Y-m-d') ?>"/></td>
</div>
<div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Acara</label>
      <td><input type="date" class="form-control" name="tanggalacara" value="" size="32" /></td>
</div>

                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Upload Proposal</button>
                  </div>
                </form>
              </div><!-- /.box -->

              <!-- Form Element sizes -->       

            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Upload Proposal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                   
                   

<div class="form-group">
                      <label for="exampleInputEmail1">Upload File Ms. Word</label>
      <td><input type="file" class="form-control" name="fword" value="" size="32" /></td>
</div>
<div class="form-group">
                      <label for="exampleInputEmail1">Upload File PDF</label>
      <td><input type="file" class="form-control" name="fpdf" value="" size="32" /></td>
</div>

      <input type="hidden" class="form-control" value="<?php echo $_SESSION['MM_Username'] ?>" name="diupload" value="" size="32" />

    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
     
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
  
                    <!-- radio -->
					
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
		
		
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($kampus);

mysql_free_result($ormawa);
?>
