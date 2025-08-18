<?php
$colname_edit = $_GET['id'];
$query_edit = "SELECT * FROM menu WHERE id = '$colname_edit'";
$edit = mysqli_query($conn, $query_edit) or die(mysqli_error($conn));
$row_edit = mysqli_fetch_assoc($edit);

$query_menu = "SELECT * FROM menu where is_parent='0'";
$menu = mysqli_query($conn, $query_menu) or die(mysqli_error($conn));
?>

<section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Menu</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="post" name="form1" id="form1">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="id">Id</label>
                      <input type="text" class="form-control" id="id" name="id" value="<?php echo $row_edit['id']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $row_edit['name']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="link">Link</label>
                      <input type="text" class="form-control" id="link" name="link" value="<?php echo $row_edit['link']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="icon">Icon</label>
                      <input type="text" class="form-control" id="icon" name="icon" value="<?php echo $row_edit['icon']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="is_active">Is_active</label>
                      <input type="text" class="form-control" id="is_active" name="is_active" value="<?php echo $row_edit['is_active']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="is_parent">Is_parent</label>
                      <select class="form-control" name="is_parent">
                        <option value="0">MENU UTAMA</option>
                        <?php 
                        while ($row_menu = mysqli_fetch_assoc($menu)) {
                        ?>
                        <option value="<?php echo $row_menu['id']?>" <?php if ($row_menu['id']==$row_edit['is_parent']) {echo "SELECTED";} ?>><?php echo $row_menu['name']?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="level">Level</label>
                      <input type="text" class="form-control" id="level" name="level" value="<?php echo $row_edit['level']; ?>">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" name="update" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div>
          </div>
        </section>

  <?php 
  if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $is_active = $_POST['is_active'];
    $is_parent = $_POST['is_parent'];
    $level = $_POST['level'];
    $query_update = "UPDATE menu SET name='$name', link='$link', icon='$icon', is_active='$is_active', is_parent='$is_parent', level='$level' WHERE id='$id'";
    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));
   //header("location:menu.php");
   if($update){
    echo "<script>alert('Data Berhasil Diupdate'); window.location = '?page=menu';</script>";
   }
  }
  ?>

