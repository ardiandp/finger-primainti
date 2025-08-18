<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $stmt = mysqli_prepare($conn, "UPDATE `admin` SET password=?, nama_lengkap=?, inisial=?, email=?, no_telp=?, `id_level`=?, blokir=?, gambar=? WHERE nik=?");
    mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['password'], $_POST['nama_lengkap'], $_POST['inisial'], $_POST['email'], $_POST['no_telp'], $_POST['level'], $_POST['blokir'], $_POST['gambar'], $_POST['nik']);
    mysqli_stmt_execute($stmt);
    
    $datadiri = mysqli_query($conn, "update datadiri set nama_lengkap='" . $_POST['nama_lengkap'] . "',status='" . $_POST['blokir'] . "' where nik='" . $_POST['nik'] . "' ") or die(mysqli_error($conn));
    echo "<script>document.location='?page=users' </script>";
}

$colname_edit = "-1";
if (isset($_GET['nik'])) {
    $colname_edit = $_GET['nik'];
}
$query_edit = "SELECT * FROM `admin` WHERE nik = ?";
$stmt = mysqli_prepare($conn, $query_edit);
mysqli_stmt_bind_param($stmt, "s", $colname_edit);
mysqli_stmt_execute($stmt);
$edit = mysqli_stmt_get_result($stmt);
$row_edit = mysqli_fetch_assoc($edit);

$query_level = "SELECT * FROM `level`";
$level = mysqli_query($conn, $query_level) or die(mysqli_error($conn));
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Users</h3>
                </div>
                <form action="" method="post" name="form1" id="form1">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">nik</label>
                            <input type="text" name="nik" class="form-control" value="<?php echo htmlentities($row_edit['nik'], ENT_COMPAT, 'utf-8'); ?>" size="32" disabled />
                            <input type="hidden" name="nik" value="<?php echo htmlentities($row_edit['nik'], ENT_COMPAT, 'utf-8'); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo htmlentities($row_edit['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlentities($row_edit['nama_lengkap'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
                        </div>
                        <!-- form group lainnya -->
                        <div class="form-group">
                            <label for="exampleInputPassword1">Level</label>
                            <select name="level" class="form-control">
                                <?php while ($row_level = mysqli_fetch_assoc($level)) { ?>
                                    <option value="<?php echo $row_level['id_level'] ?>" <?php if (!(strcmp($row_level['id_level'], htmlentities($row_edit['id_level'], ENT_COMPAT, 'utf-8')))) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $row_level['level'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Blokir</label>
                            <select name="blokir" class="form-control">
                                <option value="Y" <?php if ($row_edit['blokir'] == 'Y') echo 'selected'; ?>>Y</option>
                                <option value="N" <?php if ($row_edit['blokir'] == 'N') echo 'selected'; ?>>N</option>
                            </select>
                        </div>
                        <input type="submit" value="Update record" class="btn btn-primary" />
                    </div>
                    <input type="hidden" name="MM_update" value="form1" />
                </form>
            </div>
        </div>
    </div>
</section>