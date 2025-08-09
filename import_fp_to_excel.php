<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Koneksi Database
$host = "localhost";
$username = "root";
$password = "";
$database = "native_tarik_fp";
$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk membersihkan input
function bersihkan($koneksi, $data) {
    return mysqli_real_escape_string($koneksi, trim($data));
}

if (isset($_POST['submit'])) {
    $file = $_FILES['file']['tmp_name'];
    $ekstensi = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    // Validasi ekstensi file
    if (!in_array($ekstensi, ['xls', 'xlsx'])) {
        die("Hanya file Excel (.xls, .xlsx) yang diizinkan!");
    }

    // Load file Excel
    try {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Lewati header (baris pertama)
        array_shift($rows);

        foreach ($rows as $row) {
            // Pastikan kolom sesuai urutan: Nik, nama, waktu, status
            $nik = bersihkan($koneksi, $row[0] ?? '');
            $nama = bersihkan($koneksi, $row[1] ?? '');
            $waktu = bersihkan($koneksi, $row[2] ?? '');
            $status = bersihkan($koneksi, $row[3] ?? '');

            // Skip baris kosong
            if (empty($nik) || empty($waktu)) continue;

            // Proses format tanggal dan jam
            $datetime = explode(" ", $waktu);
            $tanggal = date("Y-m-d", strtotime(str_replace('/', '-', $datetime[0])));
            $jam = date("H:i:s", strtotime(str_replace('.', ':', $datetime[1] ?? '00:00')));

            // Tentukan jam_masuk/jam_keluar
            $jam_masuk = (strpos($status, 'Masuk') !== false) ? $jam : NULL;
            $jam_keluar = (strpos($status, 'Keluar') !== false) ? $jam : NULL;

            // Insert ke database
            $query = "INSERT INTO tarik_absensi (nik, nama, tanggal, jam_masuk, jam_keluar, keterangan) 
                      VALUES ('$nik', '$nama', '$tanggal', " . 
                      ($jam_masuk ? "'$jam_masuk'" : "NULL") . ", " . 
                      ($jam_keluar ? "'$jam_keluar'" : "NULL") . ", '$status')";
            
            mysqli_query($koneksi, $query);
        }

        echo "<script>alert('Data berhasil diimport!'); window.location.href = 'import_absensi_excel.php';</script>";
    } catch (Exception $e) {
        die("Error loading file: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Import Excel ke Database</title>
</head>
<body>
    <h2>Import Data Absensi dari Excel</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Pilih File Excel (XLS/XLSX):</label>
        <input type="file" name="file" required accept=".xls,.xlsx">
        <button type="submit" name="submit">Import Data</button>
    </form>

    <p><strong>Format File Excel:</strong></p>
    <table border="1">
        <tr>
            <th>Nik</th>
            <th>Nama</th>
            <th>Waktu (dd/mm/yyyy hh.mm)</th>
            <th>Status (C/Masuk atau C/Keluar)</th>
        </tr>
        <tr>
            <td>10001</td>
            <td>SAEBANI</td>
            <td>22/06/2025 07.47</td>
            <td>C/Masuk</td>
        </tr>
    </table>
</body>
</html>