<?php
$query_akses = "SELECT akses.id,akses.id_level,akses.menu,level.level,menu.name from akses JOIN level ON akses.id_level=level.id_level JOIN menu ON akses.menu=menu.id";
$akses = mysqli_query($conn, $query_akses) or die(mysqli_error($conn));
$row_akses = mysqli_fetch_assoc($akses);
$totalRows_akses = mysqli_num_rows($akses);
?>
<section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Akses Semua Level </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
    <td>id</td>
    <td>id_level</td>
    <td>menu</td>
    <td>level</td>
    <td>name</td>
    <td>del</td>
   </tr>
                    </thead>
                    <tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_akses['id']; ?></td>
      <td><?php echo $row_akses['id_level']; ?></td>
      <td><?php echo $row_akses['menu']; ?></td>
      <td><?php echo $row_akses['level']; ?></td>
      <td><?php echo $row_akses['name']; ?></td>
      <td><a href="?page=del_akses&id=<?php echo $row_akses['id']; ?>">Del </a></td>
    </tr>
    <?php } while ($row_akses = mysqli_fetch_assoc($akses)); ?>
</tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
mysqli_free_result($akses);
?>
</section>
