<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'config/app.php';

$id = (int)$_GET['id'];

if (delete_user($id) > 0) {
    echo "<script>
            alert('User berhasil dihapus');
            document.location.href = 'user.php';
        </script>";
} else {
    echo "<script>
            alert('User gagal dihapus');
            document.location.href = 'user.php';
        </script>";
}