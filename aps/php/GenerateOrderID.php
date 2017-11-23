<?php
	$userid = "Test1234";

	$unique_id = $userid . time() . uniqid(mt_rand(), true);

	echo $unique_id;
?>