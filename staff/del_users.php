<?php
$del=mysql_query("delete from admin where nim =$_GET[nim] ");
$hapus=mysql_query("delete from datadiri where nim =$_GET[nim] ");
   echo "<script>document.location='?page=users' </script>";
