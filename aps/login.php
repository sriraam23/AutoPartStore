<html ng-app="login" lang="en">
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

    <title>Autopart Store Login</title>
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
        <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <font size="+2"><strong>Autopart Store Sign in</strong></font>
              </div>
              <div class="panel-body" ng-controller="loginCtrl">
                <form role="form" data-toggle="validator" ng-submit="loginUser()">
                  <fieldset>
                    <div class="row">
                      <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <div id="login_error" class="alert alert-danger" role="alert" hidden>Invalid username or password!</div>
                        </div>
                        <div class="form-group has-feedback">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-user"></i>
                            </span> 
                            <input class="form-control" placeholder="Username" id="username" name="username" type="text" autofocus="" required>
                          </div>
                        </div>
                        <div class="form-group has-feedback">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-lock"></i>
                            </span>
                            <input class="form-control" placeholder="Password" id="password" name="password" type="password" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="panel-footer ">
                Don't have an account! <a href="register.php"> Sign Up Here </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      var app = angular.module('login', []);
    
      app.controller('loginCtrl', function($scope, $http) {
        $scope.loginUser = function() {
          //$('#succreg').modal('show');
          
          if(!$("#submit").hasClass("disabled")) {
            var username = $('#username').val();
            var password = $('#password').val();
            
            var queryResult = "";
            
            $http.get("php/LoginUser.php",{params:{"username": username, "password": password}}).then(
                function (response) {
                  queryResult = JSON.stringify(response.data.records);
                  
                  if(queryResult == "[{\"Status\":\"SUCCESS\"}]")
                  {
                    window.location = 'index.php'
                  }
                  else 
                  {
                    $('#login_error').show();
                  }
              }
            );
          }
        }
      });
    </script>
  </body>
</html>
