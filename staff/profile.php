<?php
$profile=mysqli_query($conn,"select *from datadiri where nim='$_SESSION[MM_Username]' ");
$data=mysqli_fetch_array($profile);
?>
	
	
    <!-- Main content -->
    <section class="content">
	 <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <center><img class="profile-user-img img-responsive img-circle" src="../uploads/foto/<?php echo $data['foto'] ?>" width="150" height="150" alt="User profile picture"> </center>

              <h3 class="profile-username text-center"><?php echo $data['nama_lengkap'] ?></h3>

              <p class="text-muted text-center"><?php echo $data['nim'] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Belum Dibaca</b> <a class="pull-right">12</a>
                </li>
                <li class="list-group-item">
                  <b>Pesan Masuk</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Jabatan</b> <a class="pull-right">Dosen</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                <?php echo $data['pendidikan'] ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $data['alamat'] ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#log" data-toggle="tab">Log Aktifitas</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../foto/<?php echo $data['foto'] ?>" width="50" height="50" alt="user image">
                        <span class="username">
                          <a href="#"><b>Jonathan Burke Jr.</b></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
                <br>            
              </div>
			  
			  
              <!-- /.tab-pane -->
              <div class="tab-pane" id="log">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                        Log Aktifitas
                        </span>
                  </li>

                  isi
				  </ul>			  
			  </div>
				  
			
              
              
				   
           
			  
			  
			  

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">NIM / NIK</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['nim'] ?>" class="form-control" id="inputName" name="nik" placeholder="Input Username Atau nik Anda">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['nama_lengkap'] ?>" class="form-control" id="inputEmail" placeholder="Nama lengkap" name="nama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tempat Lahir</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['tempat_lahir'] ?>" class="form-control" id="inputName" placeholder="Tempat Lahir" name="tempat_lahir">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Tanggal Lahir</label>

                    <div class="col-sm-10">
                      <input type="date" value="<?php echo $data['tanggal_lahir'] ?>" class="form-control" id="inputName" placeholder="Tanggal Lahir" name="tanggal_lahir">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">No Telephone</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['no_telp'] ?>" class="form-control" id="inputSkills" placeholder="No Telephone" name="no_telp">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Keahlian</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['keahlian'] ?>" class="form-control" id="inputSkills" placeholder="keahlian" name="keahlian">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Pendidikan Terakhir</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?php echo $data['pendidikan'] ?>" class="form-control" id="inputSkills" placeholder="Pendidikan" name="pendidikan">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Alamat</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Alamat Lengkap Anda" name="alamat"><?php echo $data['alamat'] ?></textarea>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Blokir</label>

                    <div class="col-sm-10">
                      <input type="text" readonly value="<?php echo $data['status'] ?>" class="form-control" name="status" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Foto</label>

                    <div class="col-sm-10">
                      <input type="file" name="foto" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
				  
				  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                     <input type="submit" value="Update Data" name="update-data" class="btn btn-danger"> 
					  
			 
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
          </section>
	  
	  <?php
	  if(isset($_POST['update-data']))
	  {
      $foto="foto-";
$nik=$_POST['nik'];
$ext=".jpg";
$filename=$_FILES['foto']['name'];
$nama_file_unix=$foto.$nik.$ext;


$move=move_uploaded_file($_FILES['foto']['tmp_name'],'../uploads/foto/'.$nama_file_unix);
      $update=mysqli_query($conn, "update datadiri set nama_lengkap='$_POST[nama]',tempat_lahir='$_POST[tempat_lahir]',tanggal_lahir='$_POST[tanggal_lahir]',
                                               no_telp='$_POST[no_telp]',keahlian='$_POST[keahlian]',pendidikan='$_POST[pendidikan]',
                                               alamat='$_POST[alamat]',status='$_POST[status]',foto='$nama_file_unix' where nim='$nik' ") or die (mysqli_error($conn));
		  $updateAdmin=mysqli_query($conn, "update admin set nama_lengkap='$_POST[nama]',no_telp='$_POST[no_telp]',gambar='$nama_file_unix' where nim='$nik' ") or die (mysqli_error($conn));
      
//awal log atifitas
$username=$_SESSION['MM_Username'];

$waktu=date('Y-m-d H:i:s');
$keterangan="melakukan Update profil Pada $waktu";
$hari=$hari_ini;
$logact=mysqli_query($conn, "insert into log_aktifitas (username,keterangan,hari,waktu) values ('$username','$keterangan','$hari','$waktu')") or die (mysqli_error($conn));
//akhir simpan log
    echo "<script> alert('succss'); document.location='?page=profile' </script>";
	  }
	  ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
       