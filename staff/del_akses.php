
<?php
$delete=mysql_query("delete from akses where id='$_GET[id]' ");
echo "<script>alert ('Data Terhapus'); document.location='?page=akses' </script> ";
?>
