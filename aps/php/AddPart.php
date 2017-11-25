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
   			$make = $_POST['carMake'];
			$model = $_POST['carModel'];
			$miny = $_POST['carMinYear'];
			$maxy = $_POST['carMaxYear'];
			$partno = $_POST['partno'];
			$pname = $_POST['pname'];
			$pcompany = $_POST['pcompany'];
			$price = $_POST['pprice'];
			$subcatid = $_POST['psubcatid'];
			$warrantyid = $_POST['pwarrantyid'];

			if(empty("$make") === TRUE)
			{
			   echo "<div class='alert alert-danger'><div class='alert alert-danger'><span>Error: No Make!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$model") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No Model!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$miny") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No CarMinYear!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$maxy") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No CarMaxYear!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$partno") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No PartNo!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$pname") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No Pname!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$pcompany") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No PCompany!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$price") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No Price!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$subcatid") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No SubCatID!</span></div>";
			   mysqli_close($mysqli);
			}
			elseif(empty("$warrantyid") === TRUE)
			{
			   echo "<div class='alert alert-danger'><span>Error: No Warranty!</span></div>";
			   mysqli_close($mysqli);
			}
			else {
				$validextensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = end($temporary);
				
				//error_log($file_extension);

				if(!empty($file_extension)) {
					if ((($_FILES["file"]["type"] == "image/png") || 
						($_FILES["file"]["type"] == "image/jpg") || 
						($_FILES["file"]["type"] == "image/jpeg")) && 
						($_FILES["file"]["size"] < 100000) && 
						in_array($file_extension, $validextensions)) {

						if ($_FILES["file"]["error"] > 0) {
							echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
						}
						else {
							$file_name = $_POST['partno'] . "_" . time() . "_" . uniqid(mt_rand(), true) . "." . $file_extension;

							if (file_exists("img/" . $file_name)) {
								echo "<div class='alert alert-danger'><span>Error: Couldn't upload image!</span></div>";
							}
							else {
								move_uploaded_file($_FILES["file"]["tmp_name"], "img/" . $file_name);

								$result = mysqli_query($mysqli, "INSERT INTO Part (PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$file_name','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid . "')");
		   						
		   						//error_log("INSERT INTO Part (PartNo, PImage, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$file_name','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid. "')");

							   	if($result === TRUE) {
							   		$carresult = mysqli_query($mysqli, "INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

							   		//error_log("INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

							   		if($carresult === TRUE) {
							   			$invresult = mysqli_query($mysqli, "INSERT INTO sinventory (StQuantity, StoreID, PartNo) VALUES ('10','1','$partno')");

							   			if($invresult === TRUE) {
							   				mysqli_close($mysqli);
							   				echo "<div class='alert alert-success'><span>Success: New Part Added!</span></div>";
								   		}
								   		else {
								   			$delpart = mysqli_query($mysqli, "DELETE FROM CarInfo WHERE PartNo = '$partno'");
								   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");
								   			unlink("img/" . $file_name);

								   			mysqli_close($mysqli);
								   			echo "<div class='alert alert-danger'><span>Error: Couldn't add Car inventory!</span></div>";
								   		}
							   		}
							   		else {
							   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");
							   			unlink("img/" . $file_name);

							   			mysqli_close($mysqli);
							   			echo "<div class='alert alert-danger'><span>Error: Couldn't add Car Info!</span></div>";
							   		}
							   	}
							   	else {
							   		unlink("img/" . $file_name);

							   		mysqli_close($mysqli);
							   		echo "<div class='alert alert-danger'><span>Error: Couldn't add new Part!</span></div>";
							   	}
							}
						}
					}
					else {
						echo "<div class='alert alert-danger'><span>Error: Invalid file Size or file Type!</span></div>";
					}
				}
				else {
					$result = mysqli_query($mysqli, "INSERT INTO Part (PartNo, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid . "')");
		   						
					//error_log("INSERT INTO Part (PartNo, Pname, PCompany, Price, SubCatID, WarrantyID) VALUES ('$partno','$pname','$pcompany','" . (double)$price . "','$subcatid','" . (int)$warrantyid . "')");

				   	if($result === TRUE) {
				   		$carresult = mysqli_query($mysqli, "INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

				   		//error_log("INSERT INTO CarInfo (Make, Model, MinYear, MaxYear, PartNo) VALUES ('$make','$model','".(int)$miny."','".(int)$maxy."','$partno')");

				   		if($carresult === TRUE) {
				   			$invresult = mysqli_query($mysqli, "INSERT INTO sinventory (StQuantity, StoreID, PartNo) VALUES ('10','1','$partno')");

				   			if($invresult === TRUE) {
				   				mysqli_close($mysqli);
				   				echo "<div class='alert alert-success'><span>Success: New Part Added!</span></div>";
					   		}
					   		else {
					   			$delpart = mysqli_query($mysqli, "DELETE FROM CarInfo WHERE PartNo = '$partno'");
					   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");

					   			mysqli_close($mysqli);
					   			echo "<div class='alert alert-danger'><span>Error: Couldn't add Car inventory!</span></div>";
					   		}
				   		}
				   		else {
				   			$delpart = mysqli_query($mysqli, "DELETE FROM Part WHERE PartNo = '$partno'");

				   			mysqli_close($mysqli);
				   			echo "<div class='alert alert-danger'><span>Error: Couldn't add Car Info!</span></div>";
				   		}
				   	}
				   	else {
				   		mysqli_close($mysqli);
				   		echo "<div class='alert alert-danger'><span>Error: Couldn't add new Part!</span></div>";
				   	}
				}
			}
		}
	}
?>