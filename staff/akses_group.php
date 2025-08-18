
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

mysql_select_db($database_koneksi, $koneksi);
$query_akses = "SELECT akses.id,akses.id_level,akses.menu,level.level,menu.name from akses,level,menu where akses.id_level=level.id_level AND akses.menu=menu.id";
$akses = mysql_query($query_akses, $koneksi) or die(mysql_error());
$row_akses = mysql_fetch_assoc($akses);
$totalRows_akses = mysql_num_rows($akses);
?>
<h1>
            DATA AKSES MENU
            
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                 <div class="box-body"><a href=?page=add_group_menu><input type="button" value="Tambah Akses" class="btn btn-success"> </a>
                  <div class="box-tools">
                    <div class="input-group">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                 <table border="1">
  <tr>
    <td>id</td>
    <td>id_level</td>
    <td>menu</td>
    <td>level</td>
    <td>name</td>
    <td>del</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_akses['id']; ?></td>
      <td><?php echo $row_akses['id_level']; ?></td>
      <td><?php echo $row_akses['menu']; ?></td>
      <td><?php echo $row_akses['level']; ?></td>
      <td><?php echo $row_akses['name']; ?></td>
      <td><a href="?page=del_akses&id=<?php echo $row_akses['id']; ?>">Del</a></td>
    </tr>
    <?php } while ($row_akses = mysql_fetch_assoc($akses)); ?>
</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>