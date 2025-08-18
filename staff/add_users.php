<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah User Baru</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <input type="text" name="nik" class="form-control" id="exampleInputEmail1" placeholder="NIK">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap">
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>

<?php
if(isset($_POST['simpan'])) {
  $nik = $_POST['nik'];
  $password = $_POST['password'];
  $nama_lengkap = $_POST['nama_lengkap'];

  $query = "INSERT INTO admin (nik, password, nama_lengkap) VALUES('$nik', '$password', '$nama_lengkap')";
  $result = mysqli_query($conn, $query);

  if ($result) {
      echo "<script>alert('Data berhasil disimpan'); document.location='?page=users' </script>";
  } else {
      echo "<script>alert('Error: Gagal disimpan'); document.location='?page=users' </script>";
  }
}
?>

