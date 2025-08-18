<form action="?page=simpan_rekap&kelas=<?php echo $r['kelas'] ?>" method="post">
<h2> Rekap Mengajar Hari Ini</h3>
         
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">                
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr> 
 

      <td>KELAS</td>
      <td>SKS</td>
      <td>RUANG</td>
      <td>MATKUL</td>
      <td>HARI</td>
      <td>JAM</td>
      <td>TANGGAL</td>
      <td>DOSEN</td>
      <td>REKAP</td>
  </thead>
<?php
$nim=$_SESSION['MM_Username'];
$rekap=mysql_query("select *from jadwal_asisten where nim='$nim' and hari='$hari_ini' "); 
while($r=mysql_fetch_array($rekap))
{
?>
  <tr>

         <input type="hidden" name="nim" value="<?php echo $nim ?> ">
         <input type="hidden" name="kelas" value="<?php echo $r['kelas'] ?> ">
         <input type="hidden" name="sks" value="<?php echo $r['sks'] ?> ">
         <input type="hidden" name="ruang" value="<?php echo $r['ruang'] ?> ">
         <input type="hidden" name="kode" value="<?php echo $r['kode'] ?> ">
         <input type="hidden" name="hari" value="<?php echo $r['hari'] ?> ">
         <input type="hidden" name="jam" value="<?php echo $r['jam'] ?> " >
         <input type="hidden" name="tgl" value="<?php echo $tgl ?> " >
         <input type="hidden" name="inisial" value="<?php echo $r['inisial'] ?> " >
      <td><?php echo $r['kelas'] ?></td>
      <td><?php echo $r['sks'] ?></td>
      <td><?php echo $r['ruang'] ?></td>
      <td><?php echo $r['kode'] ?></td>
      <td><?php echo $r['hari'] ?></td>
      <td><?php echo $r['jam'] ?></td>
      <td><?php echo $tgl ?></td>
      <td><?php echo $r['inisial'] ?></td>
<?php
$kelas=$r['kelas'];
$kode=$r['kode'];
$tgl=date('Y-m-d');
$rek=mysql_query("select *from rekap where nim='$nim' and tanggal='$tgl' and kelas='$kelas' and kode='$kode' ");
if(mysql_num_rows($rek) > 0)
{
	?><td><a href='' class="btn btn-block btn-warning disabled"> Sudah Rekap </a></td>
    <?php
}
else
{
	?><td><a href='?page=simpan_rekap&id=<?php echo $r['id_jadwal'] ?>' class="btn btn-block btn-success"> Rekap </a></td>
    <?php
} ?>
    </tr>
<?php } ?>
</tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
</form>

</section>