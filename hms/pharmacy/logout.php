<?php
session_start();

if(isset($_SESSION['pharmacy'])){
	unset($_SESSION['pharmacy']);
	header("Location:../index.php");
}
?>