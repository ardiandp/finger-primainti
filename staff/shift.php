<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? null;
    $masuk = $_POST['masuk'] ?? null;
    $pulang = $_POST['pulang'] ?? null;
    $total_jam = $_POST['total_jam'] ?? null;

    $stmt = $conn->prepare("INSERT INTO shift (nama, masuk, pulang, total_jam) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama, $masuk, $pulang, $total_jam);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!');window.location='?page=shift';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<?php
$query = "SELECT id, nama, masuk, pulang, total_jam 
          FROM shift 
          ORDER BY nama ASC";
$result = $conn->query($query);
if ($result->num_rows > 0) {
?>


 <section class="content-header">     	
		<section class="content">
          <div class="row">
            <div class="col-xs-12">
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
			  Tambah Shift
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header" style="background-color: green; color: white;">
			        <h5 class="modal-title" id="exampleModalLabel">Tambah Shift</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form action="" method="post">
			        	<div class="form-group">
			        		<label for="nama">Nama Shift</label>
			        		<input type="text" name="nama" class="form-control">
			        	</div>
			        	<div class="form-group">
			        		<label for="masuk">Masuk</label>
			        		<input type="time" name="masuk" class="form-control">
			        	</div>
			        	<div class="form-group">
			        		<label for="pulang">Pulang</label>
			        		<input type="time" name="pulang" class="form-control">
			        	</div>
			        	<div class="form-group">
			        		<label for="total_jam">Total Jam</label>
			        		<input type="number" name="total_jam" class="form-control">
			        	</div>
			        	<div class="form-group">
			        		<label for="status">Status</label>
			        		<select name="status" class="form-control">
			        			<option value="0">Aktif</option>
			        			<option value="1">Non Aktif</option>
			        		</select>
			        	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Menu </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                    <th>ID</th>
                    <th>Nama Shift</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Total Jam</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["nama"]; ?></td>
                        <td><?php echo $row["masuk"]; ?></td>
                        <td><?php echo $row["pulang"]; ?></td>
                        <td><?php echo $row["total_jam"]; ?></td>
                        <td><a href='?page=update_shift&id=<?php echo $row["id"]; ?>' class='btn btn-info btn-sm'>Edit</a> <a href='?page=delete_shift&id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm'>Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "0 results";
}

?>
    </div>
</div>
</div>
</section>