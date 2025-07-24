<?php
session_start(); // Always start the session

if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
    include 'header.php';
} else {
    include 'headerPublic.php';
}
?>
