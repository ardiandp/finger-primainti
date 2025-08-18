<?php
$file=$_GET['file'];
$del=mysql_query("delete from vidio where id='$_GET[id]' ");
unlink('../upload/vidio/'.$file);

//echo  "<script>window.history.back(); </script>";
echo "<script>document.location='?page=list_vidio' </script>";
?>