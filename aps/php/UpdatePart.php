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
   $pname = $_GET['pname'];
   $pcompany = $_GET['pcompany'];
   $price = $_GET['pprice'];
   $subcatid = $_GET['psubcatid'];
   $warrantyid = $_GET['pwarrantyid'];
   
   if(empty("$partno") === TRUE)
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
	   $result = mysqli_query($mysqli, "UPDATE Part set Pname='$pname', PCompany='$pcompany', Price='$price', SubCatID='$subcatid', WarrantyID=NULL WHERE PartNo='$partno'");
	   
	   if($result === TRUE) {
		   mysqli_close($mysqli);
			  
		   echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
		   exit();
	   }
	   else {
		  mysqli_close($mysqli);
			  
		  echo "{\"records\":[{\"Status\":\"FAIL: Couldn't update Part.\"}]}";
		  exit();
	   }
   }
   else
   {
	   $result = mysqli_query($mysqli, "UPDATE Part set Pname='$pname', PCompany='$pcompany', Price='$price', SubCatID='$subcatid', WarrantyID='$warrantyid' WHERE PartNo='$partno'");
	   
	   if($result === TRUE) {
		   mysqli_close($mysqli);
			  
		   echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
		   exit();
	   }
	   else {
		  mysqli_close($mysqli);
			  
		  echo "{\"records\":[{\"Status\":\"FAIL: Couldn't update Part.\"}]}";
		  exit();
	   }
   }
   
   mysqli_close($mysqli);
   echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
?>