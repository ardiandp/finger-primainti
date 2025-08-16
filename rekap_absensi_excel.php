<?php

require 'config/database.php';
require 'config/date_helper.php';

$query = "SELECT nik, nama, tanggal, jam_masuk_awal, jam_keluar_akhir FROM rekap_absensi_finger";

$result = $conn->query($query);

if ($result->num_rows > 0) { ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Roles</h1>
      
    </div>
     <table id="datatableBS4" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Hari</th>
            <th>Jam Masuk Awal</th>
            <th>Jam Keluar Akhir</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["nik"] ?></td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["tanggal"] ?></td>
            <td><?= getHariFromTanggal($row["tanggal"]) ?></td>
            <td><?= $row["jam_masuk_awal"] ?></td>
            <td><?= $row["jam_keluar_akhir"] ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
    </table>
<?php } else {
    echo "Tidak ada data";
}

?>

