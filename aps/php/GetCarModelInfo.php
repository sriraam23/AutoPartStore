<?php
	include 'dbconfig.php';

	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
   
   $argument1 = $_GET['make'];
   
   $result = mysqli_query($mysqli, "SELECT Model FROM CarInfo where Make='$argument1' GROUP BY Model ORDER BY Model");
   
   $outp = "";
   while($rs = mysqli_fetch_array($result)) {
     if ($outp != "") {$outp .= ",";}
     $outp .= '{"Model":"' . $rs["Model"]  . '"}';
   }
   
   $outp ='{"records":['.$outp.']}';
   
   mysqli_free_result($result);
   mysqli_close($mysqli);
   
   echo($outp);
?>