<?php 
if(isset($_POST['simpan']))
{
$makanan = $_POST['makanan'];
$jumlah_dipilih = count($makanan);

for($x=0;$x<$jumlah_dipilih;$x++){
	mysql_query("INSERT INTO makanan values('','$makanan[$x]')");
}

echo "<script>alert('data tersimpan'); document.location='?page=makanan' </script>";
}
else
{
	$id=$_POST['id'];
	$jumlah_dipilih=count($id);
	for ($x=0; $x<$jumlah_dipilih; $x++)
	{
		mysql_query("delete from makanan where id='$id[$x]' ");
	}
	echo "<script>alert('data terhapus'); document.location='?page=makanan' </script>";
}
?>