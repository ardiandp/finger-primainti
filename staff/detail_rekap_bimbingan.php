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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE rekap_bimbingan SET nim=%s, catatan=%s, tanggal=%s WHERE id_rek_bim=%s",
                       GetSQLValueString($_POST['nim'], "text"),
                       GetSQLValueString($_POST['catatan'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['id_rek_bim'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_rek_bim'])) {
  $colname_Recordset1 = $_GET['id_rek_bim'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM rekap_bimbingan WHERE id_rek_bim = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
 <h3>Baca Rekap Bimbingan</h3>          
       
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
      <td><input type="text" name="nim" value="<?php echo htmlentities($row_Recordset1['nim'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control" /></td>
</div>
<div class="form-group">
 <label for="exampleInputEmail1">CATATAN</label>
      <td><textarea name="catatan" cols="50" rows="5" class="form-control" /><?php echo htmlentities($row_Recordset1['catatan'], ENT_COMPAT, 'utf-8'); ?></textarea></td>

</div>
<div class="form-group">
 <label for="exampleInputEmail1">TANGGAL</label>
      <td><input type="text" name="tanggal" value="<?php echo htmlentities($row_Recordset1['tanggal'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control" /></td>

</div>     
<td></td>
    </tr>
  </table>
  <input type="hidden" name="id_rek_bim" value="<?php echo $row_Recordset1['id_rek_bim']; ?>" />
  <input type="button" VALUE="Kembali Kehalama Sebelumnya" onClick="history.go(-1);" class="btn btn-warning">
  <input type="hidden" name="id_rek_bim" value="<?php echo $row_Recordset1['id_rek_bim']; ?>" />
 
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
 </section>