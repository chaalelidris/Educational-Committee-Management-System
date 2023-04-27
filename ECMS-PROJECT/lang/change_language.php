<?php
session_start();

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Redirect the user back to the page they were on
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Redirect to homepage if the referer header is not set
    header("Location: ../index.php");
    exit();
}
?>
