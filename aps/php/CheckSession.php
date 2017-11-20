<?php
session_start();
if(!(isset($_SESSION['sess_username']))){
	header('Location: login.html');
}
?>