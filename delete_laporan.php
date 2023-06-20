<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'config/app.php';

$id_laporan = (int)$_GET['id_laporan'];

if (delete_laporan($id_laporan) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'laporan.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = 'laporan.php';
        </script>";
}