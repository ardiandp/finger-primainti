<form action="" method="post">
  <table width="560" height="96" border="1">
    <tr>
      <td width="260">AKSES</td>
      <td width="424">
      <select name="akses">
      <?php
$level=mysql_query("select *from level");
while($l=mysql_fetch_array($level))
{ 
  echo "<option value=$l[id]> $l[level]  </option> ";
}?>
      </select>
   </td>
    </tr>
    <tr>
      <td>MENU</td>
      <td>    <?php
$menu=mysql_query("select *from menu");
while($b=mysql_fetch_array($menu))
{
	echo "<input type='checkbox' name='menu[]' value='$b[name]' >$b[name]<br>";
}?></td>
    </tr>
    <tr>
      <td><input type="submit" name="simpan" id="simpan" value="SIMPAN AKSES"></td>
      <td><input type="reset" name="batal" id="batal" value="Reset"></td>
    </tr>
  </table>
</form>
<datalist id="akses">

</datalist>


<?php 
if(isset($_POST['simpan']))
{
$menu = $_POST['menu'];
$akses= $_POST['akses'];
$jumlah= count($menu);

for($x=0;$x<$jumlah;$x++)
{
	mysql_query("INSERT INTO akses (id,level,menu) values('','$akses','$menu[$x]')");
	echo "<script>alert ('data tersimpan'); document.location='?page=akses_group' </script>";
}
}
?>