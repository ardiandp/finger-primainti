<!DOCTYPE html>
<?php
session_start();
include ('../Connections/koneksi.php');
include ('../Connections/library.php');
include ('../Connections/ip.php');
$set = mysqli_query($conn, "SELECT * FROM setting WHERE aktif='Y'");
$setting = mysqli_fetch_array($set);
if(empty($_SESSION['MM_Username']) and empty($_SESSION['password']))
{
  echo "<script>alert('no access'); document.location='../index.php' </script>";
}
else
{ ?>
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $setting['title'] ?></title>
     <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">

    <!-- untk upload popup vidio -->



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <body class="skin-blue fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <a href="media.php?page=home" class="logo"><?php echo $setting['nama1'] ?></a>
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
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../upload/foto/<?php echo $_SESSION['foto'] ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $_SESSION['nama_lengkap'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../upload/foto/<?php echo $_SESSION['foto'] ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $_SESSION['nama_lengkap'] ?> - <?php echo $_SESSION['MM_Username'] ?>
                      <small><?php echo $_SESSION['level'] ?></small>
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
                      <a href="?page=profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../upload/foto/<?php echo $_SESSION['foto'] ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nama_lengkap'] ?></p>

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
//$conn = mysqli_connect('localhost', 'your_username', 'your_password', 'your_database');
$main = mysqli_query($conn, "SELECT `level`.`level`,admin.nama_lengkap,admin.nim,akses.id_level,akses.menu,menu.`name`,menu.id,menu.icon from `level` join admin on admin.`id_level`=`level`.id_level join akses on admin.`id_level`=akses.id_level join menu on akses.menu=menu.id WHERE menu.is_parent='0' and admin.nim='$_SESSION[MM_Username]'");
while($r = mysqli_fetch_array($main))
{?>
            <li class="treeview">

			   <a href="">
         <i class="<?php echo $r['icon']?>"></i><span><?php echo" $r[name] ";?></span></a>


			  <ul class="treeview-menu">
<?php
$sub = mysqli_query($conn, "SELECT `level`.`level`,admin.nama_lengkap,admin.nim,akses.id_level,akses.menu,menu.`name`,menu.link,menu.icon from `level` join admin on admin.`id_level`=`level`.id_level join akses on admin.`id_level`=akses.id_level join menu on akses.menu=menu.id WHERE menu.is_parent='$r[id]'  and admin.nim='$_SESSION[MM_Username]'");
while($w = mysqli_fetch_array($sub))
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

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- awal konten -->
        <?php include ('content.php') ?>

		<!-- akhir kontent -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b><?php echo $setting['versi'] ?></b>
        </div>
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href=""><?php echo $setting['nama2'] ?></a>.</strong> All rights reserved.
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
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js" type="text/javascript"></script>
	<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>

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
<?php
/*
$bipres = mysqli_query($conn, "SELECT thn_bpres, COUNT(nim) AS jumlah FROM `bpres-data_diri` group by thn_bpres") or die(mysqli_error($conn));
while($bp=mysqli_fetch_array($bipres))
{
  $viewbp[]=$bp;
}

$pdd=mysqli_query($conn, "SELECT jenjang_pendidikan as pendidikan, COUNT(nim) as jumlah FROM `bpres-data_diri` GROUP BY jenjang_pendidikan") or die(mysqli_error($conn));
while($pd=mysqli_fetch_array($pdd))
{
  $viewpd[]=$pd;
}

$kampus=mysqli_query($conn, "SELECT kampus as label, COUNT(nim) as value FROM `bpres-data_diri` GROUP BY kampus") or die(mysqli_error($conn));
while($k=mysqli_fetch_array($kampus))
{
  $viewkampus[]=$k;
} */
?>


  </body>
</html>



 <!-- Morris charts -->
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
           <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        "use strict";

         // AREA CHART
        var area = new Morris.Area({
          element: 'revenue-chart',
          resize: true,
          data: <?php echo json_encode($viewbp) ; ?> ,
          xkey: '0',
          ykeys: ['Tahun', 'jumlah'],
          labels: ['Tahun', 'jumlah'],
          lineColors: ['#a0d0e0', '#3c8dbc'],
          hideHover: 'auto'
        });


        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
           
          ],

          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });

        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954","#f23454","#0000FF","#DC143C","#006400","#8B0000"],
          
          data: <?php echo json_encode($viewkampus) ; ?>,
          hideHover: 'auto'
        });



        //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
         
          data: <?php echo json_encode($viewpd) ; ?>,
          barColors: ['#00a65a','#f56954'],
          xkey: '0',
          ykeys: ['jumlah'],
          labels: ['jumlah'],
          hideHover: 'auto'
        });
      });
    </script>



<?php } ?>