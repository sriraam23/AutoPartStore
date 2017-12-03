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

		$orderNo = $_GET['orderNo'];

		$r1 = mysqli_query($mysqli, "SELECT * FROM oinventory where OrderID = '$orderNo'");
		while($row = mysqli_fetch_assoc($r1)) {
			$partNo = $row['PartNo'];
			$quantity = $row['OrQuantity'];

			$r2 = mysqli_query($mysqli, "SELECT * FROM sinventory where PartNo = '$partNo'");
			$row2 = mysqli_fetch_assoc($r2);
			$orig_quantity = $row2['StQuantity'];
			//error_log("SELECT StQuantity FROM sinventory where PartNo = '$partNo'");

			$total = $quantity + $orig_quantity;

			$update = mysqli_query($mysqli, "UPDATE sinventory SET StQuantity = '$total' where PartNo = '$partNo'");
			//error_log("UPDATE sinventory SET StQuantity = '$total' where PartNo = '$partNo'");
		}

		$result = mysqli_query($mysqli, "UPDATE orders SET Shipped = '0', Delivered = '1' where OrderID = '$orderNo'");

		if($result === TRUE) {
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
			exit();
		}
		else {
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"Couldn't cancel the Order.\"}]}";
			exit();
		}

		mysqli_close($mysqli);
		echo "{\"records\":[{\"Status\":\"Couldn't cancel the Order.\"}]}";
	}
	else{
		echo "{\"records\":[{\"Status\":\"Couldn't cancel the Order.\"}]}";
	}
?>
