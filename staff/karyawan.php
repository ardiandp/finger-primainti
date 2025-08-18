<div class="table-responsive">
   <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
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
                        <a href="edit_karyawan.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                        <a href="hapus_karyawan.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>