<?php
// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty($_POST["username"]) || empty($_POST["password"])) {
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
		header( 'Location: login.html' ) ;
		exit();
	}
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$mysqli = mysqli_connect('localhost', 'root', 'root', 'autopartstore');
	
	/* check connection */
	if (mysqli_connect_errno()) {
	 printf("Connect failed: %s\n", mysqli_connect_error());
	 exit();
	}

	$query = "SELECT * FROM USERS WHERE USERNAME = '$username'";
	$r = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($r);
	$hashed_password = $row['Password'];	

	if (mysqli_num_rows($r)==0) {
		// Invalid username
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
		header( 'Location: login.html' ) ;
		exit();
	}

	if(password_verify($password, $hashed_password)){
		// Invalid password
		session_regenerate_id(true);
	
		//$_SESSION['sess_name'] = $_POST['name'];
		$_SESSION['sess_username'] = $_POST['username'];

		session_write_close();

		header( 'Location: index.php' );
	}
	else{
		// Invalid password
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
		header( 'Location: login.html' ) ;
		exit();
	}
}
else {
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
	
	header( 'Location: login.html' ) ;
	exit();
}
?>