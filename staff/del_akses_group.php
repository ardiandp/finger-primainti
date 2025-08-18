<?php
$del=mysql_query("delete from akses where id=$_GET[id] ");
echo "<script>alert ('data terhapus'); document.location='?page=akses_group' </script>";
?>