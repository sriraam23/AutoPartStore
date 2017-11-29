<?php
	session_start();

	$username = $_SESSION['sess_username'];

	if(!empty($username)) {
		include 'dbconfig.php';

		// echo "$dbuser";
		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$partno = $_GET['partno'];
		$pprice = $_GET['price'];
		$pquantity = $_GET['pquantity'];

		if(empty("$partno"))
		{
			echo "{\"records\":[{\"Status\":\"FAIL: No PartNo.\"}]}";
			mysqli_close($mysqli);
			exit();
		}
		elseif(empty("$pprice"))
		{
			echo "{\"records\":[{\"Status\":\"FAIL: No price.\"}]}";
			mysqli_close($mysqli);
			exit();
		}
		else
		{
			if(empty($pquantity))
			{
				$pquantity = 1;
			}

			$result = mysqli_query($mysqli, "INSERT INTO usercart (PartNo, Username, PartQuantity, PPrice, TPPrice) VALUES ('$partno','$username','" . (int)$pquantity . "', '" . sprintf("%.2f", $pprice) . "', '" . sprintf("%.2f", $pprice) . "') ON DUPLICATE KEY UPDATE PartQuantity = PartQuantity + " . (int)$pquantity . ", PPrice = " . sprintf("%.2f", $pprice) . ", TPPrice = PartQuantity * PPrice");
			
			error_log("INSERT INTO usercart (PartNo, Username, PartQuantity, PPrice, TPPrice) VALUES ('$partno','$username','" . (int)$pquantity . "', '" . sprintf("%.2f", $pprice) . "', '" . sprintf("%.2f", $pprice) . "') ON DUPLICATE KEY UPDATE PartQuantity = PartQuantity + " . (int)$pquantity . ", PPrice = " . sprintf("%.2f", $pprice) . ", TPPrice = PartQuantity * PPrice");

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
	}
	else{
		echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
	}
?>