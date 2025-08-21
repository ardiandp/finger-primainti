

 <section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
			<a href="?page=input_menu" class="btn btn-success">Tambah Menu</a>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Kalender Kerja </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Karyawan</th>
                <th>Divisi</th>
                <th>Unit</th>
                <th>NIK</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT kalenderkerja.*, users.`nik`, users.`name` FROM kalenderkerja LEFT JOIN users ON kalenderkerja.`karyawan`=users.`id`");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['shift']; ?></td>
                    <td><?php echo $row['karyawan']; ?></td>
                    <td><?php echo $row['divisi']; ?></td>
                    <td><?php echo $row['unit']; ?></td>
                    <td><?php echo $row['nik']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</section>

<script>
  $(function () {
    $('#example6').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'dom'         : 'Bfrtip',
      'buttons'     : [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    })
  })
</script>
