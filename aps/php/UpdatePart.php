<?php
	if (isset($_POST['submit'])) {
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = 'root';
		$dbname = 'autopartstore';

		// echo "$dbuser";
		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		/* check connection */
		if (mysqli_connect_errno()) {
			echo "<div class='alert alert-danger'><span>Error: Couldn't connect to Databse!</span></div>";
		}
		else {
			$partno = $_POST['partno'];
			$pname = $_POST['pname'];
			$pcompany = $_POST['pcompany'];
			$price = $_POST['pprice'];
			$subcatid = $_POST['psubcatid'];
			$warrantyid = $_POST['pwarrantyid'];
			$quantity = $_POST['quantity'];
			$delete = $_POST['delete'];

			if($delete == 'on') {
				$delete = '1';
			}
			else {
				$delete = '0';
			}

			if(empty("$partno") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No PartNo!</span></div>";
			   mysqli_close($mysqli);
			   //error_log("1");
			}
			elseif(empty("$pname") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No Pname!</span></div>";
			   mysqli_close($mysqli);
			   error_log("2");
			}
			elseif(empty("$pcompany") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No PCompany!</span></div>";
			   mysqli_close($mysqli);
			   //error_log("3");
			}
			elseif(empty("$price") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No Price!</span></div>";
			   mysqli_close($mysqli);
			   //error_log("4");
			}
			else {
				$validextensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = end($temporary);

				if(!empty($file_extension)) {
					if ((($_FILES["file"]["type"] == "image/png") || 
						($_FILES["file"]["type"] == "image/jpg") || 
						($_FILES["file"]["type"] == "image/jpeg")) && 
						($_FILES["file"]["size"] < 100000) && 
						in_array($file_extension, $validextensions)) {

						if ($_FILES["file"]["error"] > 0) {
							echo "<div class='alert alert-danger'><span>Return Code: " . $_FILES["file"]["error"] . "</span></div>";
						}
						else {
							$file_name = $_POST['partno'] . "_" . time() . "_" . uniqid(mt_rand(), true) . "." . $file_extension;

							if (file_exists("img/" . $file_name)) {
								echo "<div class='alert alert-danger'><span>Error: Couldn't upload image!</span></div>";
								//error_log("5");
							}
							else {
								move_uploaded_file($_FILES["file"]["tmp_name"], "img/" . $file_name);

								$result = "";

								if(empty($subcatid) && empty($warrantyid))
								{
								   $result = mysqli_query($mysqli, "UPDATE Part set PImage='$file_name', Pname='$pname', PCompany='$pcompany', Price='$price', Deleted='$delete' WHERE PartNo='$partno'");
								}
								elseif(empty($warrantyid))
								{
								   $result = mysqli_query($mysqli, "UPDATE Part set PImage='$file_name', Pname='$pname', PCompany='$pcompany', Price='$price', SubCatID='$subcatid', Deleted='$delete' WHERE PartNo='$partno'");
								}
								elseif(empty($subcatid)){
									$result = mysqli_query($mysqli, "UPDATE Part set PImage='$file_name', Pname='$pname', PCompany='$pcompany', Price='$price', WarrantyID='$warrantyid', Deleted='$delete' WHERE PartNo='$partno'");
								}
								else {
									$result = mysqli_query($mysqli, "UPDATE Part set PImage='$file_name', Pname='$pname', PCompany='$pcompany', Price='$price', SubCatID='$subcatid', WarrantyID='$warrantyid', Deleted='$delete' WHERE PartNo='$partno'");
								}

							   	if($result === TRUE) {
							   		$qresult = mysqli_query($mysqli, "INSERT INTO sinventory (StoreID, PartNo, StQuantity) VALUES ('1', '$partno', '$quantity') ON DUPLICATE KEY UPDATE StQuantity = " . (int)$quantity);
				   					
							   		mysqli_close($mysqli);
							   		echo "<div class='alert alert-success'><span>Success: Part Updated!</span></div>";
							   		//error_log("6");
							   	}
							   	else {
							   		unlink("img/" . $file_name);

							   		mysqli_close($mysqli);
							   		echo "<div class='alert alert-danger'><span>Error: Couldn't Update Part!</span></div>";
							   		//error_log("7");
							   	}
							}
						}
					}
					else {
						echo "<div class='alert alert-danger'><span>Error: Invalid file Size or file Type!</span></div>";
						//error_log("8");
					}
				}
				else {
					$result = "";

					if(empty($subcatid) && empty($warrantyid))
					{
					   $result = mysqli_query($mysqli, "UPDATE Part set Pname='$pname', PCompany='$pcompany', Price='$price', Deleted='$delete' WHERE PartNo='$partno'");
					}
					elseif(empty($warrantyid))
					{
					   $result = mysqli_query($mysqli, "UPDATE Part set Pname='$pname', PCompany='$pcompany', Price='$price', SubCatID='$subcatid', Deleted='$delete' WHERE PartNo='$partno'");
					}
					elseif(empty($subcatid)){
						$result = mysqli_query($mysqli, "UPDATE Part set Pname='$pname', PCompany='$pcompany', Price='$price', WarrantyID='$warrantyid', Deleted='$delete' WHERE PartNo='$partno'");
					}
					else {
						$result = mysqli_query($mysqli, "UPDATE Part set Pname='$pname', PCompany='$pcompany', Price='$price', SubCatID='$subcatid', WarrantyID='$warrantyid', Deleted='$delete' WHERE PartNo='$partno'");
					}

				   	if($result === TRUE) {
				   		//INSERT INTO usercart (PartNo, Username, PartQuantity) VALUES ('$partno','$username','" . (int)$pquantity . "') ON DUPLICATE KEY UPDATE PartQuantity = PartQuantity + " . (int)$pquantity)
				   		$qresult = mysqli_query($mysqli, "INSERT INTO sinventory (StoreID, PartNo, StQuantity) VALUES ('1', '$partno', '$quantity') ON DUPLICATE KEY UPDATE StQuantity = " . (int)$quantity);

				   		if($delete == '1') {
				   			$dresult = mysqli_query($mysqli, "DELETE FROM usercart WHERE PartNo = '$partno'");
				   		}
				   		
				   		mysqli_close($mysqli);
				   		echo "<div class='alert alert-success'><span>Success: <span id='partid'>". $partno . "</span> Part Updated!</span></div>";
				   		//error_log("9");
				   	}
				   	else {
				   		mysqli_close($mysqli);
				   		echo "<div class='alert alert-danger'><span>Error: <span id='partid'>". $partno . "</span> Couldn't Update Part!</span></div>";
				   		//error_log("10");
				   	}
				}
			}
		}
	}
?>