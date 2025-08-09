
<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Shift</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Shift
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Shift</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="masuk" class="form-label">Masuk</label>
                                <input type="time" class="form-control" id="masuk" name="masuk">
                            </div>
                            <div class="mb-3">
                                <label for="pulang" class="form-label">Pulang</label>
                                <input type="time" class="form-control" id="pulang" name="pulang">
                            </div>
                            <div class="mb-3">
                                <label for="total_jam" class="form-label">Total Jam</label>
                                <input type="number" class="form-control" id="total_jam" name="total_jam">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? null;
    $masuk = $_POST['masuk'] ?? null;
    $pulang = $_POST['pulang'] ?? null;
    $total_jam = $_POST['total_jam'] ?? null;

    $stmt = $conn->prepare("INSERT INTO shift (nama, masuk, pulang, total_jam) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama, $masuk, $pulang, $total_jam);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!');window.location='shift.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<?php
require 'config/database.php';

$query = "SELECT id, nama, masuk, pulang, total_jam 
          FROM shift 
          ORDER BY nama ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped table-bordered'>
    <tr>
        <th>ID</th>
        <th>Nama Shift</th>
        <th>Masuk</th>
        <th>Pulang</th>
        <th>Total Jam</th>
        <th>Action</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["nama"]. "</td>
                <td>" . $row["masuk"]. "</td>
                <td>" . $row["pulang"]. "</td>
                <td>" . $row["total_jam"]. "</td>
                <td><a href='update_shift.php?id=" . $row["id"]. "'>Update</a> | <a href='delete_shift.php?id=" . $row["id"]. "'>Delete</a></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close(); ?>
    </div>
</div>
