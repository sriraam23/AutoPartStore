<?php
	include 'dbconfig.php';
	// echo "$dbuser";
	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	$result = mysqli_query($mysqli, "SELECT WarrantyID, Type from Warranty") or die (mysqli_error($mysqli));;
	
	$outp = "";
	while($rs = mysqli_fetch_array($result)) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"WarrantyID":"'  . $rs["WarrantyID"]    . '",';
		$outp .= '"Type":"' . $rs["Type"]  . '"}';
	}
	
	$outp ='{"records":['.$outp.']}';
	
	mysqli_free_result($result);
	mysqli_close($mysqli);
	
	echo($outp);
?>