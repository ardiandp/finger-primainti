
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6"> 
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">Judul Vidio</h3>
            </div>
            <!-- /.box-header -->
          <video id="example_video_1" class="video-js vjs-default-skin"
  controls preload="auto" width="500" height="350"//tentukan tinggi dan lebar video player
  poster="http://video-js.zencoder.com/oceans-clip.png"//cover video pada tampilan awal sebelum video play
  data-setup='{"example_option":true}'>
 <source src="../upload/vidio/aku cah kerjo.mp4" type='video/mp4' />//isi dengan directori video yang ingin diputar(mp4)
 <source src="../upload/vidio/aku cah kerjo.webm" type='video/webm' />//isi dengan directori video yang ingin diputar(webm)
 <source src="../upload/vidio/aku cah kerjo.ogv" type='video/ogg' />//isi dengan directori video yang ingin diputar(ogv)
 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
</video>
            <!-- /.box-body -->
          
          </div>
          <!-- /.box -->

       
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6"><div id="thanks"><p><a href="?page=input_vidio" class="btn btn-primary">Upload Vidio</a></p></div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Film</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                  <th style="width: 10px">No</th>
                  <th>Judul</th>
                  <th>kategori</th>
                  <th style="width: 40px">Aksi</th>
                 </tr>
   </thead>
                    <tbody>
				<?php 
				$film=mysql_query("select *from vidio");
				$no=1;
				while($data=mysql_fetch_array($film))
				{ ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $data['judul'] ?></td>
                  <td><?php echo $data['kategori'] ?> </td>
                  <td><a href="?page=view_vidio&id=<?php echo $data['id']?> "> Play </td>
                </tr>
                <?php $no++;} ?>
              </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     
    </section>
    <!-- /.content -->
  </div>


