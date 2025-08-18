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
  $updateSQL = sprintf("UPDATE aji_daftar_siswa SET jenis_sekolah=%s, kategori=%s, nama_sekolah=%s, kabupaten=%s, alamat=%s, cp_guru=%s, jabatan=%s, hp=%s, keterangan=%s WHERE `no`=%s",
                       GetSQLValueString($_POST['jenis_sekolah'], "text"),
                       GetSQLValueString($_POST['kategori'], "text"),
                       GetSQLValueString($_POST['nama_sekolah'], "text"),
                       GetSQLValueString($_POST['kabupaten'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['cp_guru'], "text"),
                       GetSQLValueString($_POST['jabatan'], "text"),
                       GetSQLValueString($_POST['hp'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['no'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
   echo "<script>alert('data tersimpan'); document.location='?page=daftar_siswa' </script>";
}

$colname_edit = "-1";
if (isset($_GET['no'])) {
  $colname_edit = $_GET['no'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_edit = sprintf("SELECT * FROM aji_daftar_siswa WHERE `no` = %s", GetSQLValueString($colname_edit, "int"));
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
</body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">No:</td>
      <td><?php echo $row_edit['no']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis_sekolah:</td>
      <td><select name="jenis_sekolah">
        <option value="SMA" <?php if (!(strcmp("SMA", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SMA</option>
        <option value="SMK" <?php if (!(strcmp("SMK", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SMK</option>
        <option value="MA" <?php if (!(strcmp("MA", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>MA</option>
        <option value="SMAN" <?php if (!(strcmp("SMAN", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SMAN</option>
        <option value="SMKN" <?php if (!(strcmp("SMKN", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SMKN</option>
        <option value="MAN" <?php if (!(strcmp("MAN", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>MAN</option>
        <option value="LAINYA" <?php if (!(strcmp("LAINYA", htmlentities($row_edit['jenis_sekolah'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LAINYA</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kategori:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="kategori" value="Negeri" <?php if (!(strcmp(htmlentities($row_edit['kategori'], ENT_COMPAT, 'utf-8'),"Negeri"))) {echo "checked=\"checked\"";} ?> />
            Negeri</td>
        </tr>
        <tr>
          <td><input type="radio" name="kategori" value="Swasta" <?php if (!(strcmp(htmlentities($row_edit['kategori'], ENT_COMPAT, 'utf-8'),"Swasta"))) {echo "checked=\"checked\"";} ?> />
            Swasta</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_sekolah:</td>
      <td><input type="text" name="nama_sekolah" value="<?php echo htmlentities($row_edit['nama_sekolah'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Kabupaten:</td>
      <td><input type="text" name="kabupaten" value="<?php echo htmlentities($row_edit['kabupaten'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Alamat:</td>
      <td><textarea name="alamat" cols="50" rows="5"><?php echo htmlentities($row_edit['alamat'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cp_guru:</td>
      <td><input type="text" name="cp_guru" value="<?php echo htmlentities($row_edit['cp_guru'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jabatan:</td>
      <td><input type="text" name="jabatan" value="<?php echo htmlentities($row_edit['jabatan'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hp:</td>
      <td><input type="text" name="hp" value="<?php echo htmlentities($row_edit['hp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Keterangan:</td>
      <td><textarea name="keterangan" cols="50" rows="5"><?php echo htmlentities($row_edit['keterangan'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="no" value="<?php echo $row_edit['no']; ?>" />
</form>
<p>&nbsp;</p>
</html>
<?php
mysql_free_result($edit);
?>
