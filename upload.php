<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) {
    die("Access denied.");
}

// Selanjutnya panggil KCFinder
require "core/bootstrap.php";
$uploader = "kcfinder\\uploader";
$uploader = new $uploader();
$uploader->upload();
?>
