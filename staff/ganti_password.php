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
                        <h3 class="box-title">Ganti Password</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="password_lama">PASSWORD LAMA</label>
                            <input type="password" name="password_lama" value="" size="32" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_baru">PASSWORD BARU</label>
                            <input type="password" name="password_baru" value="" size="32" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">KONFIRMASI PASSWORD BARU</label>
                            <input type="password" name="konfirmasi_password" value="" size="32" class="form-control">
                        </div>
                        
                        <input type="submit" value="Update Password" class="btn btn-primary">
                    </div>
                    <input type="hidden" name="MM_update" value="form1">
                    <input type="hidden" name="nim" value="<?php echo $_SESSION['nim']; // asumsi nim disimpan di session ?>">
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</form>

<?php
if(isset($_POST['MM_update'])) {
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    $nim = $_POST['nim'];

    // cek password lama
    $query = "SELECT password FROM admin WHERE nim = '$nim'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] == $password_lama) { // asumsi password tidak di-hash
        if ($password_baru == $konfirmasi_password) {
            $update_query = "UPDATE admin SET password = '$password_baru' WHERE nim = '$nim'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password berhasil diupdate'); </script>";
            } else {
                echo "<script>alert('Error updating password: " . mysqli_error($conn) . "'); </script>";
            }
        } else {
            echo "<script>alert('Password baru dan konfirmasi password tidak cocok'); </script>";
        }
    } else {
        echo "<script>alert('Password lama salah'); </script>";
    }
}
?>