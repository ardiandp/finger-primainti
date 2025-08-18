
<?php
// membaca file koneksi.php
//include "koneksi.php";

// membaca tabel-tabel yang dipilih dari form
$tabel = $_POST['tabel'];

// proses untuk menggabung nama-nama tabel yang dipilih
// sehingga menjadi sebuah string berbentuk 'tabel1 tabel2 tabel3 ...'

$listTabel = "";
foreach($tabel as $namatabel)
{
  $listTabel .= $namatabel." ";
}

// membentuk string command menjalankan mysqldump
// diasumsikan file mysqldump terletak di dalam folder C:\AppServ\MySQL\bin

$command = "C:\server\MySQL\bin\mysqldump -u".$username_koneksi." -p".$password_koneksi." ".$database_koneksi." ".$listTabel." > ".$database_koneksi.".sql";

// perintah untuk menjalankan perintah mysqldump dalam shell melalui PHP
exec($command);

// bagian perintah untuk proses download file hasil backup.

header("Content-Disposition: attachment; filename=".$dbName.".sql");
header("Content-type: application/download");
$fp  = fopen($dbName.".sql", 'r');
$content = fread($fp, filesize($dbName.".sql"));
fclose($fp);

echo $content;

exit;
?>