<?php
session_start();

if($_SESSION['admin'] == 1) {
  include 'dbconfig.php';

  $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  $result = "";

  $result = mysqli_query($mysqli, "SELECT q.PartNo, q.PImage, q.Pname, q.PCompany, q.Price, q.SubCatID, q.WarrantyID, s.StQuantity, q.Deleted FROM(SELECT r.PartNo, r.PImage, r.Pname, r.PCompany, r.Price, r.SubCatID, coalesce(w.Type) as WarrantyID, r.Deleted FROM (SELECT PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID, Deleted FROM Part) as r LEFT OUTER JOIN Warranty w  ON coalesce(r.WarrantyID) = coalesce(w.WarrantyID) ORDER BY PartNo) as q JOIN sinventory as s on q.PartNo = s.PartNo");

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
      if($rs["Deleted"] == '0') {
        $outp .= '"Deleted":"active.png",';
      }
      else {
        $outp .= '"Deleted":"deleted.png",';
      }
      $outp .= '"Quantity":"' . $rs["StQuantity"]  . '"}';
    }

    $outp ='{"records":['.$outp.']}';

    mysqli_free_result($result);
    mysqli_close($mysqli);

    echo($outp);
  }
  else {
    $outp = "";
    $outp ='{"records":['.$outp.']}';
    echo($outp);
  }
?>