<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'config/app.php';

$id = (int)$_GET['id'];

if (delete_data($id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = 'index.php';
        </script>";
}