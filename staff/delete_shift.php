<?php

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $sql = "DELETE FROM shift WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus');document.location='?page=shift'</script>";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
