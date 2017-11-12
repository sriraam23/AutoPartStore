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
	
	session_regenerate_id(true);
	
	$_SESSION['sess_name'] = $_POST['name'];
	$_SESSION['sess_username'] = $_POST['username'];

	session_write_close();

	header( 'Location: index.php' );
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