<?php
session_start();
if($_SESSION['auth'] == true){
	header('location: welcome.php');
}
$_SESSION['error'] = "";
header('location: login.php');
?>