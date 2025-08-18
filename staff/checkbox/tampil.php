<?php
//include ('Connections/menu.php');
?>
<form method="post" action="">
<table width="364" border=1>
<tr><td width="107">LEVEL</td><td width="241">
<select name="level">
<?php
$akses=mysql_query("select *from level where id_level='3' ");

while($a=mysql_fetch_array($akses))
	
{
	echo "<option value=$a[id_level]>$a[level] </option>";
} ?>
</select>
</td></tr>
<tr><td>Menu </td>
<td>
<?php
$parent=mysql_query("select *from menu where is_parent='0' ");

while($p=mysql_fetch_array($parent))
{
	$cekmenu=mysql_query(" SELECT * FROM akses, menu WHERE akses.menu = menu.id
                           AND akses.id_level =3
                           AND menu.is_parent =0 group by akses.id");
	$jumlah=mysql_num_rows($cekmenu);
	while($cp=mysql_fetch_array($cekmenu))
	{
		$idakses=$p[id];
		$idmenu=$cp[id];
		if($idakses==$idmenu)
		{
	?>
	   <b><input type="checkbox" name="menu[]" value="<?php echo $p['id'] ?>" checked   /><?php echo $p['name'] ?>	</b><br />
    <?php } else { ?>
	<b><input type="checkbox" name="menu[]" value="<?php echo $p['id'] ?>"   /><?php echo $p['name'] ?>	</b><br />
	<?php } } ?>
    <?php
$sub=mysql_query("select *from menu where is_parent='$p[id]' ");
while($s=mysql_fetch_array($sub))
{
	?>
   <input type="checkbox" name="menu[]" value="<?php echo $s['id'] ?>"   /><?php echo $s['name'] ?> <br />
    
    <?php } 
 } ?>

--


</td></tr>
<tr><td colspan="2"><input type="submit" value="Simpan" name="simpan"></td></tr>
</table>
</form>
Jumlah Menu Dosen ada <?php echo $jumlah ?>


<?php
if(isset($_POST['simpan']))
{
	$level=$_POST['level'];
	$menu=$_POST['menu'];
	$jml=count($menu);

	echo "$level <br>";
	echo "$jml";

	for($a=0;$a<$jml;$a++)
	{
      $simpan=mysql_query("insert into akses (id,id_level,menu) values ('','$level','$menu[$a]') ") or die (mysql_error());
      echo "<script>document.location='?page=akses' </script>";
	}

}
?>