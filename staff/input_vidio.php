<form method="post" action="" enctype="multipart/form-data">
<table border='1'>
<tr><td>Judul Vidio</td><td><input type="text" name="judul"></td></tr>
<tr><td>Keterangan</td><td><textarea name="keterangan"> </textarea> </td></tr>
<tr><td>Kategori</td><td><input type="text" name="kategori"></td></tr>
<tr><td>Vidio</td><td><input type="file" name="vidio"></td></tr>
<tr><td>Tag</td><td><input type="text" name="tag"></td></tr>
<tr><td><input type="submit" value="Simpan" name="simpan"></td><td><input type="reset" value="Batal" name="simpan"></td></tr>
</table>
</form>

<?php
if(isset($_POST['simpan']))
{
	$id=date('is');
	$user=$_SESSION['MM_Username'];
	$judul=$_POST['judul'];
	$tgl=date('Y-m-d H-i-s');
	$ext=".mp4";
	$filename=$_FILES['vidio']['name'];
	$size=$_FILES['vidio']['size'];
    $nama_file_unix=$id.'-'.$judul.$ext;

    $move=move_uploaded_file($_FILES['vidio']['tmp_name'],'../upload/vidio/'.$nama_file_unix);
    $masuk=mysql_query("insert into vidio (id,judul,keterangan,kategori,vidio,size,tanggal,tag,diupload)
    	          values ('$id','$judul','$_POST[keterangan]','$_POST[kategori]','$nama_file_unix','$size','$tgl','$_POST[tag]','$user')") or die (mysql_error());
     echo "<script>alert('Vidio Berhasil Di Upload'); document.location='?page=list_vidio' </script >";
}
