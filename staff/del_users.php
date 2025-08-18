<?php
if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];

    // Menggunakan prepared statements untuk mencegah SQL injection
    $stmt1 = mysqli_prepare($conn, "DELETE FROM admin WHERE nik = ?");
    mysqli_stmt_bind_param($stmt1, "s", $nik);
    mysqli_stmt_execute($stmt1);

    $stmt2 = mysqli_prepare($conn, "DELETE FROM datadiri WHERE nik = ?");
    mysqli_stmt_bind_param($stmt2, "s", $nik);
    mysqli_stmt_execute($stmt2);

    echo "<script>document.location='?page=users'</script>";
} else {
    echo "<script>alert('nik tidak ditemukan'); document.location='?page=users'</script>";
}
?>