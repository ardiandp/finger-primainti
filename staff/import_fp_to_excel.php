<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Koneksi Database
//$conn = require '../config/database.php';

// Fungsi untuk membersihkan input
function bersihkan(mysqli $conn, mixed $data): string {
    return mysqli_real_escape_string($conn, trim((string) $data));
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
            $nik = bersihkan($conn, $row[0] ?? '');
            $nama = bersihkan($conn, $row[1] ?? '');
            $waktu = bersihkan($conn, $row[2] ?? '');
            $status = bersihkan($conn, $row[3] ?? '');

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
            
            mysqli_query($conn, $query);
        }

        echo "<script>alert('Data berhasil diimport!'); window.location.href = '?page=rekap_absen_finger_excel';</script>";
    } catch (Exception $e) {
        die("Error loading file: " . $e->getMessage());
    }
}
?>
<section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Import Data Absensi dari Excel</h3>
                </div>
                <div class="box-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputFile">Pilih File Excel (XLS/XLSX):</label>
                      <input type="file" name="file" required accept=".xls,.xlsx" id="exampleInputFile">
                      <p class="help-block">Download format file <a href="../uploads/TemplateImport.xlsx" download="TemplateImport.xlsx">disini</a></p>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Import Data</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
</section>

