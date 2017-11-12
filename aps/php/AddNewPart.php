<?php
	include 'dbconfig.php';
	// echo "$dbuser";
	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
   
   $make = $_GET['make'];
   $model = $_GET['model'];
   $miny = $_GET['carMinYear'];
   $maxy = $_GET['carMaxYear'];
   $partno = $_GET['partno'];
   $pname = $_GET['pname'];
   $pcompany = $_GET['pcompany'];
   $price = $_GET['pprice'];
   $subcatid = $_GET['psubcatid'];
   $warrantyid = $_GET['pwarrantyid'];
   
   if(empty("$make") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No Make.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$model") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No Model.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$miny") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No CarMinYear\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$maxy") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No CarMaxYear\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$partno") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No PartNo.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$pname") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No Pname.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$pcompany") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No PCompany.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$price") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No Price.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$subcatid") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No SubCatID.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   elseif(empty("$warrantyid") === TRUE)
   {
	   $result = mysqli_query($mysqli, "INSERT INTO Part (PartNo, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$pname','$pcompany','".(double)$price."','$subcatid', NULL)");
	   
	   if($result === TRUE) {
		   $carresult = mysqli_query($mysqli, "INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");
		   
		   //$crs = mysqli_fetch_array($carresult);
		   
		   if($carresult === TRUE) {
			  mysqli_close($mysqli);
			  
			  echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
			  exit();
		   }
		   else {
			  mysqli_close($mysqli);
			  
			  echo "{\"records\":[{\"Status\":\"FAIL: Couldn't add CarInfo\"}]}";
			  exit();
		   }
	   }
	   else {
		  mysqli_close($mysqli);
			  
		  echo "{\"records\":[{\"Status\":\"FAIL: Couldn't add Part.\"}]}";
		  exit();
	   }
   }
   else
   {
	   $result = mysqli_query($mysqli, "INSERT INTO Part (PartNo, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$pname','$pcompany','".(double)$price."','$subcatid','".(int)$warrantyid."')");
	   
	   if($result === TRUE) {
		   $carresult = mysqli_query($mysqli, "INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");
		   
		   //$crs = mysqli_fetch_array($carresult);
		   
		   if($carresult === TRUE) {
			  mysqli_close($mysqli);
			  
			  echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
			  exit();
		   }
		   else {
			  mysqli_close($mysqli);
			  
			  echo "{\"records\":[{\"Status\":\"FAIL: Couldn't add CarInfo\"}]}";
			  exit();
		   }
	   }
	   else {
		  mysqli_close($mysqli);
			  
		  echo "{\"records\":[{\"Status\":\"FAIL: Couldn't add Part.\"}]}";
		  exit();
	   }
   }
   
   mysqli_close($mysqli);
   echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
?>