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
$query_proposal = "select *from proposal inner join admin on proposal.diupload=admin.nim";
$proposal = mysql_query($query_proposal, $koneksi) or die(mysql_error());
$row_proposal = mysql_fetch_assoc($proposal);
$totalRows_proposal = mysql_num_rows($proposal);
?>
<section class="content-header">  
         
       
    <section class="content">    
          <div class="row">
            <div class="col-xs-12">
  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Proposal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
    <td>No</td>
    <td>judul</td>
    <td>Ormawa</td>
    <td>kampus</td>
    <td>dikirimpada</td>
    <td>tanggalacara</td>
    <td>status</td>
    <td>fpdf</td>
  </tr>
                    </thead>
                    <tbody>
  <?php $no=1; do { ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_proposal['judul']; ?></td>
      <td><?php echo $row_proposal['nama_lengkap']; ?></td>
      <td><?php echo $row_proposal['kampus']; ?></td>
      <td><?php echo $row_proposal['dikirimpada']; ?></td>
      <td><?php echo $row_proposal['tanggalacara']; ?></td>
      <td><?php $status=$row_proposal['status'];
           if($status=="Baru")
		   { ?> <a href='' class="badge bg-green">Baru </a>
		   <?php } else
           if($status=="Menunggu")
		   {  ?> <a href='' class="badge bg-yellow">Menunggu </a>		
           <?php } else	  
			if($status=="Disetujui")
			{  ?> <a href='' class="badge bg-blue">Disetujui </a>
		   <?php } else	  
			if($status=="Ditolak")
		   {  ?> <a class="badge bg-red">Ditolak </a>	
			<?php } ?>
 	 	  </td>
      <td><a href='../upload/proposal/<?php echo $row_proposal['fpdf']; ?>' class="fa fa-download"> Unduh</a> </td>
    </tr>
    <?php $no++; } while ($row_proposal = mysql_fetch_assoc($proposal)); ?>
</tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			   </section> 
<?php
mysql_free_result($proposal);
?>
