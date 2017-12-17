<?php
	session_start();

	header("Content-Type: text/html");
	
	if(!(isset($_SESSION['sess_username']))){
		header('Location: login.php');
	}
?>