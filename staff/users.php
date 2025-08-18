<?php
$query_users = "SELECT * FROM admin LEFT JOIN level ON admin.id_level = level.id_level ORDER BY admin.nama_lengkap ASC";
$users = mysqli_query($conn, $query_users);
if (!$users) {
    die("Query Error: " . mysqli_error($conn));
}
$totalRows_users = mysqli_num_rows($users);
?>
<section class="content-header">  
</section>

<section class="content">
    <a href="?page=add_users" class="btn btn-success">Tambah User</a>
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
                                <th style="width:40px;">No</th>
                                <th style="width:100px;">nik</th>
                                <th style="width:200px;">Nama Lengkap</th>
                                <th style="width:80px;">Kode</th>
                                <th style="width:120px;">Telp</th>
                                <th style="width:80px;">Blokir</th>
                                <th style="width:120px;">Level</th>
                                <th style="width:80px;text-align:right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row_users = mysqli_fetch_assoc($users)) { ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row_users['nik']; ?></td>
                                    <td><?php echo $row_users['nama_lengkap']; ?></td>
                                    <td><?php echo $row_users['inisial']; ?></td>
                                    <td><?php echo $row_users['no_telp']; ?></td>
                                    <td><?php echo $row_users['blokir']; ?></td>
                                    <td><?php echo $row_users['level']; ?></td>
                                    <td>
                                        <a href="?page=edit_users&nik=<?php echo $row_users['nik']; ?>" class="btn btn-sm btn-warning">Edit</a> | 
                                        <a href="?page=del_users&nik=<?php echo $row_users['nik']; ?>" class="btn btn-sm btn-danger">Del</a>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <?php
            mysqli_free_result($users);
            ?>
        </div>
    </div>
</section>