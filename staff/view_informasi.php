
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

$colname_view = "-1";
if (isset($_GET['id_informasi'])) {
  $colname_view = $_GET['id_informasi'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_view = sprintf("SELECT * FROM informasi WHERE id_informasi ='$_GET[id]'", GetSQLValueString($colname_view, "int"));
$view = mysql_query($query_view, $koneksi) or die(mysql_error());
$row_view = mysql_fetch_assoc($view);
$totalRows_view = mysql_num_rows($view);

mysql_free_result($view);
?>
<h1> <?php echo $row_view['judul']; ?></h1>
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


                          <div class="form-group">
                          <label for="exampleInputEmail1">Penulis</label>
    <td width="439"><input type=text class="form-control" id="exampleInputEmail1" value=<?php echo $row_view['penulis']; ?> readonly> </td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Judul</label>
    <td><input type=text value=<?php echo $row_view['judul']; ?> class="form-control" id="exampleInputEmail1" readonly></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Info</label>
    <td> <textarea class="form-control" rows="19"  readonly><?php echo $row_view['keteranagn']; ?> </textarea></td>
</div>


<div class="form-group">
<label for="exampleInputEmail1">Tanggal</label>
    <td><input type=text value=<?php echo $row_view['tanggal']; ?> class="form-control" id="exampleInputEmail1" readonly></td>
</div>


    <td colspan="2"><a href="?page=informasi"><input type="button" value="BACK TO INFORMASI" class="btn btn-primary"></a></td>

  </tr>
</table>
