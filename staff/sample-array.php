<?php
$kampus=mysql_query("SELECT kampus, COUNT(nim) as jumlah FROM `bpres-data_diri` GROUP BY kampus") or die(mysql_error());
while($k=mysql_fetch_array($kampus))
{
  $viewkampus[]=$k;
} ?>

<?php echo json_encode($viewkampus) ; ?> 