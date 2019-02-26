<?php
session_start();
header("Content-Type: text/html; charset=utf-8"); 
$_SESSION['test'] = $_SERVER['REMOTE_ADDR']; 
?>