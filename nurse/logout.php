<?php
session_start();

if(isset($_SESSION['nurse'])){
	unset($_SESSION['nurse']);
	header("Location:../index.php");
}
?>