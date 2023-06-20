<?php

session_start();

if (!isset($_SESSION["login"])) {
    header('location:index.php');
    exit;
}

$_SESSION = [];

session_unset();
session_destroy();

header('location:login.php');