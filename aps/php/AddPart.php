<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		include 'dbconfig.php';

		$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		/* check connection */
		if (mysqli_connect_errno()) {
			echo json_encode(array('Status' => "Couldn't connect to Databse!"));
		}
		else {
			/*
   			$make = $_POST['carMake'];
			$model = $_POST['carModel'];
			$miny = $_POST['carMinYear'];
			$maxy = $_POST['carMaxYear'];
			*/
			$partno = $_POST['partno'];
			$pname = $_POST['pname'];
			$pcompany = $_POST['pcompany'];
			$price = $_POST['pprice'];
			$subcatid = $_POST['psubcatid'];
			$warrantyid = $_POST['pwarrantyid'];
			/*
			if(empty("$make") === TRUE)
			{
			   echo json_encode(array('Status' => "No Make!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$model") === TRUE)
			{
			   echo json_encode(array('Status' => "No Model!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$miny") === TRUE)
			{
			   echo json_encode(array('Status' => "No CarMinYear!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$maxy") === TRUE)
			{
			   echo json_encode(array('Status' => "No CarMaxYear!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$partno") === TRUE)
			{
			   echo json_encode(array('Status' => "No PartNo!"));
			   mysqli_close($mysqli);
			}
			*/
			if(empty("$partno") === TRUE)
			{
			   echo json_encode(array('Status' => "No PartNo!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$pname") === TRUE)
			{
			   echo json_encode(array('Status' => "No Pname!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$pcompany") === TRUE)
			{
			   echo json_encode(array('Status' => "No PCompany!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$price") === TRUE)
			{
			   echo json_encode(array('Status' => "No Price!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$subcatid") === TRUE)
			{
			   echo json_encode(array('Status' => "No SubCatID!"));
			   mysqli_close($mysqli);
			}
			elseif(empty("$warrantyid") === TRUE)
			{
			   echo json_encode(array('Status' => "No Warranty!"));
			   mysqli_close($mysqli);
			}
			else {
				$presult = mysqli_query($mysqli, "SELECT * FROM Part WHERE PartNo='$partno'");

				if(mysqli_num_rows($presult) > 0) {
					echo json_encode(array('Status' => "Duplicate PartNo!"));
					//error_log(json_encode(array('Status' => "Duplicate PartNo!")));
					exit();
				}

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
							}
							else {
								move_uploaded_file($_FILES["pimage"]["tmp_name"], "../img/" . $file_name);

								$result = mysqli_query($mysqli, "INSERT INTO Part (PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$file_name','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid . "')");
		   						
		   						//error_log("INSERT INTO Part (PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$file_name','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid. "')");

							   	if($result === TRUE) {
							   		$invresult = mysqli_query($mysqli, "INSERT INTO sinventory (StQuantity, StoreID, PartNo) VALUES ('1','1','$partno')");

						   			if($invresult === TRUE) {
						   				mysqli_close($mysqli);
						   				echo json_encode(array('Status' => "SUCCESS"));
							   		}
							   		else {
							   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");
							   			unlink("../img/" . $file_name);

							   			mysqli_close($mysqli);
							   			echo json_encode(array('Status' => "Couldn't add Car inventory!"));
							   		}

							   		/*
							   		$carresult = mysqli_query($mysqli, "INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

							   		//error_log("INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

							   		if($carresult === TRUE) {
							   			$invresult = mysqli_query($mysqli, "INSERT INTO sinventory (StQuantity, StoreID, PartNo) VALUES ('0','1','$partno')");

							   			if($invresult === TRUE) {
							   				mysqli_close($mysqli);
							   				echo json_encode(array('Status' => "SUCCESS"));
								   		}
								   		else {
								   			$delpart = mysqli_query($mysqli, "DELETE FROM CarInfo WHERE PartNo = '$partno'");
								   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");
								   			unlink("../img/" . $file_name);

								   			mysqli_close($mysqli);
								   			echo json_encode(array('Status' => "Couldn't add Car inventory!"));
								   		}
							   		}
							   		else {
							   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");
							   			unlink("../img/" . $file_name);

							   			mysqli_close($mysqli);
							   			echo json_encode(array('Status' => "Couldn't add Car Info!"));
							   		}
							   		*/
							   	}
							   	else {
							   		unlink("../img/" . $file_name);

							   		mysqli_close($mysqli);
							   		echo json_encode(array('Status' => "Couldn't add new Part!"));
							   	}
							}
						}
					}
					else {
						echo json_encode(array('Status' => "Invalid image type or image file size greater than 500 KB!"));
					}
				}
				else {
					$result = mysqli_query($mysqli, "INSERT INTO Part (PartNo, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid . "')");
		   						
					//error_log("INSERT INTO Part (PartNo, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid . "')");

				   	if($result === TRUE) {
				   		$invresult = mysqli_query($mysqli, "INSERT INTO sinventory (StQuantity, StoreID, PartNo) VALUES ('1','1','$partno')");

			   			if($invresult === TRUE) {
			   				mysqli_close($mysqli);
			   				echo json_encode(array('Status' => "SUCCESS"));
				   		}
				   		else {
				   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");

				   			mysqli_close($mysqli);
				   			echo json_encode(array('Status' => "Couldn't add Car inventory!"));
				   		}
			   			/*
				   		$carresult = mysqli_query($mysqli, "INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

				   		//error_log("INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

				   		if($carresult === TRUE) {
				   			$invresult = mysqli_query($mysqli, "INSERT INTO sinventory (StQuantity, StoreID, PartNo) VALUES ('0','1','$partno')");

				   			if($invresult === TRUE) {
				   				mysqli_close($mysqli);
				   				echo json_encode(array('Status' => "SUCCESS"));
					   		}
					   		else {
					   			$delpart = mysqli_query($mysqli, "DELETE FROM CarInfo WHERE PartNo = '$partno'");
					   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");

					   			mysqli_close($mysqli);
					   			echo json_encode(array('Status' => "Couldn't add Car inventory!"));
					   		}
				   		}
				   		else {
				   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");

				   			mysqli_close($mysqli);
				   			echo json_encode(array('Status' => "Couldn't add Car Info!"));
				   		}
				   		*/
				   	}
				   	else {
				   		mysqli_close($mysqli);
				   		echo json_encode(array('Status' => "Couldn't add new Part!"));
				   	}
				}
			}
		}
	}
	else {
		echo json_encode(array('Status' => "FAIL"));
	}
?>