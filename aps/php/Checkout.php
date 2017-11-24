<?php
	include 'dbconfig.php';

	// echo "$dbuser";
	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$username = $_GET['username'];

	if(empty("$username"))
	{
		echo "{\"records\":[{\"Status\":\"FAIL: No Username.\"}]}";
		mysqli_close($mysqli);
		exit();
	}
	else {
		$cart = mysqli_query($mysqli, "SELECT PartNo, PartQuantity FROM usercart WHERE Username = '$username'");
		//error_log("SELECT PartNo, PartQuantity FROM usercart WHERE Username = '$username'");

		if(mysqli_num_rows($cart) > 0) {

			//error_log("Got User Cart!");

			while($cartitem = mysqli_fetch_assoc($cart))
			{
			   $partno = $cartitem['PartNo'];
			   $pquantity = $cartitem['PartQuantity'];

			   $checkpart = mysqli_query($mysqli, "SELECT StQuantity FROM sinventory WHERE PartNo = '$partno' AND StQuantity > 0 AND StQuantity >= '$pquantity'");

			   if (mysqli_num_rows($checkpart) == 0) {
			   		mysqli_close($mysqli);

					echo "{\"records\":[{\"Status\":\"FAIL: Part - $partno - out of stock!\"}]}";
					exit();
			   }
			}

			$cartprice = mysqli_query($mysqli, "SELECT c.PartNo, (p.Price * c.PartQuantity) as TotalPrice , c.PartQuantity FROM usercart c LEFT OUTER JOIN part p ON c.PartNo = p.PartNo WHERE c.username = '$username'");
			$carttotal = mysqli_query($mysqli, "SELECT SUM(p.Price * c.PartQuantity) as TotalSum FROM usercart c LEFT OUTER JOIN part p ON c.PartNo = p.PartNo WHERE c.username = '$username'");
			$userinfo = mysqli_query($mysqli, "SELECT Street, City, State, Zipcode FROM customer WHERE Username = '$username'");

			$orderid = $username . time() . uniqid(mt_rand(), true);

			$cartcost = mysqli_fetch_array($carttotal)['TotalSum'];

			$useradd = mysqli_fetch_array($userinfo);

			$street = $useradd['Street'];
			$city = $useradd['City'];
			$state = $useradd['State'];
			$zipcode = $useradd['Zipcode'];

			//error_log("INSERTING Order...");

			$order = mysqli_query($mysqli, "INSERT INTO orders(OrderID, Cost, Street, City, State, Zipcode, Username, StoreID) VALUES ('$orderid', '$cartcost', '$street', '$city', '$state', '$zipcode', '$username', 1)");
			//error_log("INSERT INTO orders(OrderID, Cost, Street, City, State, Zipcode, Username, StoreID) VALUES ('$orderid', '$cartcost', '$street', '$city', '$state', '$zipcode', '$username', 1)");

			if($order === TRUE) {
				//error_log("Inserting Order Items...");

				while($cartitem = mysqli_fetch_assoc($cartprice))
				{
				   $partno = $cartitem['PartNo'];
				   $pquantity = $cartitem['PartQuantity'];

				   $orderpart = mysqli_query($mysqli, "INSERT INTO oinventory(OrderID, PartNo, OrQuantity) VALUES ('$orderid', '$partno', '" . (int)$pquantity . "')");
				   $delpart = mysqli_query($mysqli, "DELETE FROM usercart WHERE PartNo = '$partno' AND Username = '$username'");
				   $updatepart = mysqli_query($mysqli, "UPDATE sinventory SET StQuantity = StQuantity - '" . (int)$pquantity . "' WHERE PartNo = '$partno'");

				   //error_log("INSERT INTO oinventory(OrderID, PartNo, OrQuantity) VALUES ('$orderid', '$partno', '" . (int)$pquantity . "')");
				   //error_log("DELETE FROM usercart WHERE PartNo = '$partno' AND Username = '$username'");
				   //error_log("UPDATE sinventory SET StQuantity = StQuantity - '" . (int)$pquantity . "' WHERE PartNo = '$partno'");
				}

				mysqli_close($mysqli);

				echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
				exit();
			}
			else {
				mysqli_close($mysqli);

				echo "{\"records\":[{\"Status\":\"FAIL: Couldn't create Order!\"}]}";
				exit();
			}

			mysqli_close($mysqli);
			echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
			exit();
		}
		else {
			//error_log("No User Cart!");

			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"FAIL: Couldn't get User cart!\"}]}";
			exit();
		}
	}

	mysqli_close($mysqli);
	echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
?>