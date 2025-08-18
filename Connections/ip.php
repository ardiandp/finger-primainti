<?php
include ('koneksi.php');

// Statistik user
$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
$tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
$waktu   = time(); // 

try {
    // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
    $s = mysqli_query($conn, "SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
    $cek = mysqli_num_rows($s);
    // Kalau belum ada, simpan data user tersebut ke database
    if ($cek == 0) {
        mysqli_query($conn, "INSERT INTO statistik(ip, tanggal, hits, online) VALUES ('$ip', '$tanggal', '1', '$waktu')");
    } else {
        mysqli_query($conn, "UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
    }

    $pengunjung       = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(DISTINCT ip) FROM statistik WHERE tanggal='$tanggal'"))[0];
    $totalpengunjung  = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(DISTINCT ip) FROM statistik"))[0]; 
    $hits             = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal'"))['hitstoday']; 
    $totalhits        = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hits) FROM statistik"))[0]; 
    $tothitsgbr       = sprintf("%06d", $totalhits);
    $bataswaktu       = time() - 300;
    $pengunjungonline = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM statistik WHERE online > '$bataswaktu'"))[0];

    $path = "counter/";
    $ext = ".png";

    for ($i = 0; $i <= 9; $i++) {
        $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>

