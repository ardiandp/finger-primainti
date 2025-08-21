<?php

// Ambil parameter nik dan tanggal dari URL
$nik = isset($_GET['nik']) ? $_GET['nik'] : '';
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

// Query SQL untuk menampilkan data
$sql = "
    SELECT 
        r.nik AS NIK,
        r.nama AS Nama,
        r.tanggal AS Tanggal,
        r.jam_masuk_awal AS `Jam Masuk Absensi`,
        s.masuk AS `Jam Masuk Shift`,
        s.pulang as `Jam Pulang Shift`,
        r.jam_keluar_akhir AS `Jam Keluar`,
        TIMEDIFF(r.jam_keluar_akhir, r.jam_masuk_awal) AS `Total Jam Kerja`,
        k.shift AS `Nama Shift`,
        CASE
            WHEN r.jam_masuk_awal > s.masuk THEN 'Terlambat'
            WHEN r.jam_masuk_awal <= s.masuk THEN 'Tepat Waktu'
            ELSE 'Tidak Ada Data'
        END AS `Status Kedatangan`,
        CASE
            WHEN r.jam_masuk_awal > s.masuk THEN 
                TIMESTAMPDIFF(MINUTE, s.masuk, r.jam_masuk_awal)
            ELSE 0
        END AS `Keterlambatan (menit)`
    FROM 
        tb_rekap_absensi_finger r
    LEFT JOIN 
        kalenderkerja k ON r.tanggal = k.tanggal
    LEFT JOIN 
        shift s ON k.shift = s.nama
    WHERE r.nik = '$nik' AND r.tanggal = '$tanggal';
";

$result = $conn->query($sql);

// Proses update shift jika form disubmit
if (isset($_POST['update_shift'])) {
    $tanggal = $_POST['tanggal'];
    $new_shift = $_POST['new_shift'];
    
    // Update shift di tabel kalenderkerja
    $update_sql = "UPDATE kalenderkerja SET shift = '$new_shift' WHERE tanggal = '$tanggal'";
    $update_result = $conn->query($update_sql);
    if ($update_result) {
        echo "<script>alert('Shift berhasil diupdate');</script>";
    }
}

// Ambil daftar shift untuk dropdown
$shift_sql = "SELECT nama FROM shift";
$shift_result = $conn->query($shift_sql);

?>

 <section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
		
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Rekap Presensi Karyawan </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>masuk</th>  
        <th>Keluar</th>  
        <th>Nama Shift</th>
        <th>Status</th>
        <th>Terlambat</th>
        <th>Edit Shift</th>
</tr>
        </thead>
        <tbody>
    <?php if ($result->num_rows > 0) { ?>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["NIK"]; ?></td>
                <td><?php echo $row["Nama"]; ?></td>
                <td><?php echo $row["Tanggal"]; ?></td>
                <td><?php echo $row["Jam Masuk Absensi"]; ?></td>               
                <td><?php echo $row["Jam Keluar"]; ?></td>              
                <td><?php echo $row["Nama Shift"]." (".$row["Jam Masuk Shift"]." - ".$row["Jam Pulang Shift"].")"; ?></td>
                <td><?php echo $row["Status Kedatangan"]; ?></td>                <td><?php 
                    $menit = (int) $row["Keterlambatan (menit)"];
                    $jam = floor($menit / 60);
                    $menit = $menit % 60;
                    echo sprintf("%02d Jam %02d Menit", $jam, $menit); 
                ?></td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='tanggal' value='<?php echo $row['Tanggal']; ?>'>
                        <select name='new_shift'>
                            <?php
                            if ($shift_result->num_rows > 0) {
                                while($shift_row = $shift_result->fetch_assoc()) {
                                    $selected = ($shift_row['nama'] == $row['Nama Shift']) ? 'selected' : '';
                                    echo "<option value='" . $shift_row['nama'] . "' $selected>" . $shift_row['nama'] . "</option>";
                                }
                                $shift_result->data_seek(0); // Reset pointer for next loop
                            }
                            ?>
                        </select>
                        <input type='submit' name='update_shift' value='Update Shift' class="btn btn-sm btn-primary">
                    </form>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr><td colspan='11'>Tidak ada data</td></tr>
    <?php } ?>
</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

</body>
</html>

