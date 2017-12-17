<html ng-app="login" lang="en">
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
    <meta name="description" content="Auto Parts Store" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" type="text/css" href="css/please-wait.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" >
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/angular-filter.min.js"></script>
    <script type="text/javascript" src="js/underscore-min.js"></script>
    <script type="text/javascript" src="js/totop.js"></script>

    <script type="text/javascript" src="js/dirPagination.js"></script>

    <script type="text/javascript" src="js/please-wait.min.js"></script>

    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/validator.min.js"></script>
    
    <link rel="icon" type="image/png" href="img/favicon.ico" />

    <title>Auto Parts Store - Sign In</title>
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
      h1 {
        display: inline;
      }

      body {
        padding-top: 0px;
      }
    </style>
  </head>
  <body ng-controller="loginCtrl">
    <div class="container container-table">
      <div class="row vertical-center-row">
        <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4">
            <a href="index.php" style="text-decoration: none;color: #444;">
              <div style="text-align: center;">
                <img style="width:64px;height:64px;" src="img/favicon.ico">
                <span style="font-size: 30px; vertical-align: middle;"><strong> Auto Parts Store </strong></span>
              </div>
            </a>
            <br/>
            <div class="panel panel-default">
              <div class="panel-heading">
                <font size="+2"><strong>Sign in</strong></font>
              </div>
              <div class="panel-body">
                <form role="form" ng-submit="loginUser()">
                  <fieldset>
                    <div class="row">
                      <div class="col-md-15 col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <div id="login_error" class="alert alert-danger" role="alert" hidden>Invalid username or password!</div>
                        </div>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-user"></i>
                            </span> 
                            <input class="form-control" placeholder="Username" id="username" name="username" type="text" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="password">Password</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="glyphicon glyphicon-lock"></i>
                            </span>
                            <input class="form-control" placeholder="Password" id="password" name="password" type="password" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <input id="loginbtn" type="submit" class="btn btn-primary btn-block" value="Sign in">
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="panel-footer ">
                Don't have an account? <a href="register.php"> Sign Up Here </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(function(){
      });

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
