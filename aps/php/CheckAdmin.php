<?php
	$mysqli = mysqli_connect('localhost', 'root', 'root', 'autopartstore');
	
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
?>