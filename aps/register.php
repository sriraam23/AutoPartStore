<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
    <meta name="description" content="Autopart Store" />
    <meta name="author" content="Kartheek Kopparapu (kxk060100)" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    
    <link rel="icon" type="image/png" href="img/favicon.ico" />

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/totop.js"></script>
    <script type="text/javascript" src="js/validator.min.js"></script>

    <title>Autopart Store Registration</title>
    <style>
      html, body, .container-table {
        height: 100%;
      }
      .container-table {
        display: table;
      }
      .vertical-center-row {
        display: table-cell;
        vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <div class="container container-table">
      <div class="row vertical-center-row">
        <div class="col-md-4 col-md-offset-4 text-center">
      		<form class="form-horizontal" role="form" data-toggle="validator" ]>
            <div class="form-group has-feedback"">
              <label for="username" class="col-sm-4 control-label">Username</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" data-minlength="6" id="username" name="username" placeholder="Username" value="" data-error="Incorrect Length" required>
                <span class="help-block with-errors" />
              </div>
            </div>
            <div class="form-group">
              <label for="firstname" class="col-sm-4 control-label">First Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-4 control-label">Last Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="street" class="col-sm-4 control-label">Street</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-4 control-label">City</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="state" class="col-sm-4 control-label">State</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="state" name="state" placeholder="State" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="zipcode" class="col-sm-4 control-label">Zipcode</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="phone" class="col-sm-4 control-label">Phone</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-4 control-label">Email</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-4 control-label">Password</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label for="cpassword" class="col-sm-4 control-label">Confirm Password</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Password" value="" required>
              </div>
            </div>
        		<div class="form-group">
        			<div class="col-sm-2 col-sm-offset-4">
        				<input id="register" name="register" type="button" value="Register" class="btn btn-primary">
        			</div>
              <div class="col-sm-2 col-sm-offset-1">
                <input id="cancel" name="cancel" type="button" value="Cancel" class="btn btn-secondary">
              </div>
        		</div>
      		</form>
      	</div>
      </div>
    </div>

    <script type="text/javascript">
      $(function(){
        $('#cancel').click(function(){
          window.location='login.html'
        });

        $('#submit').click(function(){
          // Insert into Customer Table
          // Insert into Users Table
          // If all inserts are good then go to login.html
        });

        // Check Username php

        // Check Email php
      });
    </script>
  </body>
</html>
