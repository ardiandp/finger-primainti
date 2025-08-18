<form method="post" action="">
    <table width="364" border=1>
        <tr>
            <td width="107">LEVEL</td>
            <td width="241">
                <select name="level">
                    <?php
                    $akses = mysqli_query($conn, "select * from level where id_level='" . $_GET['id'] . "' ");
                    while ($a = mysqli_fetch_assoc($akses)) {
                        echo "<option value='" . $a['id_level'] . "'>" . $a['level'] . " </option>";
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Menu </td>
            <td>
                <?php
                $parent = mysqli_query($conn, "select * from menu where is_parent='0' ");
                while ($p = mysqli_fetch_assoc($parent)) {
                ?>
                    <b><input type="checkbox" name="menu[]" value="<?php echo $p['id'] ?>" /><?php echo $p['name'] ?> </b><br />

                    <?php
                    $sub = mysqli_query($conn, "select * from menu where is_parent='" . $p['id'] . "' ");
                    while ($s = mysqli_fetch_assoc($sub)) {
                    ?>
                        <input type="checkbox" name="menu[]" value="<?php echo $s['id'] ?>" /><?php echo $s['name'] ?> <br />

                <?php }
                } ?>


            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Simpan" name="simpan"></td>
        </tr>
    </table>
</form>


<?php
if (isset($_POST['simpan'])) {
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