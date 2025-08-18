<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="bootstraps/js/jquery.min.js"></script>
  <script src="bootstraps/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Data Mahasiswa PMB</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#all">Data Siswa PMB</a></li>
    <li><a data-toggle="tab" href="#negeri">Siswa Negeri</a></li>
    <li><a data-toggle="tab" href="#swasta">Siswa Swasta</a></li>
   
  </ul>

  <div class="tab-content">
    <div id="all" class="tab-pane fade in active">
    <!-- awal tab -->
      <h3>Data Seluruh Siswa</h3>
      <a href="?page=input_siswa_psb" class="btn btn-warning">INPUT SISWA PMB </a>
       <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr> 
     <th>JENIS</th>
     <th>KATEGORI</th>
     <th>NAMA SEKOLAH</th>
     <th>KABUPATEN</th>
     <th>HP / TELP</th>
     <th>AKSI</th>
     
  </tr>
                    </thead>
                    <tbody>
<?php
$mt=mysql_query("select *from aji_daftar_siswa");
while($s=mysql_fetch_array($mt))
{ ?>
 <tr>
      <td><?php echo $s['jenis_sekolah']; ?></td>
      <td><?php echo $s['kategori']; ?></td>
      <td><?php echo $s['nama_sekolah']; ?></td>
      <td><?php echo $s['kabupaten'] ?> </td>
       <td><?php echo $s['hp'] ?> </td>
      
      <td><a href="?page=del_siswa_pmb&no=<?php echo $s['no']; ?>">Del</a><a href="?page=edit_siswa_psb&no=<?php echo $s['no']; ?>">Edit</a></td>
    </tr>
   <?php } ?>
</tbody>                   
                  </table>      
    </div>
    <!-- akhir tab pertama -->
    
    <div id="negeri" class="tab-pane fade">
    <h3>Data Siswa Negeri</h3>
      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr> 
     <th>JENIS</th>
     <th>KATEGORI</th>
     <th>NAMA SEKOLAH</th>
     <th>KABUPATEN</th>
     <th>HP / TELP</th>
     <th>AKSI</th>
     
  </tr>
                    </thead>
                    <tbody>
<?php
$mt=mysql_query("select *from aji_daftar_siswa where kategori='Negeri'");
while($s=mysql_fetch_array($mt))
{ ?>
 <tr>
      <td><?php echo $s['jenis_sekolah']; ?></td>
      <td><?php echo $s['kategori']; ?></td>
      <td><?php echo $s['nama_sekolah']; ?></td>
      <td><?php echo $s['kabupaten'] ?> </td>
       <td><?php echo $s['hp'] ?> </td>
      
      <td><a href="?page=del_siswa_pmb&no=<?php echo $s['no']; ?>">Del</a><a href="?page=edit_siswa_psb&no=<?php echo $s['no']; ?>">Edit</a></td>
    </tr>
   <?php } ?>
</tbody>                   
                  </table>
               
              
    </div>
    <div id="swasta" class="tab-pane fade">
    <h3>Data Siswa Swasta</h3>
       <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr> 
     <th>JENIS</th>
     <th>KATEGORI</th>
     <th>NAMA SEKOLAH</th>
     <th>KABUPATEN</th>
     <th>HP / TELP</th>
     <th>AKSI</th>
     
  </tr>
                    </thead>
                    <tbody>
<?php
$mt=mysql_query("select *from aji_daftar_siswa where kategori='Swasta' ");
while($s=mysql_fetch_array($mt))
{ ?>
 <tr>
      <td><?php echo $s['jenis_sekolah']; ?></td>
      <td><?php echo $s['kategori']; ?></td>
      <td><?php echo $s['nama_sekolah']; ?></td>
      <td><?php echo $s['kabupaten'] ?> </td>
       <td><?php echo $s['hp'] ?> </td>
      
      <td><a href="?page=del_siswa_pmb&no=<?php echo $s['no']; ?>">Del</a><a href="?page=edit_siswa_psb&no=<?php echo $s['no']; ?>">Edit</a></td>
    </tr>
   <?php } ?>
</tbody>                   
                  </table>
    </div>
   
  </div>
</div>

</body>
</html>