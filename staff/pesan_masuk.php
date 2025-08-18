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
$query_masuk = "select *from pesan inner join admin on pesan.pengirim=admin.nim and pesan.penerima='$_SESSION[MM_Username]'";
$masuk = mysql_query($query_masuk, $koneksi) or die(mysql_error());
$row_masuk = mysql_fetch_assoc($masuk);
$totalRows_masuk = mysql_num_rows($masuk);
?>
<h1> Kotak Masuk</h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>

    <td>id</td>
    <td>pengirim</td>
    <td>subject</td>
    <td>tanggal</td>
    <td>baca</td>
  </thead>
     <tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_masuk['id']; ?></td>
      <td><?php echo $row_masuk['nama_lengkap']; ?></td>
      <td><?php echo $row_masuk['subject']; ?></td>
      <td><?php echo $row_masuk['tanggal']; ?></td>
      <td><a href="?page=baca_pesan&id=<?php echo $row_masuk['id']; ?>"><input type=button class="btn btn-primary" value=Baca> </a></td>
    </tr>
    <?php } while ($row_masuk = mysql_fetch_assoc($masuk)); ?>
  </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box --><?php
mysql_free_result($masuk);
?>
