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
		$pquantity = $_GET['pquantity'];

		if(empty("$partno"))
		{
			echo "{\"records\":[{\"Status\":\"FAIL: No PartNo.\"}]}";
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

					echo "{\"records\":[{\"Status\":\"FAIL: Couldn't update User Cart\"}]}";
					exit();
				}
			}
			else {
				$getpart = mysqli_query($mysqli, "SELECT StQuantity FROM sinventory WHERE PartNo = '$partno' AND StQuantity > 0 AND StQuantity >= '$pquantity'");

				if(mysqli_num_rows($getpart) > 0) {
					$pprice = mysqli_query($mysqli, "SELECT Price FROM Part WHERE PartNo = '$partno'");


					$rs = mysqli_fetch_array($pprice);
					$curPrice = $rs["Price"];

					$result = mysqli_query($mysqli, "UPDATE usercart SET PartQuantity = '" . (int)$pquantity . "', PPrice = '$curPrice', TPPrice = (PartQuantity * PPrice) WHERE PartNo = '$partno' AND username = '$username'");
					//error_log("UPDATE usercart SET PartQuantity = '" . (int)$pquantity . "', PPrice = '$curPrice', TPPrice = (PartQuantity * PPrice) WHERE PartNo = '$partno' AND username = '$username'");
				}
				else {
					mysqli_close($mysqli);

					echo "{\"records\":[{\"Status\":\"FAIL: Couldn't update User Cart\"}]}";
					exit();
				}
			}

			if($result === TRUE) {
				mysqli_close($mysqli);

				echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
				exit();
			}
			else {
				mysqli_close($mysqli);

				echo "{\"records\":[{\"Status\":\"FAIL: Couldn't update User Cart\"}]}";
				exit();
			}
		}

		mysqli_close($mysqli);
		echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
	}
	else {
		echo "{\"records\":[{\"Status\":\"FAIL - No Username.\"}]}";
	}
?>