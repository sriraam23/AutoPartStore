<?php
	session_start();

	$username = $_SESSION['sess_username'];

	if(!empty($username)) {
		include 'dbconfig.php';

		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$result = "";

		if(!empty($username)) {
			$result = mysqli_query($mysqli, "SELECT * FROM (SELECT B.OrderID, B.PartNo, A.PName, A.PCompany, A.PImage, B.TPPrice AS PartsCost, B.OrQuantity FROM part AS A JOIN oinventory AS B ON A.PartNo = B.PartNo) AS ordInv JOIN orders AS ords USING (OrderID) WHERE Username = '$username'");

			//error_log("SELECT * FROM (SELECT B.OrderID, B.PartNo, A.PName, A.PCompany, A.PImage, (A.Price * B.OrQuantity) AS PartsCost, B.OrQuantity FROM part AS A JOIN oinventory AS B ON A.PartNo = B.PartNo) AS ordInv JOIN orders AS ords USING (OrderID) WHERE Username = '$username'");
			/*
			$rows = array();

			while($r = mysqli_fetch_assoc($result)) {
			    $rows[] = $r;
			    //print json_encode($r);
			}
			$outp ='{"records":'.json_encode($rows).'}';
			*/
			$outp = "";
			while($rs = mysqli_fetch_array($result)) {
				if ($outp != "") {$outp .= ",";}

				$outp .= '{"OrderID":"' . $rs["OrderID"] . '",';
				$outp .= '"PartNo":"' . $rs["PartNo"] . '",';
			    $outp .= '"PImage":"' . $rs["PImage"] . '",';
			    $outp .= '"Pname":"' . $rs["PName"] . '",';
			    $outp .= '"PCompany":"' . $rs["PCompany"] . '",';
			    $outp .= '"OrQuantity":' . $rs["OrQuantity"] . ',';
			    $outp .= '"PartsCost":' . $rs["PartsCost"] . '}';
			}

			$outp ='{"records":['.$outp.']}';

			echo $outp;
			//error_log($outp);
		}
		else {
			mysqli_close($mysqli);

			echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
			exit();
		}
	}
	else {
		echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
		exit();
	}
?>