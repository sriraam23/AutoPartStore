<?php
  include 'dbconfig.php';

  $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  
  if (!mysqli_connect_errno()) {
    $username = $_GET['username'];
    $firstname = $_GET['firstname'];
    $lastname = $_GET['lastname'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $street = $_GET['street'];
    $city = $_GET['city'];
    $state = $_GET['state'];
    $zip = $_GET['zip'];
    $password = $_GET['password'];

    $result = mysqli_query($mysqli, "INSERT INTO `Customer` (`Username`, `Fname`, `Lname`, `Street`, `City`, `State`, `Zipcode`, `Phone`, `Email`) VALUES ('$username','$firstname','$lastname', '$street', '$city', '$state', '$zip', '$phone', '$email')");

    //error_log("INSERT INTO `Customer` (`Username`, `Fname`, `Lname`, `Street`, `City`, `State`, `Zipcode`, `Phone`, `Email`) VALUES ('$username','$firstname','$lastname', '$street', '$city', '$state', '$zip', '$phone', '$email')");

    if($result) {
      $userresult = mysqli_query($mysqli, "INSERT INTO `users` (`Username`, `Password`) VALUES ('$username', '$password')");

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
  else {
      mysqli_close($mysqli);

      echo "{\"records\":[{\"Status\":\"FAIL\"}]}";
      exit();
    }
?>