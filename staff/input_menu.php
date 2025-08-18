<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO menu ( name, link, icon, is_active, is_parent, `level`) VALUES ( %s, %s, %s, %s, %s, %s)",
                      
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_POST['icon'], "text"),
                       GetSQLValueString($_POST['is_active'], "text"),
                       GetSQLValueString($_POST['is_parent'], "int"),
                       GetSQLValueString($_POST['level'], "text"));

  $Result1 = mysqli_query($conn, $insertSQL) or die(mysqli_error($conn));
  echo "<script>document.location='?page=menu' </script> ";
}

$menu = mysqli_query($conn, "SELECT * FROM menu where is_parent='0'") or die(mysqli_error($conn));
$row_menu = mysqli_fetch_assoc($menu);
$totalRows_menu = mysqli_num_rows($menu);
?>
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<div class="box-body">
                   
    <div class="form-group">
                      <label for="exampleInputPassword1">NAME</label>
      <td><input type="text" name="name" value="" class="form-control" size="32" /></td>
    </div>
	<div class="form-group">
                      <label for="exampleInputPassword1">LINK</label>
      <td><input type="text" name="link" value="" class="form-control" size="32" /></td>
    </div>
	<div class="form-group">
                      <label for="exampleInputPassword1">ICON</label>
      <td><input type="text" name="icon" value="" class="form-control" size="32" /></td>
    </div>
	<div class="form-group">
                      <label for="exampleInputPassword1">AKTIF</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="is_active" id="optionsRadios1" value="Y" >
                          Yes
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="is_active" id="optionsRadios2" value="N">
                          No
                        </label>
                      </div>
    </div>
	
	
					
	<div class="form-group">
                      <label for="exampleInputPassword1">PARENT</label>
      <td><select name="is_parent" class="form-control">
	  </div>
      <div class="form-group">
      <label for="exampleInputPassword1">LEVEL</label>
	  <option value="0">MENU UTAMA</option>
        <?php 
        do {  
?>
        <option value="<?php echo $row_menu['id']?>" ><?php echo $row_menu['name']?></option>
        <?php
} while ($row_menu = mysqli_fetch_assoc($menu));
?>
      </select></td>
    </div>
    <div class="form-group">
                      <label for="exampleInputPassword1">LEVEL</label>
      <td><input type="text" name="level" class="form-control" value="" size="32" /></td>
    </div>
	</div>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" class="btn btn-primary" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($menu);
?>
</div>
</div>
  </section>
