<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `admin` SET id_admin=%s, password=%s, nama_lengkap=%s, inisial=%s, email=%s, no_telp=%s, `id_level`=%s, blokir=%s, gambar=%s WHERE nim=%s",
                       GetSQLValueString($_POST['id_admin'], "int"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['inisial'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['id_level'], "text"),
                       GetSQLValueString($_POST['blokir'], "text"),
                       GetSQLValueString($_POST['gambar'], "text"),
                       GetSQLValueString($_POST['nim'], "int"));

  $Result1 = mysqli_query($conn, $updateSQL) or die(mysqli_error($conn));
  $datadiri=mysqli_query($conn,"update datadiri set nim='".$_POST['nim']."',nama_lengkap='".$_POST['nama_lengkap']."',status='".$_POST['blokir']."' where nim='".$_POST['nim']."' ") or die (mysqli_error($conn));
  echo "<script>document.location='?page=users' </script>";
}

$colname_edit = "-1";
if (isset($_GET['nim'])) {
  $colname_edit = $_GET['nim'];
}
$query_edit = "SELECT * FROM `admin` WHERE nim = ?";
$stmt = mysqli_prepare($conn, $query_edit);
mysqli_stmt_bind_param($stmt, "i", $colname_edit);
mysqli_stmt_execute($stmt);
$edit = mysqli_stmt_get_result($stmt);
$row_edit = mysqli_fetch_assoc($edit);
$totalRows_edit = mysqli_num_rows($edit);

$query_level = "SELECT * FROM `level`";
$level = mysqli_query($conn, $query_level) or die(mysqli_error($conn));
$row_level = mysqli_fetch_assoc($level);
$totalRows_level = mysqli_num_rows($level);
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
      <td nowrap="nowrap" align="right">Id_admin:</td>
      <td><input type="text" name="id_admin" value="<?php echo htmlentities($row_edit['id_admin'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nim:</td>
     <td><input type="text" name="password" value="<?php echo htmlentities($row_edit['nim'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo htmlentities($row_edit['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_lengkap:</td>
      <td><input type="text" name="nama_lengkap" value="<?php echo htmlentities($row_edit['nama_lengkap'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Inisial:</td>
      <td><input type="text" name="inisial" value="<?php echo htmlentities($row_edit['inisial'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_edit['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">No_telp:</td>
      <td><input type="text" name="no_telp" value="<?php echo htmlentities($row_edit['no_telp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Level:</td>
      <td><select name="level">
        <?php 
do {  
?>
        <option value="<?php echo $row_level['id_level']?>" <?php if (!(strcmp($row_level['id_level'], htmlentities($row_edit['id_level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_level['level']?></option>
        <?php
} while ($row_level = mysqli_fetch_assoc($level));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Blokir:</td>
      <td><input type="text" name="blokir" value="<?php echo htmlentities($row_edit['blokir'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gambar:</td>
      <td><input type="text" name="gambar" value="<?php echo htmlentities($row_edit['gambar'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="nim" value="<?php echo $row_edit['nim']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($edit);

mysqli_free_result($level);
?>
