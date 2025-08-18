<?php
$query_Recordset1 = "SELECT * FROM menu";
$Recordset1 = $conn->query($query_Recordset1) or die($conn->error);
$totalRows_Recordset1 = $Recordset1->num_rows;
?>


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
					<?php do { ?>
                      
                      <tr>
                        <td><?php echo $row_Recordset1['id']; ?></td>
                        <td><?php echo $row_Recordset1['name']; ?></td>
                        <td><?php echo $row_Recordset1['link']; ?></td>
                        <td><?php echo $row_Recordset1['icon']; ?></td>
                        <td><?php echo $row_Recordset1['is_active']; ?></td>
						<td><?php echo $row_Recordset1['is_parent']; ?> </td>
						<td> <a href="?page=edit_menu&id=<?php echo $row_Recordset1['id']; ?>">Edit </a><a href="?page=del_menu&id=<?php echo $row_Recordset1['id']; ?>">Del</a></td>
                      </tr>
                       <?php } while ($row_Recordset1 = $Recordset1->fetch_assoc()); ?>                   
                    
                    </tbody>                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
	  
<?php
mysqli_free_result($Recordset1);
?>
   </section>	
	