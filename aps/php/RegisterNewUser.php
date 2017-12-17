<?php
  include 'dbconfig.php';

  if (!mysqli_connect_errno()) {
    $username = trim($_GET['username']);
    $firstname = trim($_GET['firstname']);
    $lastname = trim($_GET['lastname']);
    $email = trim($_GET['email']);
    $phone = trim($_GET['phone']);
    $street = trim($_GET['street']);
    $city = trim($_GET['city']);
    $state = trim($_GET['state']);
    $zip = trim($_GET['zip']);
    $password = trim($_GET['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if(empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($street) || empty($city) || empty($state) || empty($zip) || empty($password)) {
      echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
      exit();
    }
    else {
      $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

      $result = mysqli_query($mysqli, "INSERT INTO `Customer` (`Username`, `Fname`, `Lname`, `Street`, `City`, `State`, `Zipcode`, `Phone`, `Email`) VALUES ('$username','$firstname','$lastname', '$street', '$city', '$state', '$zip', '$phone', '$email')");
      //error_log("INSERT INTO `Customer` (`Username`, `Fname`, `Lname`, `Street`, `City`, `State`, `Zipcode`, `Phone`, `Email`) VALUES ('$username','$firstname','$lastname', '$street', '$city', '$state', '$zip', '$phone', '$email')");

      if($result) {
        $userresult = mysqli_query($mysqli, "INSERT INTO `users` (`Username`, `Password`) VALUES ('$username', '$hashed_password')");

        if($userresult) {
          mysqli_close($mysqli);

          echo "{\"records\":[{\"Status\":\"SUCCESS\"}]}";
          exit();
         }
         else {
          mysqli_query($mysqli, "DELETE FROM `Customer` WHERE `Username` = '$username')");
          mysqli_close($mysqli);

          echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
          exit();
         }
      }
      else {
        mysqli_close($mysqli);

        echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
        exit();
      }
    }
  }
  else {
    echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
    exit();
  }
?>