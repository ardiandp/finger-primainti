<?php
require_once 'config/database.php';

$hapus=mysqli_query("DELETE FROM menus WHERE id='$_GET[id]'");
echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = '?page=menus';
    </script>";
