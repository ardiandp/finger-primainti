<h1>Rekap Periode</h1>
       
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
						
						

<form method="post" action="?page=rekap_periode">
<div class="form-group">
<label for="exampleInputEmail1">Tanggal Awal</label>
<input type="date" name="tgl1" class="form-control" id="exampleInputEmail1"></td>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Tanggal Akhir</label>
<input type="date" name="tgl2" class="form-control" id="exampleInputEmail1"></td>
</div>

<input type="submit" value="Lihat Rekap Mengajar Periode" name="lihat" class="btn btn-success"/>
</form>
</p>
<hr />

 <?php
if (isset($_POST['lihat']))
{
	?>

<div id='main-content'>
   <div class='container_12'>
<?php
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
$nim=$_SESSION['MM_Username'];
?>
   <a href='?page=cetak_rekap&tgl1=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>' class='button' >   <span>Jumlah SKS / Minggu</span></a>
   <a href='cetak_rekap_pdf.php?tgl1=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>' class='button' target="_blank">   <span>Download File PDF</span></a>

   
<h4> HASIL REKAP DARI TANGGAL <?php echo $tgl1 ?> Sampai <?php echo $tgl2 ?>  </h4>
         </section>    
		  <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">               
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>	  
    <td >ASISTEN</td>
    <td >KELAS</td>
    <td >SKS</td>
    <td >RUANG</td>
    <td >MATKUL</td>
    <td >HARI</td>
    <td >JAM</td>
    <td >TANGGAL</td>
    <td >DOSEN</td>
  </thead>
   <tbody>
<?php

$view=mysql_query("SELECT *FROM admin,rekap WHERE rekap.nim=admin.nim  AND rekap.tanggal BETWEEN  '$tgl1' and '$tgl2' order by admin.nama_lengkap");
//$view=mysql_query("SELECT *FROM  rekap,admin WHERE rekap.nim=admin.nim rekap.nim='$nim' and rekap.tanggal between '$tgl1' and '$tgl2' ");
while($row_Recordset1=mysql_fetch_array($view))
{ ?>
     <tr>
      <td ><?php echo $row_Recordset1['nama_lengkap']; ?></td>
      <td ><?php echo $row_Recordset1['kelas']; ?></td>
      <td ><?php echo $row_Recordset1['sks']; ?></td>
      <td ><?php echo $row_Recordset1['ruang']; ?></td>
      <td ><?php echo $row_Recordset1['kode']; ?></td>
      <td ><?php echo $row_Recordset1['hari']; ?></td>
      <td ><?php echo $row_Recordset1['jam']; ?></td>
      <td ><?php echo $row_Recordset1['tanggal']; ?></td>
      <td ><?php echo $row_Recordset1['inisial']; ?></td>
    </tr>
    <?php }  ?>
</tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php } ?>

 </section>