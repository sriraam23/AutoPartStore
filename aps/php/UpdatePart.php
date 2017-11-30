<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		include 'dbconfig.php';

		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		/* check connection */
		if (mysqli_connect_errno()) {
			echo json_encode(array('Status' => "Couldn't connect to Databse!"));
		}
		else {
			$partno = $_POST['partno'];
			$pname = $_POST['pname'];
			$pcompany = $_POST['pcompany'];
			//error_log($_POST['pprice']);
			$price = number_format($_POST['pprice'], 2, '.', '');
			//error_log($price);
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
			   echo json_encode(array('Status' => "No PartNo!"));
			   mysqli_close($mysqli);
			   //error_log("1");
			}
			elseif(empty("$pname") === TRUE)
			{
			   echo json_encode(array('Status' => "No Pname!"));
			   mysqli_close($mysqli);
			   //error_log("2");
			}
			elseif(empty("$pcompany") === TRUE)
			{
			   echo json_encode(array('Status' => "No PCompany!"));
			   mysqli_close($mysqli);
			   //error_log("3");
			}
			elseif(empty("$price") === TRUE)
			{
			   echo json_encode(array('Status' => "No Price!"));
			   mysqli_close($mysqli);
			   //error_log("4");
			}
			else {
				$validextensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["pimage"]["name"]);
				$file_extension = end($temporary);

				//error_log($file_extension);

				if(!empty($file_extension)) {
					if ((($_FILES["pimage"]["type"] == "image/png") || 
						($_FILES["pimage"]["type"] == "image/jpg") || 
						($_FILES["pimage"]["type"] == "image/jpeg")) && 
						($_FILES["pimage"]["size"] < 500000) && 
						in_array($file_extension, $validextensions)) {

						if ($_FILES["pimage"]["error"] > 0) {
							echo json_encode(array('Status' => "Image Upload Error: " . $_FILES["pimage"]["error"]));
						}
						else {
							$file_name = $_POST['partno'] . "_" . time() . "_" . mt_rand(10000000, 99999999) . "." . $file_extension;

							if (file_exists("../img/" . $file_name)) {
								echo json_encode(array('Status' => "Couldn't upload image!"));
								//error_log("5");
							}
							else {
								move_uploaded_file($_FILES["pimage"]["tmp_name"], "../img/" . $file_name);

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
							   		echo json_encode(array('Status' => "SUCCESS"));
							   		//error_log("6");
							   	}
							   	else {
							   		unlink("../img/" . $file_name);

							   		mysqli_close($mysqli);
							   		echo json_encode(array('Status' => "Couldn't Update Part!"));
							   		//error_log("7");
							   	}
							}
						}
					}
					else {
						echo json_encode(array('Status' => "Invalid image type or image file size greater than 500 KB!"));
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
				   		echo json_encode(array('Status' => "SUCCESS"));
				   		//error_log("9");
				   	}
				   	else {
				   		mysqli_close($mysqli);
				   		echo json_encode(array('Status' => "Couldn't Update Part!"));
				   		//error_log("10");
				   	}
				}
			}
		}
	}
	else {
		echo json_encode(array('Status' => "FAIL"));
	}
?>