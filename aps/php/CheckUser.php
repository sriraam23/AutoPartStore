<?php
	include 'dbconfig.php';

	$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	/* check connection */
	if (mysqli_connect_errno()) {
	 printf("Connect failed: %s\n", mysqli_connect_error());
	 exit();
	}
   
  $username = $_GET['username'];
  
  if(strlen($username) < 6) {
    header( '400 Error' );
    exit();
  }

  $result = mysqli_query($mysqli, "SELECT username FROM users where username = '$username'");
  
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