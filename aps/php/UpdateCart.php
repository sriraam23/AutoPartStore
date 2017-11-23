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
	$username = $_GET['username'];
	$pquantity = $_GET['pquantity'];

	if(empty("$partno"))
	{
		echo "{\"records\":[{\"Status\":\"FAIL: No PartNo.\"}]}";
		mysqli_close($mysqli);
		exit();
	}
	elseif(empty("$username"))
	{
		echo "{\"records\":[{\"Status\":\"FAIL: No Username.\"}]}";
		mysqli_close($mysqli);
		exit();
	}
	else
	{
		$result = "";

		if(empty($pquantity))
		{
			if(($pquantity === 0) || ($pquantity === '0')) {
				$result = mysqli_query($mysqli, "DELETE FROM usercart WHERE PartNo = '$partno' AND Username =  '$username'");
				//error_log("DELETE FROM usercart WHERE PartNo = '$partno' AND Username =  '$username'");
			}
			else {
				mysqli_close($mysqli);

				echo "{\"records\":[{\"Status\":\"FAIL: Couldn't add to User Cart\"}]}";
				exit();
			}
		}
		else {
			$result = mysqli_query($mysqli, "INSERT INTO usercart (PartNo, Username, PartQuantity) VALUES ('$partno','$username','" . (int)$pquantity . "') ON DUPLICATE KEY UPDATE PartQuantity = " . (int)$pquantity);
			//error_log("INSERT INTO usercart (PartNo, Username, PartQuantity) VALUES ('$partno','$username','" . (int)$pquantity . "') ON DUPLICATE KEY UPDATE PartQuantity = " . (int)$pquantity);
		}

		if($result === TRUE) {
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
			exit();
		}
		else {
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"FAIL: Couldn't add to User Cart\"}]}";
			exit();
		}
	}

	mysqli_close($mysqli);
	echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
?>