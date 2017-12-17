<?php
	session_start();

	include 'dbconfig.php';
	// echo "$dbuser";
	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$username = $_SESSION['sess_username'];
	$query = "SELECT * FROM USERS WHERE USERNAME = '$username'";
	$r = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($r);
	$admin = $row['Admin'];
	$_SESSION['admin'] = $admin;

	header("Content-Type: text/html");
?>