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
  $updateSQL = sprintf("UPDATE kampus SET kode=%s, namaKampus=%s, telp=%s, alamat=%s, kk=%s, maps=%s WHERE idkampus=%s",
                       GetSQLValueString($_POST['kode'], "text"),
                       GetSQLValueString($_POST['namaKampus'], "text"),
                       GetSQLValueString($_POST['telp'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['kk'], "text"),
                       GetSQLValueString($_POST['maps'], "text"),
                       GetSQLValueString($_POST['idkampus'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
   echo "<script>document.location='?page=kampus' </script>";
}

$colname_edit = "-1";
if (isset($_GET['idkampus'])) {
  $colname_edit = $_GET['idkampus'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_edit = sprintf("SELECT * FROM kampus WHERE idkampus = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysql_query($query_edit, $koneksi) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);

mysql_select_db($database_koneksi, $koneksi);
$query_kk = "SELECT *from admin WHERE level=2";
$kk = mysql_query($query_kk, $koneksi) or die(mysql_error());
$row_kk = mysql_fetch_assoc($kk);
$totalRows_kk = mysql_num_rows($kk);
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
      <td nowrap="nowrap" align="right">Idkampus:</td>
      <td><?php echo $row_edit['idkampus']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kode:</td>
      <td><input type="text" name="kode" value="<?php echo htmlentities($row_edit['kode'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">NamaKampus:</td>
      <td><input type="text" name="namaKampus" value="<?php echo htmlentities($row_edit['namaKampus'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Telp:</td>
      <td><input type="text" name="telp" value="<?php echo htmlentities($row_edit['telp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Alamat:</td>
      <td><textarea name="alamat" cols="50" rows="5"><?php echo htmlentities($row_edit['alamat'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kk:</td>
      <td><select name="kk">
        <?php 
do {  
?>
        <option value="<?php echo $row_kk['nim']?>" <?php if (!(strcmp($row_kk['nim'], htmlentities($row_edit['kk'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>> <?php echo $row_kk['nim']?> - <?php echo $row_kk['nama_lengkap']?></option>
        <?php
} while ($row_kk = mysql_fetch_assoc($kk));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Maps:</td>
      <td><textarea name="maps" cols="50" rows="5"><?php echo htmlentities($row_edit['maps'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idkampus" value="<?php echo $row_edit['idkampus']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($edit);

mysql_free_result($kk);
?>
