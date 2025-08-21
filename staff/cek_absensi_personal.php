<?php

// Koneksi ke database (sesuaikan dengan konfigurasi Anda)


// Ambil NIK dari input (misal dari $_POST atau $_GET)
$nik = isset($_GET['nik']) ? $_GET['nik'] : '';

$sql = "SELECT 
    nik, 
    nama, 
    tanggal, 
    jam_masuk_absensi, 
    jam_masuk_shift, 
    jam_pulang_shift, 
    jam_keluar, 
    total_jam_kerja, 
    nama_shift, 
    status_kedatangan, 
    keterlambatan_menit
FROM v_absensi_karyawan
WHERE nik = '$nik'";

$result = $conn->query($sql);

?>

   <section class="content-header">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Rekap Presensi Karyawan</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
    <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Hari</th>
        <th>Masuk</th>       
        <th>Keluar</th>
        <th>Total Jam Kerja</th>
        <th>Nama Shift</th>
        <th>Status Kedatangan</th>
        <th>Keterlambatan (menit)</th>
    </tr>
                                </thead>
                                <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['nik']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['tanggal']; ?></td>
        <td><?php echo getHariFromTanggal($row['tanggal']); ?></td>
        <td><?php echo $row['jam_masuk_absensi']; ?></td>      
        <td><?php echo $row['jam_keluar']; ?></td>
        <td><?php echo $row['total_jam_kerja']; ?></td>
        <td><?php echo $row['jam_masuk_shift']; ?> - <?php echo $row['jam_pulang_shift']; ?> (<?php echo $row['nama_shift']; ?>)</td>
        <td><?php echo $row['status_kedatangan']; ?></td>
        <td><?php echo $row['keterlambatan_menit']; ?></td>
    </tr>
    <?php } ?>
</table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
    </section>