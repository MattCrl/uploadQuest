<?php
$dir = "uploads/";
if (!empty($_POST)) {
    if (file_exists($dir . $_POST['name'])) {
        unlink($dir . $_POST['name']);
    }
}

header('Location: index.php');