<?php 


require 'config/database.php';
$sql = "SELECT userid, badgenumber, name, gender, title FROM userinfo";
$result = $conn->query($sql); ?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2> 
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add User
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="userid" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="userid" name="userid" required>
                            </div>
                            <div class="mb-3">
                                <label for="badgenumber" class="form-label">Badge Number</label>
                                <input type="text" class="form-control" id="badgenumber" name="badgenumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" aria-label="Default select example" id="gender" name="gender" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST["simpan"])) {
            $userid = $_POST["userid"];
            $badgenumber = $_POST["badgenumber"];
            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $title = $_POST["title"];

            $sql = "INSERT INTO userinfo (userid, badgenumber, name, gender, title)
                    VALUES ('$userid', '$badgenumber', '$name', '$gender', '$title')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
        <div class="table-responsive">
           <table id="datatableBS4" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Badge Number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $row["userid"] . "</td>
                            <td>" . $row["badgenumber"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["gender"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>
                                <a href='edit_user.php?userid=" . $row["userid"] . "'>Edit</a>
                                <a href='delete_user.php?userid=" . $row["userid"] . "' onclick='return confirm(\"Hapus data user ini?\")'>Hapus</a>
                            </td>
                            
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





