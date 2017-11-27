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
   
   $result = mysqli_query($mysqli, "SELECT * FROM (SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type) as WarrantyID, r.Deleted FROM (SELECT p.PartNo, p.PImage, p.Pname, p.PCompany, p.Price, p.SubCatID, p.WarrantyID, p.Deleted FROM Part p WHERE p.PartNo = '$partno') as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID) = coalesce(w.WarrantyID) ORDER BY PartNo) AS A JOIN (SELECT PartNo, StQuantity FROM sinventory) AS I USING (PartNo)");
   
   $outp = "";
   while($rs = mysqli_fetch_array($result)) {
     if ($outp != "") {$outp .= ",";}
     $outp .= '{"PartNo":"'  . $rs["PartNo"]    . '",';
     $outp .= '"PImage":"'   . $rs["PImage"]    . '",';
     $outp .= '"Pname":"'   . $rs["Pname"]    . '",';
     $outp .= '"PCompany":"'  . $rs["PCompany"]   . '",';
     $outp .= '"Price":"'    . $rs["Price"]     . '",';
     $outp .= '"SubCatID":"'   . $rs["SubCatID"]    . '",';
     $outp .= '"WarrantyID":"'   . $rs["WarrantyID"]    . '",';
     $outp .= '"Deleted":"'   . $rs["Deleted"]    . '",';
     $outp .= '"Quantity":"' . $rs["StQuantity"]  . '"}';
   }
   
   $outp ='{"records":['.$outp.']}';
   
   mysqli_free_result($result);
   mysqli_close($mysqli);
   
   echo($outp);
?>