    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 0.25rem;
            box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0,0,0,.125);
            font-weight: 600;
        }
    </style>
<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2>
        <div class="table-responsive">
              <table id="datatableBS4" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Karyawan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'config/database.php';

                    $sql = "SELECT k.id as idkalender, k.tanggal, s.nama AS shift, u.name AS karyawan, u.userid
                            FROM kalenderkerja k
                            right JOIN shift s ON k.shift = s.nama
                            right JOIN userinfo u ON k.karyawan = u.userid
                            ORDER BY k.tanggal desc";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["idkalender"] . "</td>";
                            echo "<td>" . $row["tanggal"] . "</td>";
                            echo "<td>" . $row["shift"] . "</td>";
                            echo "<td>" . $row["karyawan"] . " ({$row["userid"]})</td>";
                            echo "<td><a href='edit_kalender.php?id=" . $row["idkalender"] . "'>Edit</a> | <a href='hapus_kalender.php?id=" . $row["idkalender"] . "'>Hapus</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

