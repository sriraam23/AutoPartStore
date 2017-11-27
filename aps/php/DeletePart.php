<?php
	include 'dbconfig.php';

	// echo "$dbuser";
	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$partno = $_GET['partno'];

	if(empty("$partno") === TRUE) {
		echo "{\"records\":[{\"Status\":\"FAIL: No PartNo.\"}]}";

		mysqli_close($mysqli);
		exit();
	}
	else {	  
		//$image = mysqli_query($mysqli, "SELECT PImage FROM Part WHERE PartNo='$partno'");

		$presult = mysqli_query($mysqli, "UPDATE Part SET Deleted = '1' WHERE PartNo='$partno'");

		if($presult === TRUE) {
			/*
			while($rs = mysqli_fetch_array($image)) {
				rename("../img/" . $rs["PImage"], "../img/del/" . $rs["PImage"]);
			}
			*/
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
			exit();
		}
		else {
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"FAIL: Couldn't delete Part.\"}]}";
			exit();
		}
	}

	mysqli_close($mysqli);
	echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
?>