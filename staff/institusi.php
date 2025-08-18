    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-5">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Institusi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="post" action="">
			<div class="form-group">
                      <label for="exampleInputPassword1">Nama Institusi</label>
                 <td><input type="text" name="institusi" class="form-control" value="" size="32" /></td>
            </div>
      <div class="form-group">
                      <label for="exampleInputPassword1">Warna</label>
                 <td><input type="text" name="warna" class="form-control" value="" size="32" /></td>
            </div>
			<input type="submit" value="Simpan Data" name="simpan" class="btn btn-success">
		 </form>
		 <?php
		 if(isset($_POST['simpan']))
		 {
			 $simpan=mysql_query("insert into institusi (institusi,warna) values ('$_POST[institusi]','$_POST[warna]')") or die (mysql_error());
			 echo "<script>alert('proses data'); document.location='?page=institusi' </script>";
		 }?>
		 
            </div>
            <!-- /.box-body -->
          
          </div>
          <!-- /.box -->

       
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-7">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Institusi</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Institusi</th>
                  <th>Warna</th>
                  <th style="width: 10px">Aksi</th>
               </tr>
   </thead>
                    <tbody>
				<?php 
				$institusi=mysql_query("select *from institusi");
				$no=1;
				while($data=mysql_fetch_array($institusi))
				{ ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $data['institusi'] ?></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-sukses" style="width: 10%"></div>
                    </div>
                  </td>
                  <td><a href="?page=del_institusi&id=<?php echo $data['idinstitusi'];?>" class="badge bg-red" > Hapus </a></td>
                </tr>
                <?php $no++;} ?>
                
             </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     
    </section>
    <!-- /.content -->
  </div>
