<?php
$log = mysqli_query($conn, "SELECT log.id_log, log.nim, log.ip, log.browser, log.tanggal, log.time, log.hari, admin.nama_lengkap FROM admin INNER JOIN log ON admin.nim=log.nim ORDER BY log.id_log DESC");
if (!$log) {
    die("Query Error: " . mysqli_error($conn));
}
$totalRows_log = mysqli_num_rows($log);
?>
<h1>LOG AKSES WEBSITE</h1>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>ip</td>
                                <td>browser</td>
                                <td>tanggal</td>
                                <td>Hari</td>
                                <td>time</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row_log = mysqli_fetch_assoc($log)) { ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row_log['nama_lengkap']; ?></td>
                                    <td><?php echo $row_log['ip']; ?></td>
                                    <td><?php echo $row_log['browser']; ?></td>
                                    <td><?php echo $row_log['tanggal']; ?></td>
                                    <td><?php echo $row_log['hari']; ?></td>
                                    <td><?php echo $row_log['time']; ?></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <?php
            mysqli_free_result($log);
            ?>
        </div>
    </div>
</section>