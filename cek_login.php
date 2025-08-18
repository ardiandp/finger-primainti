<?php
session_start();
include ('Connections/koneksi.php');
include ('Connections/library.php');

date_default_timezone_set('Asia/Jakarta');
$pass=$_POST['password'];
$username=$_POST['nim'];
$time=date('Y-m-d');
$jam=date('H:i:s');
$ip=$_SERVER['REMOTE_ADDR'];
$browser=$_SERVER['HTTP_USER_AGENT']; 
$day=date('D');

$login=mysqli_query($conn, "SELECT * FROM admin JOIN level ON admin.id_level=level.id_level WHERE admin.nim='$username' AND admin.password='$pass' AND admin.blokir='N'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

if($ketemu > 0 )
{		
    $_SESSION['MM_Username']=$r['nim'];	
    $_SESSION['nama_lengkap'] =$r['nama_lengkap'];
    $_SESSION['pass'] =$r['password'];
    $_SESSION['level'] =$r['level'];
    $_SESSION['foto']=$r['gambar'];
    $_SESSION['lokasi']='BSD';
    $_SESSION['waktu']=date('Y-m-d');
    $_SESSION['time']=date('H:i:s');
    $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
    $_SESSION['browser']=$_SERVER['HTTP_USER_AGENT'];

//    $log=mysqli_query($conn, "INSERT INTO log VALUES ('','$username','$ip','$browser','$time','$day','$jam')");
    //awal log atifitas
    $username=$_SESSION['MM_Username'];
    $waktu=date('Y-m-d H:i:s');
    $keterangan="melakukan login pada $waktu";
    $hari=date('D');
  //  $logact=mysqli_query($conn, "INSERT INTO log_aktifitas (username,keterangan,hari,waktu) VALUES ('$username','$keterangan','$hari','$waktu')");
    //akhir simpan log
    header("Location: staff/media.php?page=home");
}
else
{
    header("Location: index.php");
}
