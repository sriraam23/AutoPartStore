<?php
	session_start();
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'autopartstore';

	// echo "$dbuser";
	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	$count = 0;
	/* check connection */
	if (mysqli_connect_errno()) {
		echo $count;
	}
	else {
		$username = $_SESSION['sess_username'];

		$result = mysqli_query($mysqli, "SELECT COUNT(*) AS items FROM usercart WHERE username = '$username'");
		// error_log("SELECT COUNT(*) AS items FROM usercart WHERE username = '$username'");

		$rs = mysqli_fetch_assoc($result);

		echo $rs['items'];
	}
?>