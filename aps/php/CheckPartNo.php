<?php
	include 'dbconfig.php';

	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
	 printf("Connect failed: %s\n", mysqli_connect_error());
	 exit();
	}
   
  $partno = trim($_GET['partno']);
  
  if(strlen($partno) < 1) {
    header( '400 Error' );
    exit();
  }

  $result = mysqli_query($mysqli, "SELECT PartNo FROM Part WHERE PartNo = '$partno'");
  //error_log("SELECT PartNo FROM Part WHERE PartNo = '$partno'");
  $outp = "";

  if (mysqli_num_rows($result)==0) {
    echo json_encode(array());
    exit();
  }
  else {
    header( '400 Error' );
    exit();
  }
?>