<?php
require_once('Connections/koneksi.php');

if ($conn->query($query) === TRUE) {
    $result = $conn->query("SELECT 
    r.nik,
    r.nama,
    r.tanggal,
    r.jam_masuk_awal AS jam_masuk,
    r.jam_keluar_akhir AS jam_keluar,
    TIMEDIFF(r.jam_keluar_akhir, r.jam_masuk_awal) AS total_jam_kerja,
    k.shift AS nama_shift
FROM 
    tb_rekap_absensi_finger r
LEFT JOIN 
    kalenderkerja k ON r.tanggal = k.tanggal");

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "NIK: " . $row["nik"]. " - Nama: " . $row["nama"]. " - Tanggal: " . $row["tanggal"]. " - Jam Masuk: " . $row["jam_masuk"]. " - Jam Keluar: " . $row["jam_keluar"]. " - Total Jam Kerja: " . $row["total_jam_kerja"]. " - Nama Shift: " . $row["nama_shift"]. "<br>";
        }
    } else {
        echo "Tidak ada data";
    }
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

