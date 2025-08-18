<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value;
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('txt3').value = result;
      }
}
</script>
 <section class="content-header">         
              
       
        
    <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Input Menu</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
<form method="post" action="">
<div class="box-body">
<div class="form-group">
                      <label for="exampleInputPassword1">Aplikasi</label>
    <td><select name="app" class="form-control">
        <option value="United Tronik">United Tronik</option>
        <option value="Pay Trend">Pay Trend</option>
        </select>
</div>
<div class="form-group">
                      <label for="exampleInputPassword1">Tanggal</label>
                      <input type="date" name="tgl_beli" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">ID PELANGGAN</label>
                      <input type="text" name="idpel" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" name="nama" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">Daya</label>
                      <input type="text" name="daya" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">Periode</label>
                      <input type="text" name="periode" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">Stand Meter</label>
                      <input type="text" name="meter" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">Tagihan</label>
                      <input type="text" name="tagihan" id="txt1" onkeyup="sum();" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">Biaya Admin</label>
        <td><select name="admin" class="form-control" id="txt2" onkeyup="sum();">
        	<option value="3500">Rp. 3.500</option>
        	<option value="7000">Rp. 7.000</option>
        </select></div>
<div class="form-group">
                      <label for="exampleInputPassword1">Total</label>
                      <input type="text" name="total" id="txt3" class="form-control">
                      </div>
<div class="form-group">
                      <label for="exampleInputPassword1">JPA Ref</label>
                      <input type="text" name="jpa" class="form-control">
                      </div>
                      </div>
<tr><td><input type="submit" value="Proses" class="btn btn-primary" name="proses"></td><td><input type="reset" class="btn btn-warning" value="Batal"></td></tr>
</table>
</form>
</div>
</div>

<?php
if(isset($_POST['proses']))
{
	$simpan=mysql_query("insert into pln (aplikasi,tgl_beli,idpel,nama,daya,periode,meter,admin,tagihan,total)
		               values ('$_POST[app]','$_POST[tgl_beli]','$_POST[idpel]','$_POST[nama]','$_POST[daya]','$_POST[periode]','$_POST[meter]','$_POST[admin]','$_POST[tagihan]','$_POST[total]')") or die(mysql_error());
	echo "<script>alert('Data Tersimpan');document.location='?page=bayar-pln' </script>";
}
?>
 </section>