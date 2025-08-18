<?php
$file=$_GET['file'];
if(!empty($file))
{
	$hapus=mysql_query("delete from soal where id_soal='$_GET[id]' ");
	unlink("../file/$file");
    echo "<script>alert ('data Terhapus'); document.location='?page=latihan_soal' </script> ";
}
else
{
	$hapus=mysql_query("delete from soal where id_soal='$_GET[id]' ");
    echo "<script>alert ('data Terhapus'); document.location='?page=latihan_soal' </script> ";
}
?>