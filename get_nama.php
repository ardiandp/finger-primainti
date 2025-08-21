<?php
require_once 'config/database.php';
$nik = $_GET['nik'];
$query = $conn->query("SELECT name FROM users WHERE nik = '$nik'");
$row = $query->fetch_assoc();
echo $row['name'] ?? '';

$conn->close();
?>