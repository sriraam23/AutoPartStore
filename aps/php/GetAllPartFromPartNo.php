<?php
   include 'dbconfig.php';

   $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
   
   $partno = $_GET['part'];
   
   //$result = mysqli_query($mysqli, "SELECT PartNo, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part WHERE PartNo='$partno'");
   
   $result = mysqli_query($mysqli, "SELECT r.PartNo, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type, 'No Warranty') as WarrantyID FROM (SELECT p.PartNo, p.Pname, p.PCompany, p.Price, p.SubCatID, p.WarrantyID FROM Part p WHERE p.PartNo = '$partno') as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID, 'No Warranty') = coalesce(w.WarrantyID, 'No Warranty') ORDER BY PartNo");
   
   $outp = "";
   while($rs = mysqli_fetch_array($result)) {
     if ($outp != "") {$outp .= ",";}
     $outp .= '{"PartNo":"'  . $rs["PartNo"]    . '",';
     $outp .= '"Pname":"'   . $rs["Pname"]    . '",';
     $outp .= '"PCompany":"'  . $rs["PCompany"]   . '",';
     $outp .= '"Price":"'    . $rs["Price"]     . '",';
     $outp .= '"SubCatID":"'   . $rs["SubCatID"]    . '",';
     $outp .= '"WarrantyID":"' . $rs["WarrantyID"]  . '"}';
   }
   
   $outp ='{"records":['.$outp.']}';
   
   mysqli_free_result($result);
   mysqli_close($mysqli);
   
   echo($outp);
?>