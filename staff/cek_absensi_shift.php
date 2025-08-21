<?php

// Query SQL
$sql = "
    SELECT 
        r.nik AS NIK,
        r.nama AS Nama,
        r.tanggal AS Tanggal,
        r.jam_masuk_awal AS `Jam Masuk Absensi`,
        s.masuk AS `Jam Masuk Shift`,
          s.pulang AS `Jam Pulang Shift`,
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
        shift s ON k.shift = s.nama;
";

$result = $conn->query($sql);

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
        <th>Jam Masuk Absensi</th>
        <th>Jam Masuk Shift</th>
          <th>Jam Pulang Shift</th>
        <th>Jam Keluar</th>
        <th>Total Jam Kerja</th>
        <th>Nama Shift</th>
        <th>Status Kedatangan</th>
        <th>Keterlambatan (menit)</th>
        <th>Aksi</th>
   </tr>
        </thead>
        <tbody>
    <?php if ($result->num_rows > 0) { ?>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row["NIK"] ?></td>
        <td><?php echo $row["Nama"] ?></td>
        <td><?php echo $row["Tanggal"] ?></td>
        <td><?php echo $row["Jam Masuk Absensi"] ?></td>
        <td><?php echo $row["Jam Masuk Shift"] ?></td>
        <td><?php echo $row["Jam Pulang Shift"] ?></td>
        <td><?php echo $row["Jam Keluar"] ?></td>
        <td><?php echo $row["Total Jam Kerja"] ?></td>
        <td><?php echo $row["Nama Shift"] ?></td>
        <td><?php echo $row["Status Kedatangan"] ?></td>
      
        <td>
            <?php
            $keterlambatan = $row["Keterlambatan (menit)"];
            if ($keterlambatan < 60) {
                echo $keterlambatan . " menit";
            } else {
                echo floor($keterlambatan / 60) . " jam " . ($keterlambatan % 60) . " menit";
            }
            ?>
        </td>
          <td><a href="?page=edit_absensi&nik=<?php echo $row["NIK"] ?>&tanggal=<?php echo $row["Tanggal"] ?>">Edit</a></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr><td colspan="10">Tidak ada data</td></tr>
    <?php } ?>
</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

</body>
</html>

