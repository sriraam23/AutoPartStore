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
   elseif(empty("$pquantity") === TRUE)
   {
	   echo "{\"records\":[{\"Status\":\"FAIL: No Part Quantity.\"}]}";
	   mysqli_close($mysqli);
	   exit();
   }
   else
   {
	   $result = mysqli_query($mysqli, "INSERT INTO usercart (PartNo, Username, Pquantity) VALUES ('$partno','$Username','".(int)$Pquantity."')");
	     
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