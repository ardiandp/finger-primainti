<?php
session_start();
include ('../Connections/koneksi.php');
//include ('../Connections/fungsi_indotgl.php');
include ('../Connections/library.php');
//include ('../Connections/getGeoIP.freegeoip.net.php');
if (empty($_SESSION['MM_Username']))
{
	echo "<script>document.location='../index.php' </script> ";
}
else
{



include ('../Connections/ip.php');
include ('../Connections/getGeoIP.freegeoip.net.php');
  $ip='127.0.0.1'; // Ip address yang ingin di cek
  $userGeoData = getGeoIP($ip);
$setting=mysql_query("select *from setting where aktif='Y' ");
   $data=mysql_fetch_array($setting);
	?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>== <?php echo $data['nama2'] ?> ==</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="../bootstrap/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
      <link rel="stylesheet" href="../bootstrap/ionicons-2.0.1/css/ionicons.min.css">
    <!-- DATA TABLES -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

	<!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->



    <!-- include chart 
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/css/ilmudetil.css">
  <script src="../bootstrap/js/jquery-1.10.1.min.js"></script> -->
  <script src="../bootstrap/js/highcharts.js"></script>



    <!-- selesai Chart -->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
    <!-- navigasi fixed  class="navbar navbar-inverse navbar-fixed-top" -->
      <header class="main-header">
        <a href="?page=home" class="logo"><b><?php echo $data['nama1'] ?></b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
									<?php
									$jm=mysql_query("select *from pesan inner join admin on pesan.pengirim=admin.nim and pesan.penerima='$_SESSION[MM_Username]'
									 and pesan.baca='0'");
									$jum=mysql_num_rows($jm); ?>
                  <span class="label label-success"><?php echo $jum ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $jum ?>messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">


											<?php
												while($p=mysql_fetch_array($jm))
												{ ?>

                      <li>
                        <a href="?page=baca_pesan&id=<?php echo $p['id']?>">
                          <div class="pull-left">
                            <img src="../foto/<?php echo $p['gambar'] ?>" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                             <?php echo $p['nama_lengkap'] ?>
                            <small><i class="fa fa-clock-o"></i> <?php echo $p['tanggal'] ?></small>
                          </h4>
                          <p> <?php echo $p['subject'] ?></p>
                        </a>
                      </li>
<?php } ?>

                    </ul>
                  </li>
                  <li class="footer"><a href="?page=pesan_masuk">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
									<?php
									$notif=mysql_query("select *from informasi where new='Y'");
									$j=mysql_num_rows($notif);
									 ?>
                  <span class="label label-warning"><?php echo $j ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $j ?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
											<?php
											while($i=mysql_fetch_array($notif))
											{?>
                      <li>
                        <a href="?page=view_informasi&id=<?php echo $i['id_informasi']?>">
                          <i class="fa fa-shopping-cart text-green"></i> <?php echo $i['judul'] ?>
                        </a>
                      </li>
   <?php } ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>

									<?php
								  $rekap=mysql_query("select *from jadwal_asisten where hari='$hari_ini' ");
									$jumlah=mysql_num_rows($rekap);
									?>

                  <span class="label label-danger"><?php echo $jumlah ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">

											<?php
											while($r=mysql_fetch_array($rekap))
											{
											?>
											<li><!-- Task item -->
                        <a href="#">
                          <h3>
                          <?php echo $r['kelas'] ?> || <?php echo $r['jam'] ?> || <?php echo $r['kode'] ?>
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
<?php } ?>



                    </ul>
                  </li>
                  <li class="footer">
                    <a href="?page=jadwal_asisten">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../foto/<?php echo $_SESSION['foto']?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $_SESSION['nama_lengkap'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../foto/<?php echo $_SESSION['foto'] ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $_SESSION['nama_lengkap'] ?>
                      <small><?php  echo $_SESSION['MM_Username'] ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../foto/<?php echo $_SESSION['foto']?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nama_lengkap']?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

<!-- awal menu -->
<?php
$main=mysql_query("SELECT `level`.`level`,admin.nama_lengkap,admin.nim,akses.id_level,akses.menu,menu.`name`,menu.id,menu.icon from `level`,admin,akses,menu WHERE admin.`level`=`level`.id_level AND admin.`level`=akses.id_level AND akses.menu=menu.id AND menu.is_parent='0' and admin.nim='$_SESSION[MM_Username]' ");
while($r=mysql_fetch_array($main))
{?>
            <li class="treeview">

			   <a href="">
         <i class="<?php echo $r['icon']?>"></i><span><?php echo" $r[name] ";?></span></a>


			  <ul class="treeview-menu">
<?php
$sub=mysql_query("SELECT `level`.`level`,admin.nama_lengkap,admin.nim,akses.id_level,akses.menu,menu.`name`,menu.link,menu.icon from `level`,admin,akses,menu WHERE admin.`level`=`level`.id_level AND admin.`level`=akses.id_level AND akses.menu=menu.id AND menu.is_parent='$r[id]'  and admin.nim='$_SESSION[MM_Username]'");
while($w=mysql_fetch_array($sub))
                   {?>

			    <li><a href="<?php echo $w['link']?>">
         <i class="<?php echo $w['icon']?>"></i><span><?php echo" $w[name] ";?></span></a> </li>

			   <?php } ?>

			  </ul>
  <?php } ?> </li>


<!--akhir menu-->










        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
		<!-- awal isi konten -->





	<?php	 include ('content.php'); ?>







		<!-- akhir isi konten -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b><?php echo $data['versi'] ?></b>
        </div>
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="http://tutorialcoding.wordpress.com"><?php echo $data['nama2'] ?></a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>




      

  </body>
</html>
<?php } ?>
