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

  $inputMake = $_GET['make'];
  $inputModel = $_GET['model'];
  $inputYear = $_GET['year'];
   
  $result = "";

  if(!empty($inputMake) && !empty($inputModel) && !empty($inputYear)) {
    $result = mysqli_query($mysqli, "SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type, 'No Warranty') as WarrantyID FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part where PartNo in (SELECT PartNo from CarInfo where Make='$inputMake' AND Model='$inputModel' AND MinYear <= '".(int)$inputYear."' AND MaxYear >= '".(int)$inputYear."' GROUP BY PartNo)) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID, 'No Warranty') = coalesce(w.WarrantyID, 'No Warranty') ORDER BY PartNo");
  }
  elseif (!empty($inputMake) && !empty($inputModel)) {
    $result = mysqli_query($mysqli, "SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type, 'No Warranty') as WarrantyID FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part where PartNo in (SELECT PartNo from CarInfo where Make='$inputMake' AND Model='$inputModel' GROUP BY PartNo)) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID, 'No Warranty') = coalesce(w.WarrantyID, 'No Warranty') ORDER BY PartNo");
  }
  elseif (!empty($inputMake) && !empty($inputYear)) {
    $result = mysqli_query($mysqli, "SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type, 'No Warranty') as WarrantyID FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part where PartNo in (SELECT PartNo from CarInfo where Make='$inputMake' AND MinYear <= '".(int)$inputYear."' AND MaxYear >= '".(int)$inputYear."' GROUP BY PartNo)) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID, 'No Warranty') = coalesce(w.WarrantyID, 'No Warranty') ORDER BY PartNo");
  }
  elseif (!empty($inputMake)) {
    $result = mysqli_query($mysqli, "SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type, 'No Warranty') as WarrantyID FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part where PartNo in (SELECT PartNo from CarInfo where Make='$inputMake' GROUP BY PartNo)) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID, 'No Warranty') = coalesce(w.WarrantyID, 'No Warranty') ORDER BY PartNo");
  }
  elseif(!empty($inputYear)) {
    $result = mysqli_query($mysqli, "SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type, 'No Warranty') as WarrantyID FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part where PartNo in (SELECT PartNo from CarInfo where MinYear <= '".(int)$inputYear."' AND MaxYear >= '".(int)$inputYear."' GROUP BY PartNo)) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID, 'No Warranty') = coalesce(w.WarrantyID, 'No Warranty') ORDER BY PartNo");
  }
  else {
    $result = mysqli_query($mysqli, "SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type) as WarrantyID FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID FROM Part) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID) = coalesce(w.WarrantyID) ORDER BY PartNo");
  }

  $outp = "";
  while($rs = mysqli_fetch_array($result)) {
   if ($outp != "") {$outp .= ",";}
     $outp .= '{"PartNo":"'  . $rs["PartNo"]    . '",';
     $outp .= '"PImage":"'   . $rs["PImage"]    . '",';
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