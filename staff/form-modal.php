
<div class="container">
  
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Tambah Prestasi Mahasiswa</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Input Prestasi Mahasiwa</h4>
        </div>
        <div class="modal-body">
        <!-- awal konetntdisini -->

          <p>Some text in the modal.</p>
              <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-5">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
            <form method="post" action="">
      <div class="form-group">
                      <label for="exampleInputPassword1">Nama Prodi</label>
                 <td><input type="text" name="prodi" class="form-control" value="" size="32" /></td>
      </div>
      <div class="form-group">
                      <label for="exampleInputPassword1">Nama Prodi</label>
                 <td><input type="text" name="prodi" class="form-control" value="" size="32" /></td>
      </div>
      <div class="form-group">
                      <label for="exampleInputPassword1">Nama Prodi</label>
                 <td><input type="text" name="prodi" class="form-control" value="" size="32" /></td>
      </div>
      <div class="form-group">
                      <label for="exampleInputPassword1">Nama Prodi</label>
                 <td><input type="text" name="prodi" class="form-control" value="" size="32" /></td>
      </div>
      <div class="form-group">
                      <label for="exampleInputPassword1">Nama Prodi</label>
                 <td><input type="text" name="prodi" class="form-control" value="" size="32" /></td>
      </div>
      <div class="form-group">
                      <label for="exampleInputPassword1">Nama Prodi</label>
                 <td><input type="text" name="prodi" class="form-control" value="" size="32" /></td>
      </div>
     
      <input type="submit" value="Simpan Data" name="simpan" class="btn btn-success">
     </form>
     <?php
     if(isset($_POST['simpan']))
     {
       $simpan=mysql_query("insert into prodi (prodi) values ('$_POST[prodi]')") or die (mysql_error());
       echo "<script>alert('proses data'); document.location='?page=prodi' </script>";
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
           
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Prodi</th>
                  <th>Warna</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
        <?php 
        $prodi=mysql_query("select *from prodi");
        $no=1;
        while($data=mysql_fetch_array($prodi))
        { ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $data['prodi'] ?></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-sukses" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><a href="?page=del_prodi&idprodi=<?php echo $data['idprodi'];?>" class="badge bg-red" > Hapus </a></td>
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


        <!-- akhir kontent -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>