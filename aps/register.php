<html ng-app="register" lang="en">
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
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>

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
          <div ng-controller="registerUserCtrl">
        		<form id="register" name="register" class="form-horizontal" role="form" data-toggle="validator" ng-submit="registerUser()">
              <fieldset>
                <div class="form-group has-feedback">
                  <label for="username" class="col-md-4 control-label">Username</label>
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" pattern=".{6,}" data-remote="/aps/php/CheckUser.php" data-pattern-error="Username must be minimum of 6 characters!" data-remote-error="Username already taken." required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="firstname" class="col-md-4 control-label">First Name</label> 
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="lastname" class="col-md-4 control-label">Last Name</label> 
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="email" class="col-md-4 control-label">E-Mail</label> 
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                      <input type="email" class="form-control" id="email" name="email" placeholder="abc@abc.abc" data-error="Enter valid email address." required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="phone" class="col-md-4 control-label">Phone #</label>  
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                      <input type="tel" class="form-control phone_us" id="phone" name="phone" maxlength="14" placeholder="(845) 555-1212">
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="street" class="col-md-4 control-label">Street</label>  
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                      <input id="street" name="street" placeholder="Street" class="form-control" type="text" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>
     
                <div class="form-group has-feedback">
                  <label for="city" class="col-md-4 control-label">City</label>  
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                      <input id="city" name="city" placeholder="City" class="form-control"  type="text" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>
       
                <div class="form-group has-feedback"> 
                  <label for="state" class="col-md-4 control-label">State</label>
                  <div class="col-md-4 selectContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                      <select id="state" name="state" class="form-control selectpicker" required>
                        <option value="">Please select your state</option>
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
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="zip" class="col-md-4 control-label">Zip Code</label>  
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                      <input id="zip" name="zip" placeholder="Zip Code" class="form-control" type="text" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="password" class="col-md-4 control-label">Password</label>
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                      <input id="password" name="password" placeholder="Password" class="form-control" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-pattern-error="Password must be atleast 8 characters, have 1 uppercase & 1 number" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label for="cpassword" class="col-md-4 control-label">Confirm Password</label>
                  <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                      <input id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control"  type="password" data-match="#password" data-match-error="Passwords don't match!" required>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <span class="help-block with-errors" />
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label class="col-md-4 control-label"></label>
                  <div class="col-md-2" style="text-align: left;">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Register <span class="glyphicon glyphicon-send"></span></button>
                  </div>
                  <div class="col-md-2" style="text-align: left;">
                    <button type="button" id="cancel" name="cancel" class="btn">Cancel <span class="glyphicon glyphicon-remove"></span></button>
                  </div>
                </div>
              </fieldset>
        		</form>
          </div>
      	</div>
      </div>
    </div>

    <div class="modal fade success-popup" id="succreg" tabindex="-1" role="dialog" aria-labelledby="succregLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="succregLabel">Thank You !</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead">Registation successfull!</p>
            <a href="login.php" class="rd_more btn btn-default">Go to Login</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade success-popup" id="failreg" tabindex="-1" role="dialog" aria-labelledby="failregLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="failregLabel">Sorry!</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead">Registation unsuccessfull!</p>
            <a href="#" onclick="$('#failreg').modal('hide');" class="rd_more btn btn-default">Close</a>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      var app = angular.module('register', []);
    
      app.controller('registerUserCtrl', function($scope, $http) {
        $scope.registerUser = function() {
          //$('#succreg').modal('show');
          
          if(!$("#submit").hasClass("disabled")) {
            var username = $('#username').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var street = $('#street').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zip = $('#zip').val();
            var password = $('#password').val();
            
            var queryResult = "";
            
            $http.get("php/RegisterNewUser.php",{params:{"username": username, "firstname": firstname, "lastname": lastname, "email": email, "phone": phone, "street": street, "city": city, "state": state, "zip": zip, "password": password}}).then(
                function (response) {
                  queryResult = JSON.stringify(response.data.records);
                  
                  if(queryResult == "[{\"Status\":\"SUCCESS\"}]")
                  {
                    $('#register')[0].reset();
                    $('#succreg').modal('show');
                  }
                  else 
                  {
                    $('#failreg').modal('show');
                  }
              }
            );
          }
        }
      });

      $(function(){
        $("#phone").mask("(999) 999-9999");
        $("#zip").mask("99999");

        $('#cancel').click(function(){
          window.location = 'login.php';
        });

        $('#succreg').on('hidden.bs.modal', function () {
          window.location = 'login.php'
        })

        /*
        $('#submit').click(function(){
          // Insert into Customer Table
          // Insert into Users Table
          // If all inserts are good then go to login.php
        });
        */
        // Check Username php

        // Check Email php
      });
    </script>
  </body>
</html>
