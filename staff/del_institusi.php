<?php
$del=mysql_query("delete from institusi where idinstitusi='$_GET[id]' ");
 echo "<script>alert('proses data'); document.location='?page=institusi' </script>";
 ?>