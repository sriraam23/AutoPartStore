<?php
	session_start();

	$username =  $_SESSION['sess_username'];

	if(!empty($username)) {
		include 'dbconfig.php';

		// echo "$dbuser";
		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$delcar = mysqli_query($mysqli, "DELETE FROM usercart WHERE Username = '$username'");

			$cart = mysqli_query($mysqli, "SELECT * FROM usercart WHERE Username = '$username'");

			if(mysqli_num_rows($cart) == 0) {
				echo "{\"records\":[{\"Status\":\"SUCCESS - Cart emptied.\"}]}";
				mysqli_close($mysqli);
			}
			else {
				echo "{\"records\":[{\"Status\":\"FAIL - Cart could not be emptied.\"}]}";
				mysqli_close($mysqli);
			}
		}
	}
	else {
		echo "{\"records\":[{\"Status\":\"FAIL - No Username.\"}]}";
	}
?>