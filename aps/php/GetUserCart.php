<?php
	include 'dbconfig.php';

	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
   
  // query for just year
  // query for just make
  // query for just make and model
  // query for just make and year
  // query for just make, model, and year - DONE

  $username = $_GET['username'];
   
  $result = "";

  if(!empty($username)) {
    $result = mysqli_query($mysqli, "SELECT c.PartNo, p.PImage, p.Pname, p.PCompany, (p.Price * c.PartQuantity) as TotalPrice , c.PartQuantity FROM usercart c LEFT OUTER JOIN part p ON c.PartNo = p.PartNo WHERE c.username = '" . $username . "'");
  }

  $outp = "";
  while($rs = mysqli_fetch_array($result)) {
   if ($outp != "") {$outp .= ",";}
     $outp .= '{"PartNo":"'  . $rs["PartNo"]    . '",';
     $outp .= '"PImage":"'   . $rs["PImage"]    . '",';
     $outp .= '"Pname":"'   . $rs["Pname"]    . '",';
     $outp .= '"PCompany":"'  . $rs["PCompany"]   . '",';
     $outp .= '"Price":"'    . $rs["TotalPrice"]     . '",';
     $outp .= '"PartQuantity":"'   . $rs["PartQuantity"] . '"}';
  }

  $outp ='{"records":['.$outp.']}';

  mysqli_free_result($result);
  mysqli_close($mysqli);

  echo($outp);
?>