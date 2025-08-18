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
  $updateSQL = sprintf("UPDATE informasi SET penulis=%s, judul=%s, keteranagn=%s, tanggal=%s, `new`=%s, publish=%s WHERE id_informasi=%s",
                       GetSQLValueString($_POST['penulis'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['keteranagn'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['new'], "text"),
                       GetSQLValueString($_POST['publish'], "text"),
                       GetSQLValueString($_POST['id_informasi'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
//awal log atifitas
$username=$_SESSION['MM_Username'];
$keterangan="melakukan login";
$waktu=date('Y-m-d H:i:s');
$hari=$hari_ini;
$logact=mysql_query("insert into log_aktifitas (username,keterangan,hari,waktu) values ('$username','$keterangan','$hari','$waktu')") or die (mysql_error());
//akhir simpan log
  echo "<script>alert('Proses Data'); document.location='?page=informasi' </script> ";
}

$colname_edit = "-1";
if (isset($_GET['id_informasi'])) {
  $colname_edit = $_GET['id_informasi'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_edit = sprintf("SELECT * FROM informasi WHERE id_informasi = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysql_query($query_edit, $koneksi) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_informasi:</td>
      <td><?php echo $row_edit['id_informasi']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penulis:</td>
      <td><input type="text" name="penulis" value="<?php echo htmlentities($row_edit['penulis'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul:</td>
      <td><input type="text" name="judul" value="<?php echo htmlentities($row_edit['judul'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Keteranagn:</td>
      <td><textarea name="keteranagn" cols="50" rows="5"><?php echo htmlentities($row_edit['keteranagn'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tanggal:</td>
      <td><input type="text" name="tanggal" value="<?php echo htmlentities($row_edit['tanggal'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">New:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="new" value="Y" <?php if (!(strcmp(htmlentities($row_edit['new'], ENT_COMPAT, 'utf-8'),"Y"))) {echo "checked=\"checked\"";} ?> />
            Ya</td>
        </tr>
        <tr>
          <td><input type="radio" name="new" value="N" <?php if (!(strcmp(htmlentities($row_edit['new'], ENT_COMPAT, 'utf-8'),"N"))) {echo "checked=\"checked\"";} ?> />
            Tidak</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Publish:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="publish" value="Y" <?php if (!(strcmp(htmlentities($row_edit['publish'], ENT_COMPAT, 'utf-8'),"Y"))) {echo "checked=\"checked\"";} ?> />
            Ya</td>
        </tr>
        <tr>
          <td><input type="radio" name="publish" value="N" <?php if (!(strcmp(htmlentities($row_edit['publish'], ENT_COMPAT, 'utf-8'),"N"))) {echo "checked=\"checked\"";} ?> />
            Tidak</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_informasi" value="<?php echo $row_edit['id_informasi']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($edit);
?>
