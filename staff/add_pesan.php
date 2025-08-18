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
  $insertSQL = sprintf("INSERT INTO pesan (id, pengirim, penerima, subject, pesan, `file`, tanggal) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['pengirim'], "text"),
                       GetSQLValueString($_POST['penerima'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['pesan'], "text"),
                       GetSQLValueString($_POST['file'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  echo "<script>alert('pesan terkirim'); document.location='?page=pesan_keluar' </script>";
}

mysql_select_db($database_koneksi, $koneksi);
$query_penerima = "SELECT * FROM `admin`";
$penerima = mysql_query($query_penerima, $koneksi) or die(mysql_error());
$row_penerima = mysql_fetch_assoc($penerima);
$totalRows_penerima = mysql_num_rows($penerima);
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <h1> Tulis Pesan</h1>
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



      <td><input type="hidden" name="id" value="" size="32"></td>


      <td><input type="hidden" name="pengirim" value="<?php echo $_SESSION['MM_Username'] ?>" size="32" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Penerima</label>
      <td><select name="penerima" id="penerima" class="form-control">
        <?php
do {
?>
        <option value="<?php echo $row_penerima['nim']?>"><?php echo $row_penerima['nama_lengkap']?></option>
        <?php
} while ($row_penerima = mysql_fetch_assoc($penerima));
  $rows = mysql_num_rows($penerima);
  if($rows > 0) {
      mysql_data_seek($penerima, 0);
	  $row_penerima = mysql_fetch_assoc($penerima);
  }
?>
      </select></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Subject</label>
      <td><input type="text" name="subject" value="" size="32" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Pesan</label>
      <td><textarea class="form-control" name="pesan" cols="50" rows="5"></textarea></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">File</label>
      <td><input type="text" name="file" value="" size="32" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Tanggal</label>
      <td><input type="text" name="tanggal" value="<?php echo date('Y-m-d')?>" size="32" class="form-control" id="exampleInputEmail1"></td>
</div>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Kirim Pesan" class="btn btn-primary"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($penerima);
?>
