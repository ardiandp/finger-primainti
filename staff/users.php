<?php
$query_users = "SELECT * FROM admin LEFT JOIN level ON admin.id_level = level.id_level ORDER BY admin.nama_lengkap ASC";
$users = mysqli_query($conn, $query_users);
$totalRows_users = mysqli_num_rows($users);
?>
<section class="content-header">  
         
       
    <section class="content">    <a href="?page=add_users" class="btn btn-success">Tambah User</a>
          <div class="row">
            <div class="col-xs-12">
  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Users </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
    <th>No</th>
    <th>Nim</th>
    <th>Nama Lengkap</th>
    <th>Kode</th>
    <th>Telp</th>
    <th>Blokir</th>
    <th>Level</th>
    <th>Aksi</th>
   </tr>
                    </thead>
                    <tbody>
  <?php $no=1;do { ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $row_users['nim']; ?></td>
      <td><?php echo $row_users['nama_lengkap']; ?></td>
      <td><?php echo $row_users['inisial']; ?></td>
      <td><?php echo $row_users['no_telp']; ?></td>
      <td><?php echo $row_users['blokir']; ?></td>
      <td><?php echo $row_users['level']; ?></td>
      <td><a href="?page=edit_users&nim=<?php echo $row_users['nim']; ?>">Edit </a><a href="?page=del_users&nim=<?php echo $row_users['nim']; ?>">Del</a></td>
    </tr>
    <?php $no++;} while ($row_users = mysqli_fetch_assoc($users)); ?>
</tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
<?php
mysqli_free_result($users);
?>
 </section>    
