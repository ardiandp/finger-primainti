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
$query_view = "select *from pesan inner join admin on pesan.pengirim=admin.nim and pesan.id='$_GET[id]'";
$view = mysql_query($query_view, $koneksi) or die(mysql_error());
$row_view = mysql_fetch_assoc($view);
$totalRows_view = mysql_num_rows($view);
?>
<h1> Baca Pesan </h1>
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
                          <label for="exampleInputEmail1">Pengirim</label>
    <td width="353"><input type=text value="<?php echo $row_view['nama_lengkap']; ?>" class="form-control" id="exampleInputEmail1"></td></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Subject</label>
    <td><input type=text value="<?php echo $row_view['subject']; ?>" class="form-control" id="exampleInputEmail1"></td></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Pesan</label>
    <td><textarea class="form-control" name="pesan" cols="50" rows="5"><?php echo $row_view['pesan']; ?></textarea></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">File</label>
    <td><?php echo $row_view['file']; ?></td>
</div>

  <div class="form-group">
  <label for="exampleInputEmail1">Tanggal</label>
    <td><input type=text value=<?php echo $row_view['tanggal']; ?> class="form-control" id="exampleInputEmail1"></td></td>
</div>
</table>
<?php
mysql_free_result($view);
?>
<?php
$update=mysql_query("update pesan set baca='1' where id='$_GET[id]' ");
?>
