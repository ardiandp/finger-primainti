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

mysql_select_db($database_koneksi, $koneksi);
$query_info = "SELECT * FROM setting";
$info = mysql_query($query_info, $koneksi) or die(mysql_error());
$row_info = mysql_fetch_assoc($info);
$totalRows_info = mysql_num_rows($info);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<a href="?page=add_info">Tambah</a>
<body>
<table width="611" border="1">
  <tr>
    <td width="90">idsetting</td>
    <td width="81">nama1</td>
    <td width="69">versi</td>
    <td width="67">aktif</td>
    <td width="42">aksi</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_info['idsetting']; ?></td>
      <td><?php echo $row_info['nama1']; ?></td>
      <td><?php echo $row_info['versi']; ?></td>
      <td><?php echo $row_info['aktif']; ?></td>
      <td><a href="?page=edit_info&idsetting=<?php echo $row_info['idsetting']; ?>">Edit </a><a href="?page=del_info&idsetting=<?php echo $row_info['idsetting']; ?>">Del</a></td>
    </tr>
    <?php } while ($row_info = mysql_fetch_assoc($info)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($info);
?>
