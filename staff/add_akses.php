<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Akses Level</h3>
                </div><!-- /.box-header -->
                <form method="post" action="">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level">
                                <?php
                                $akses = mysqli_query($conn, "select * from level where id_level='" . $_GET['id'] . "' ");
                                while ($a = mysqli_fetch_assoc($akses)) {
                                    echo "<option value='" . $a['id_level'] . "'>" . $a['level'] . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu</label>
                            <?php
                            $level_id = $_GET['id'];
                            $parent = mysqli_query($conn, "select * from menu where is_parent='0' ");
                            while ($p = mysqli_fetch_assoc($parent)) {
                                $checked_parent = mysqli_num_rows(mysqli_query($conn, "select * from akses where id_level='$level_id' and menu='$p[id]'")) > 0 ? 'checked' : '';
                                echo "<div>";
                                echo "<label>";
                                echo "<input type='checkbox' name='menu[]' value='" . $p['id'] . "' $checked_parent>";
                                echo "<b>" . $p['name'] . "</b>";
                                echo "</label>";
                                
                                $sub = mysqli_query($conn, "select * from menu where is_parent='" . $p['id'] . "' ");
                                if (mysqli_num_rows($sub) > 0) {
                                    echo "<div style='margin-left:20px;'>";
                                    while ($s = mysqli_fetch_assoc($sub)) {
                                        $checked_sub = mysqli_num_rows(mysqli_query($conn, "select * from akses where id_level='$level_id' and menu='$s[id]'")) > 0 ? 'checked' : '';
                                        echo "<div class='checkbox'>";
                                        echo "<label><input type='checkbox' name='menu[]' value='" . $s['id'] . "' $checked_sub>" . $s['name'] . "</label>";
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                }
                                echo "</div>";
                            } ?>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])) {
        mysqli_query($conn, "delete from akses where id_level='" . $_POST['level'] . "'");
        
        $level = $_POST['level'];
        $menu = $_POST['menu'];
        $jml = count($menu);

        for ($a = 0; $a < $jml; $a++) {
            $stmt = mysqli_prepare($conn, "insert into akses (id_level, menu) values (?, ?)");
            mysqli_stmt_bind_param($stmt, "ii", $level, $menu[$a]);
            mysqli_stmt_execute($stmt);
        }
        echo "<script>document.location='?page=akses'</script>";
    }
    ?>
</section>