
<h1>Latihan Soal
          </h1>
         
<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
<div class="box">
               <div class="box-body"><a href=?page=input_soal><input type=submit value="Input Soal" class="btn btn-success"> </a>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>	
 
    <td>No</td>
    <td>AUTHOR</td>
    <td>MATA KULIAH</td>
    <td>JUDUL</td>    
    <td>FILE</td>
    <td>TANGGAL</td>
    <td>DOWNLOAD</td>
  </thead>
 <?php
$lihat=mysql_query("select *from soal");
while($row_soal=mysql_fetch_array($lihat))
{
	 ?>
 <tr>
      <td><?php echo $row_soal['id_soal']; ?></td>
      <td><?php echo $row_soal['penulis']; ?></td>
      <td><?php echo $row_soal['kode']; ?></td>
      <td><?php echo $row_soal['judul']; ?></td>     
      <td><?php echo $row_soal['file']; ?></td>
      <td><?php echo $row_soal['tanggal']; ?></td>
      <td><a href="../file/<?php echo $row_soal['file'] ?>" class="button" target="_blank"> Download </a><a href="?page=del_soal&id=<?php echo $row_soal['id_soal'] ?>&file=<?php echo $row_soal['file'] ?>" class="button"> Hapus </a>
     
    </tr>
   <?php } ?>
</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </section>