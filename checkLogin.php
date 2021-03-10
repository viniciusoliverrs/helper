<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!isset($_SESSION['usuario_id'])) header('location: Login.php');
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: Login.php');
}