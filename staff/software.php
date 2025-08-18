 <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
        
          </div><!-- /.row -->
          <!-- Main row -->


		       <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Software Disini	</h3>
            </div>
            <!-- /.box-header -->
			 <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
		  <div class="form-group">
					<label for="exampleInputPassword1">Nama Software</label>
                      <input type="text" class="form-control" required name="nama" placeholder="Masukan NIM Anda"/>
                    </div>
                    <div class="form-group">
					<label for="exampleInputPassword1">Tag</label>
                      <input type="text" class="form-control" required name="tag" placeholder="Masukan Nama Anda"/>
                    </div>
					 <div class="form-group">
					<label for="exampleInputPassword1">Size</label>
                      <input type="text" class="form-control" name="size" value="12mb"  />
                    </div>
					
					 <div class="form-group">
					<label for="exampleInputPassword1">Upload Software</label>
                      <input type="file" class="form-control" required name="file" />
                    </div>
					 
					 <div class="box-footer clearfix">
                    <input type="submit" name='simpan' value="Upload Tugas" class="btn btn-primary">
                     </div>
 </div>
           </form>
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
		
		
	<?php
    if(isset($_POST['simpan']))
    {
            $nim=$_SESSION['MM_Username'];
            $nama=$_POST['nama'];
            $ext=".rar";                 
            $filename=$_FILES['file']['name'];
            $nama_file_unix=$nim.'-'.$nama.$ext;
            $tglnow=date('Y-m-d');


            $move=move_uploaded_file($_FILES['file']['tmp_name'],'../upload/software/'.$nama_file_unix);
      $simpan=mysql_query("insert into software (nama,tag,size,nim,software) values
                    ('$_POST[nama]','$_POST[tag]','$_POST[size]','$nim','$nama_file_unix')") or die ("gagal simpan");
    echo "<script>alert ('data tersimpan'); document.location='?page=software' </script >";
    }
    ?>
		
        <!-- /.col -->
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Software</h3>
       
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>tag</th>
				          <th>Size</th>
                  <th>Unduh</th>
				          <th>Aksi</th>
                </tr>
				<?php
				
				$tugas=mysql_query("select *from software");
				$no=1;
				while ($tgs=mysql_fetch_array($tugas))
				{ ?>
				<tr>
                  <td> <?php echo $no ?></td>
                  <td><?php echo $tgs['nama'] ?></td>
                  <td> <?php echo $tgs['tag'] ?>   </td>
				          <td> <?php echo $tgs['size'] ?>   </td>
                  <td><a href="../upload/software/<?php echo $tgs['software'] ?>"> Unduh </a></td>
				         <td><a href='' class="fa fa-download"> Hapus </a> </td>
                </tr>
				<?php $no++; } ?>
             
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
		  
		  

        </section><!-- /.content -->
     