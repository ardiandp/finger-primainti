<?php
$query_level = "SELECT * FROM `level`";
$level = mysqli_query($conn, $query_level);
if (!$level) {
    die("Query Error: " . mysqli_error($conn));
}

// Proses hapus data
if (isset($_GET['hapus_id'])) {
    $hapus_id = $_GET['hapus_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM level WHERE id_level = ?");
    mysqli_stmt_bind_param($stmt, "i", $hapus_id);
    mysqli_stmt_execute($stmt);
    echo "<script>document.location='?page=level'</script>";
}

// Proses update data
if (isset($_POST['update_level'])) {
    $id_level = $_POST['id_level'];
    $level_nama = $_POST['level'];
    $aktif = $_POST['aktif'];
    $stmt = mysqli_prepare($conn, "UPDATE level SET level = ?, aktif = ? WHERE id_level = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $level_nama, $aktif, $id_level);
    mysqli_stmt_execute($stmt);
    echo "<script>document.location='?page=level'</script>";
}
?>
<section class="content-header">     
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Level</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id_level="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>id_level</th>
                                <th>Level</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row_level = mysqli_fetch_assoc($level)) { ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row_level['id_level']; ?></td>
                                    <td><?php echo $row_level['level']; ?></td>
                                    <td><?php echo $row_level['aktif']; ?></td>
                                    <td>
                                     
                                        <a href="?page=level&hapus_id=<?php echo $row_level['id_level']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>

                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>