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
        <div class="col-md-8 col-md-offset-2 text-center">
      		<form class="form-horizontal" role="form" data-toggle="validator">
            <fieldset>
              <div class="form-group has-feedback"">
                <label for="username" class="col-md-4 control-label">Username</label>
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" data-minlength="6" data-error="Incorrect Length" required>
                  </div>
                </div>
                <div class="col-md-4 text-left">
                  <span class="help-block with-errors" />
                </div>
              </div>

              <div class="form-group">
                <label for="fristname" class="col-md-4 control-label" >First Name</label> 
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" id="fristname" name="fristname" placeholder="First Name" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-md-4 control-label" >Last Name</label> 
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-4 control-label" >E-Mail</label> 
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail Address" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="phone" class="col-md-4 control-label">Phone #</label>  
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="(845)555-1212">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="street" class="col-md-4 control-label">Address</label>  
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input id="street" name="street" placeholder="Address" class="form-control" type="text">
                  </div>
                </div>
              </div>
   
              <div class="form-group">
                <label foir="city" class="col-md-4 control-label">City</label>  
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input id="city" name="city" placeholder="city" class="form-control"  type="text">
                  </div>
                </div>
              </div>
     
              <div class="form-group"> 
                <label id="state" class="col-md-4 control-label">State</label>
                <div class="col-md-4 selectContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                    <select id="state" name="state" class="form-control selectpicker" >
                      <option value="" >Please select your state</option>
                      <option value="Alabama">Alabama</option>
                      <option value="Alaska">Alaska</option>
                      <option value="Arizona">Arizona</option>
                      <option value="Arkansas">Arkansas</option>
                      <option value="California">California</option>
                      <option value="Colorado">Colorado</option>
                      <option value="Connecticut">Connecticut</option>
                      <option value="Delaware">Delaware</option>
                      <option value="District of Columbia">District of Columbia</option>
                      <option value="Florida">Florida</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Hawaii">Hawaii</option>
                      <option value="Idaho">Idaho</option>
                      <option value="Illinois">Illinois</option>
                      <option value="Indiana">Indiana</option>
                      <option value="Iowa">Iowa</option>
                      <option value="Kansas">Kansas</option>
                      <option value="Kentucky">Kentucky</option>
                      <option value="Louisiana">Louisiana</option>
                      <option value="Maine">Maine</option>
                      <option value="Maryland">Maryland</option>
                      <option value="Massachusetts">Massachusetts</option>
                      <option value="Michigan">Michigan</option>
                      <option value="Minnesota">Minnesota</option>
                      <option value="Mississippi">Mississippi</option>
                      <option value="Missouri">Missouri</option>
                      <option value="Montana">Montana</option>
                      <option value="Nebraska">Nebraska</option>
                      <option value="Nevada">Nevada</option>
                      <option value="New Hampshire">New Hampshire</option>
                      <option value="New Jersey">New Jersey</option>
                      <option value="New Mexico">New Mexico</option>
                      <option value="New York">New York</option>
                      <option value="North Carolina">North Carolina</option>
                      <option value="North Dakota">North Dakota</option>
                      <option value="Ohio">Ohio</option>
                      <option value="Oklahoma">Oklahoma</option>
                      <option value="Oregon">Oregon</option>
                      <option value="Pennsylvania">Pennsylvania</option>
                      <option value="Rhode Island">Rhode Island</option>
                      <option value="South Carolina">South Carolina</option>
                      <option value="South Dakota">South Dakota</option>
                      <option value="Tennessee">Tennessee</option>
                      <option value="Texas">Texas</option>
                      <option value="Uttah">Uttah</option>
                      <option value="Vermont">Vermont</option>
                      <option value="Virginia">Virginia</option>
                      <option value="Washington">Washington</option>
                      <option value="West Virginia">West Virginia</option>
                      <option value="Wisconsin">Wisconsin</option>
                      <option value="Wyoming">Wyoming</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="zip" class="col-md-4 control-label">Zip Code</label>  
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input id="zip" name="zip" placeholder="Zip Code" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" name="password" placeholder="Password" class="form-control"  type="password" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="cpassword" class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control"  type="password" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-2" style="text-align: left;">
                  <button type="submit" id="register" name="register" class="btn btn-primary" >Register <span class="glyphicon glyphicon-send"></span></button>
                </div>
                <div class="col-md-2" style="text-align: left;">
                  <button type="button" id="cancel" name="cancel" class="btn" >Cancel <span class="glyphicon glyphicon-remove"></span></button>
                </div>
              </div>
            </fieldset>
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
