<?php require_once('../Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO aji_daftar_siswa (jenis_sekolah,kategori,nama_sekolah, kabupaten, alamat, cp_guru, jabatan, keterangan) VALUES (%s, %s, %s,%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['jenis'], "text"),
                       GetSQLValueString($_POST['kategori'], "text"),
					    GetSQLValueString($_POST['sekolah'], "text"),
                       GetSQLValueString($_POST['kabupaten'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['cp_guru'], "text"),
                       GetSQLValueString($_POST['jabatan'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  echo "<script>alert('data tersimpan'); document.location='?page=daftar_siswa' </script>";
}
?>


<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

</script>


<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
 <h1> Input Siswa PMB</h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                 </div><!-- /.box-header -->
				 <!-- form start -->
                        <div class="box-body">
     <div class="form-group">
<label for="exampleInputEmail1">NO</label>
      <input type="text" name="no" readonly value="<?php echo date('mdhs'); ?>" class="form-control" /></td>
   </div>
      <div class="form-group">
<label for="exampleInputEmail1">JENIS SEKOLAH</label>
      <td><label for="jenis"></label>
        <select name="jenis" id="jenis" class="form-control">
          <option value="SMA">SMA</option>
          <option value="SMK">SMK</option>
          <option value="MA">MA</option>
          <option value="SMAN">SMAN</option>
          <option value="SMKN">SMKN</option>
          <option value="MAN">MAN</option>
          <option value="LAINYA">LAINYA</option>
      </select></td>
      </div>
      
    
     <div class="form-group">
<label for="exampleInputEmail1">KATEGORI</label>
      <td><input type="radio" name="kategori" id="rad1" value="Negeri" class="rad"/>  Negeri || <input type="radio" name="kategori" id="rad2" value="Swasta" class="rad"/>  Swasta </td>
   </div>
   
      <div class="form-group">
<label for="exampleInputEmail1">NAMA SEKOLAH</label>
      <div id="form1" style="display:none">
				<select name="sekolah" class="form-control">
				<option value="1">1</option>
				<option value="1">2</option>
				<option value="1">3</option>
                <option value="1">4</option>
                <option value="1">5</option>
				</select>
			</div>
		
		<div id="form2" style="display:none">
				 <input name="sekolah" type="text" class="form-control"/>
			</div>
      </div>
      
      <div class="form-group">
<label for="exampleInputEmail1">KABUPATEN / KOTA</label> 
      <td><label for="kabupaten"></label>
      <input type="text" name="kabupaten" id="kabupaten" class="form-control"></td>
    </div>

 Pilih Provinsi :<br>
<select name="propinsi" id="propinsi">
<option>--Pilih Provinsi--</option>
<?php
//mengambil nama-nama propinsi yang ada di database
$propinsi = mysql_query("SELECT * FROM prov ORDER BY nama_prov");
while($p=mysql_fetch_array($propinsi)){
echo "<option value=\"$p[id_prov]\">$p[nama_prov]</option>\n";
}
?>
</select>
<br>Pilih Kabupaten/Kota :<br>
<select name="kota" id="kota">
<option>--Pilih Kabupaten/Kota--</option>
<?php
//mengambil nama-nama propinsi yang ada di database
$kota = mysql_query("SELECT * FROM kabkot ORDER BY nama_kabkot");
while($p=mysql_fetch_array($propinsi)){
echo "<option value=\"$p[id_kabkot]\">$p[nama_kabkot]</option>\n";
}
?>
</select>

<br>Pilih Kecamatan :<br>
<select name="kec" id="kec">
<option>--Pilih Kecamatan--</option>
</select>
    
       <div class="form-group">
<label for="exampleInputEmail1">ALAMAT</label>
      <td><label for="alamat"></label>
      <textarea name="alamat" id="alamat" cols="45" rows="5" class="form-control"></textarea></td>
    </div>
    
       <div class="form-group">
<label for="exampleInputEmail1">CP GURU</label>
      <td><label for="cp_guru"></label>
      <input type="text" name="cp_guru" id="cp_guru" class="form-control"></td>
   </div>
   
       <div class="form-group">
<label for="exampleInputEmail1">JABATAN</label>
      <td><label for="jabatan"></label>
      <input type="text" name="jabatan" id="jabatan" class="form-control"></td>
    </div>
    
       <div class="form-group">
<label for="exampleInputEmail1">TELEPON</label>
      <td><label for="telp"></label>
      <input type="text" name="telp" id="telp" class="form-control"></td>
    </div>
    
       <div class="form-group">
<label for="exampleInputEmail1">KETERANGAN</label>
      <td><label for="keterangan"></label>
      <textarea name="keterangan" id="keterangan" cols="45" rows="5" class="form-control"></textarea></td>
    </div>
    <tr><td><input name="simpan" type="submit" value="SIMPAN DATA" class="btn btn-primary"> </td><td><input name="batal" type="reset" value="BATAL" class="btn btn-warning"> </td></tr>
  </table>
  <input type="hidden" name="MM_insert" value="form">
</form>

<!-- tambahkan jquery-->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$(":radio.rad").click(function(){
					$("#form1, #form2").hide()
					if($(this).val() == "Negeri"){
						$("#form1").show();
					}else{
						$("#form2").show();
					}
				});
			});
		</script>
        
        
