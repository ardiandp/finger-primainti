<?php



// Cek apakah ada filter tanggal
$tglawal = $_POST['tglawal'] ?? null;
$tglakhir = $_POST['tglakhir'] ?? null;

if ($tglawal && $tglakhir) {
    $query = "SELECT nik, nama, tanggal, jam_masuk_awal, jam_keluar_akhir from rekap_absensi_finger 
              WHERE tanggal BETWEEN ? AND ? 
              ORDER BY tanggal ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $tglawal, $tglakhir);
} else {
    $query = "SELECT nik, nama, tanggal, jam_masuk_awal, jam_keluar_akhir from rekap_absensi_finger 
              ORDER BY tanggal ASC";
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) { ?>


 <section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header with-border bg-blue">
                  <h3 class="box-title">Rekap Absensi Finger Print</h3>
                  <div class="box-tools pull-right">
                    <a href="?page=import_fp_to_excel" class="btn btn-success btn-sm">Import Absensi Excel</a>
                  </div>
                </div><!-- /.box-header -->
               
                <div class="box-body">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tglawal" class="form-control" value="<?= $tglawal ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tglakhir" class="form-control" value="<?= $tglakhir ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Jam Masuk Awal</th>
                        <th>Jam Keluar Akhir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nomor = 1; while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $nomor ?></td>
                            
                            <td><?= $row["nik"] ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td><?= $row["tanggal"] ?></td>
                            <td><?= getHariFromTanggal($row["tanggal"]) ?></td>
                            <td><?= $row["jam_masuk_awal"] ?></td>
                            <td><?= $row["jam_keluar_akhir"] ?></td>
                        </tr>
                    <?php $nomor++; endwhile; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<?php } else { ?>
    
    
 <section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header with-border bg-blue">
                  <h3 class="box-title">Rekap Absensi Finger Print</h3>
                  <div class="box-tools pull-right">
                    <a href="?page=import_fp_to_excel" class="btn btn-success btn-sm">Import Absensi Excel</a>
                  </div>
                </div><!-- /.box-header -->
               
                <div class="box-body">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tglawal" class="form-control" value="<?= $tglawal ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tglakhir" class="form-control" value="<?= $tglakhir ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Jam Masuk Awal</th>
                        <th>Jam Keluar Akhir</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<?php }

?>