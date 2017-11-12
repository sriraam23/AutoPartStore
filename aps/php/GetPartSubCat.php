<?php
	include 'dbconfig.php';

	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
   
   $argument1 = $_GET['make'];
   $argument2 = $_GET['model'];
   $argument3 = $_GET['year'];
   
   $result = mysqli_query($mysqli, "SELECT SubCatID from SubCategory ORDER BY SubCatID");
   
   // $result = mysqli_query($mysqli, "SELECT PartNo, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part where WarrantyID='$argument1'");
   
   $outp = "";
   while($rs = mysqli_fetch_array($result)) {
     if ($outp != "") {$outp .= ",";}
     $outp .= '{"SubCat":"'  . $rs["SubCatID"]  . '"}';
   }
   
   $outp ='{"records":['.$outp.']}';
   
   mysqli_free_result($result);
   mysqli_close($mysqli);
   
   echo($outp);
?>