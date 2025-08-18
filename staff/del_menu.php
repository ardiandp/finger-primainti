<?php
$id = $_GET['id'];

if (!empty($id)) {
  $deleteSQL = "DELETE FROM menu WHERE id=?";
  $stmt = $conn->prepare($deleteSQL);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();

}
?>
<script>alert ('Data Terhapus'); document.location='?page=menu' </script>
