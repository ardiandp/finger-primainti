    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-5">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Group</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="post" action="">
			<div class="form-group">
                      <label for="exampleInputPassword1">Nama Group</label>
                 <td><input type="text" name="level" class="form-control" value="" size="32" /></td>
            </div>
			<input type="submit" value="Simpan Data" name="simpan" class="btn btn-success">
		 </form>
		 <?php
		 if(isset($_POST['simpan']))
		 {
			 $simpan=mysql_query("insert into level (level) values ('$_POST[level]')") or die (mysql_error());
			 echo "<script>alert('proses data'); document.location='?page=setting/group' </script>";
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
              <h3 class="box-title">Data Group / Level</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Group</th>
                  <th>Akses</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
				<?php 
				$level=$conn->query("select *from level");
				$no=1;
				while($data=$level->fetch_assoc())
				{ ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $data['level'] ?></td>
                  <td>
                    <a href="?page=add_akses&id=<?php echo $data['id_level'];?>" class="badge bg-green" > Akses </a>
                  </td>
                  <td><a href="?page=setting/del_group&id=<?php echo $data['id_level'];?>" class="badge bg-red" > Hapus </a></td>
                </tr>
                <?php $no++;} ?>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     
    </section>
    <!-- /.content -->
  </div>
