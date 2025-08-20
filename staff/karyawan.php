<section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Karyawan</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Nama Jabatan</th>
                <th>Nama Bagian</th>
                <th>Nama Unit</th>
                <th>Aksi</th>
            </tr>
       </thead>
                    <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT 
                users.id,
                users.`name`, 
                users.`nik`,
                jabatan.`nama` AS nama_jabatan, 
                bag.`nama_bagian`, 
                unit.`unit` AS nama_unit 
            FROM 
                users
            LEFT JOIN 
                jabatan ON users.`jabatan_id` = jabatan.`id`
            LEFT JOIN 
                bag ON users.`divisi` = bag.`id_bagian`
            LEFT JOIN 
                unit ON users.`unit` = unit.`id`");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['nik']; ?></td>
                    <td><?php echo $row['nama_jabatan']; ?></td>
                    <td><?php echo $row['nama_bagian']; ?></td>
                    <td><?php echo $row['nama_unit']; ?></td>
                    <td>
                        <a href="edit_karyawan.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a> | 
                        <a href="hapus_karyawan.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</section>
</section>
