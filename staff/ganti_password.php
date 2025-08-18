
<form method="post" name="form1" action="">

 <section class="content-header">     
          
        </section>
    
  <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-10">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h1 class="box-title">Ganti Password</h1>
                </div><!-- /.box-header -->
                <!-- form start -->
   <div class="form-group">
<label for="exampleInputEmail1">PASSWORD LAMA</label>
      <td><input type="text" name="password" value="" size="32" class="form-control"></td>
   </div>
   <div class="form-group">
<label for="exampleInputEmail1">PASSWORD BARU</label>
      <td><input type="text" name="nama_lengkap" value="" size="32" class="form-control"></td>
   </div>
   <div class="form-group">
<label for="exampleInputEmail1">PASSWORD BARU</label>
      <td><input type="text" name="email" value="" size="32" class="form-control"></td>
    </div>
    

    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" class="btn btn-primary"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="nim" value="<?php echo $row_Recordset1['nim']; ?>">
</form>
<p>&nbsp;</p>
</div></div></div></section>
<?php
if(isset($_POST['MM_update']))
{
  echo "<script>alert('codin belum ada'); </script>";
}
?>