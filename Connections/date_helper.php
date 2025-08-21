<?php
/**
 * Mengkonversi tanggal ke nama hari (Indonesia)
 * @param string $date Format: Y-m-d (e.g. "2025-06-30")
 * @return string Nama hari atau pesan error
 */
function getHariFromTanggal($date) {
    if (!strtotime($date)) {
        return "Format tanggal invalid!";
    }

    $hariInggris = date('l', strtotime($date));
    
    $hariIndo = [
        'Sunday'    => 'Minggu',
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu'
    ];

    return ucfirst($hariIndo[$hariInggris] ?? 'Hari tidak dikenal');
}

// Contoh penggunaan
echo getHariFromTanggal('2025-06-30'); // output: Senin

?>