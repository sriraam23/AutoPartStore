<?php
	session_start();
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);

	$url = $_SERVER['REQUEST_URI'];
	if (strpos($url, 'aps') !== false) {
 	    header( 'Location: /aps/login.php' ) ;
	}
	else{
		header( 'Location: /login.php' ) ;
	}	
	exit();
?>