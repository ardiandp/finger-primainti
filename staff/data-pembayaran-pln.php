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
$query_data = "SELECT * FROM pln order by idbayar desc";
$data = mysql_query($query_data, $koneksi) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
?>
<section class="content-header">
      
         
       
    <section class="content">
          <div class="row">
            <div class="col-xs-12">
      <a href="?page=bayar-pln" class="btn btn-success">Bayar PLN</a>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pembayaran PLN </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
  <tr>
    <td>No</td>
    <td>aplikasi</td>
    <td>tgl_beli</td>
    <td>idpel</td>
    <td>nama</td>
    <td>periode</td>
    <td>total</td>
    <td>Print</td>
  </tr>
    </thead>
  <tbody>
  <?php $no=1;do { ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_data['aplikasi']; ?></td>
      <td><?php echo $row_data['tgl_beli']; ?></td>
      <td><?php echo $row_data['idpel']; ?></td>
      <td><?php echo $row_data['nama']; ?></td>
      <td><?php echo $row_data['periode']; ?></td>
      <td>Rp. <?php echo (number_format($row_data['total'])); ?></td>
      <td><a href='cetak-pembayaran-pln.php?idpel=<?php echo $row_data['idbayar']; ?>' target="_blank" class="btn btn-success">Cetak</a></td>
    </tr>
    <?php $no++; } while ($row_data = mysql_fetch_assoc($data)); ?>
    </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
<?php
mysql_free_result($data);
?>
  </section>   
