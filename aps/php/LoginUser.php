<?php
	// Start session
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "GET"){
		if (empty($_GET["username"]) || empty($_GET["password"])) {
			session_unset();
			session_destroy();
			session_write_close();
			setcookie(session_name(),'',0,'/');
			session_regenerate_id(true);
			
			header( 'Location: /aps/login.php' ) ;
			exit();
		}
		
		$username = $_GET["username"];
		$password = $_GET["password"];
		
		include 'dbconfig.php';
		// echo "$dbuser";
		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		
		/* check connection */
		if (mysqli_connect_errno()) {
			echo "{\"records\":[{\"Status\":\"FAIL\"}]}";

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
			
			echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
			exit();
		}
	 	else if(password_verify($password, $hashed_password)){
			// Valid username &  password
			session_regenerate_id(true);
			
			$_SESSION['sess_username'] = $_GET['username'];

			session_write_close();

			echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
			exit();
		}
		else{
			// Invalid password
			session_unset();
			session_destroy();
			session_write_close();
			setcookie(session_name(),'',0,'/');
			session_regenerate_id(true);
			
			echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
			exit();
		}
	}
	else {
		// NOT GET METHOD
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
		echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
		exit();
	}
?>