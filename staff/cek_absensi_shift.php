<?php

// Koneksi ke database (sesuaikan dengan konfigurasi Anda)


// Inisialisasi filter
$tgl_mulai = isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : '';
$tgl_sampai = isset($_POST['tgl_sampai']) ? $_POST['tgl_sampai'] : '';
$nik_filter = isset($_POST['nik_filter']) ? $_POST['nik_filter'] : '';

$sql = "SELECT 
    r.nik AS NIK, r.nama AS Nama, r.tanggal AS Tanggal, r.jam_masuk_awal AS `Jam Masuk Absensi`, 
    s.masuk AS `Jam Masuk Shift`, s.pulang AS `Jam Pulang Shift`, r.jam_keluar_akhir AS `Jam Keluar`, 
    TIMEDIFF(r.jam_keluar_akhir, r.jam_masuk_awal) AS `Total Jam Kerja`,
    k.shift AS `Nama Shift`,
    IF(r.jam_masuk_awal > s.masuk, 'Terlambat', 'Tepat Waktu') AS `Status Kedatangan`,
    IF(r.jam_masuk_awal > s.masuk, TIMESTAMPDIFF(MINUTE, s.masuk, r.jam_masuk_awal), 0) AS `Keterlambatan (menit)`
FROM tb_rekap_absensi_finger r
LEFT JOIN kalenderkerja k ON r.tanggal = k.tanggal
LEFT JOIN shift s ON k.shift = s.nama
WHERE 1=1";

if ($tgl_mulai && $tgl_sampai) {
    $sql .= " AND r.tanggal BETWEEN '$tgl_mulai' AND '$tgl_sampai'";
}
if ($nik_filter) {
    $sql .= " AND r.nik = '$nik_filter'";
}

$result = $conn->query($sql);

// Ambil daftar NIK untuk filter
$nik_sql = "SELECT DISTINCT nik,nama FROM tb_rekap_absensi_finger";
$nik_result = $conn->query($nik_sql);

?>

<!-- HTML code tetap sama seperti sebelumnya -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Presensi Karyawan</title>
</head>
<body>

    <section class="content-header">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Rekap Presensi Karyawan</h3>
                            <button type="button" onclick="tarikDataAbsensi()" class="btn btn-primary">Tarik data absensi</button>
                            <script>
                                function tarikDataAbsensi() {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('GET', 'tarik_data_absensi.php', true);
                                    xhr.onload = function() {
                                        if (xhr.status === 200) {
                                            alert(xhr.responseText);
                                            location.reload();
                                        } else {
                                            alert('Gagal menjalankan query');
                                        }
                                    }
                                    xhr.send();
                                }
                            </script>
                            <!-- Form Filter -->
                            <form method="post" style="display: flex; align-items: center;">
                                <label style="margin-right: 10px;">Tanggal Mulai:</label>
                                <input type="date" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>" style="width: 150px; margin-right: 10px;">
                                <label style="margin-right: 10px;">Tanggal Sampai:</label>
                                <input type="date" name="tgl_sampai" value="<?php echo $tgl_sampai; ?>" style="width: 150px; margin-right: 10px;">
                                <label style="margin-right: 10px;">NIK:</label>
                                <select name="nik_filter" class="form-control select2" style="width: 200px; margin-right: 10px;">
                                    <option value="">Semua</option>
                                    <?php while($nik_row = $nik_result->fetch_assoc()) { ?>
                                        <option value="<?php echo $nik_row['nik']; ?>" <?php if($nik_filter == $nik_row['nik']) echo 'selected'; ?>><?php echo $nik_row['nik']; ?> - <?php echo $nik_row['nama']; ?></option>
                                    <?php } ?>
                                </select>
                                <button type="submit" style="margin-left: 10px;">Filter</button>
                            </form>
                            
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
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
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><a href="?page=cek_absensi_personal&nik=<?php echo $row['NIK']; ?>"><?php echo $row['NIK']; ?></a></td>
                                        <td><?php echo $row['Nama']; ?></td>
                                        <td><?php echo $row['Tanggal']; ?></td>
                                        <td><?php echo getHariFromTanggal($row['Tanggal']); ?></td>
                                        <td><?php echo $row['Jam Masuk Absensi']; ?></td>
                                        <td><?php echo $row['Jam Masuk Shift']; ?></td>
                                        <td><?php echo $row['Jam Pulang Shift']; ?></td>
                                        <td><?php echo $row['Jam Keluar']; ?></td>
                                        <td><?php echo $row['Total Jam Kerja']; ?></td>
                                        <td><?php echo $row['Nama Shift']; ?></td>
                                        <td><?php echo $row['Status Kedatangan']; ?></td>
                                        <td>
                                            <?php 
                                            $keterlambatan = $row['Keterlambatan (menit)'];
                                            echo ($keterlambatan < 60) ? $keterlambatan.' menit' : floor($keterlambatan / 60).' jam '.($keterlambatan % 60).' menit';
                                            ?>
                                        </td>
                                        <td><a href="?page=edit_absensi&nik=<?php echo $row['NIK']; ?>&tanggal=<?php echo $row['Tanggal']; ?>">Edit</a></td>
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

</body>
</html>