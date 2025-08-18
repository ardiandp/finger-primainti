

 <section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
			<a href="?page=input_menu" class="btn btn-success">Tambah Menu</a>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Menu </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>LINK</th>
                        <th>ICON</th>
                        <th>AKTIF</th>
						<th>PARENT</th>
						<th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
$query_Recordset1 = "SELECT * FROM menu";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error($conn));
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)) {
                      ?>
                      
                      <tr>
                        <td><?php echo $row_Recordset1['id']; ?></td>
                        <td><?php echo $row_Recordset1['name']; ?></td>
                        <td><?php echo $row_Recordset1['link']; ?></td>
                        <td><?php echo $row_Recordset1['icon']; ?></td>
                        <td><?php echo $row_Recordset1['is_active']; ?></td>
						<td><?php echo $row_Recordset1['is_parent']; ?> </td>
						<td> <a href="?page=edit_menu&id=<?php echo $row_Recordset1['id']; ?>" class="btn btn-sm btn-primary">Edit </a><a href="?page=del_menu&id=<?php echo $row_Recordset1['id']; ?>" class="btn btn-sm btn-danger">Del</a></td>
                      </tr>
                      
                      <?php } ?>                   
                    </tbody>                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
	  
<?php
mysqli_free_result($Recordset1);
?>
   </section>	
	