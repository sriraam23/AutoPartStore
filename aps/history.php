<?php
	include 'php/CheckSession.php';
	include 'php/CheckAdmin.php';
?>
<html ng-app="history" lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="en" />
	<meta name="google" content="notranslate" />
	
	<title>Auto Parts Store - Order History</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/angular-filter.min.js"></script>
	<script type="text/javascript" src="js/underscore-min.js"></script>
	<script type="text/javascript" src="js/totop.js"></script>
		
	<link rel="icon" type="image/png" href="img/favicon.ico" />
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">
					<span style="padding-right: 10px">
						<img alt="Brand" src="./img/favicon.ico">
						Auto Parts Store  
					</span>
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Buy Parts</a></li>
					
					<?php if($_SESSION['admin'] == 1) : ?>
			 		
			 		<li><a href="allparts.php">All Parts</a></li>
			 		<li><a href="addpart.php">Add Part</a></li>
					<li><a href="updatepart.php">Update Part</a></li> 
					<!--<li><a href="deletepart.php">Delete Part</a></li>-->

					<?php endif; ?>

					<li><a href="about.php">About</a></li>
					<!--<li><a href="usercart.php">Cart</a></li>-->
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="usercart.php" class="navbar-brand">
							<span class="glyphicon glyphicon-shopping-cart"></span> <?php include 'php/GetCartItemCount.php' ?>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, <?php echo $_SESSION['sess_username'] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="history.php">Order History</a></li>
							<li class="divider"></li>
							<li><a href="#" onclick="$('#logoutModal').modal('show');"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		                </ul>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">
		<div ng-controller="histCtrl">
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<th>OrderID</th>
					<th>Inventory</th>
				</thead>
				<tbody>
					<tr class="ng-cloak" ng-repeat="(key, value) in orders | groupBy: '[OrderID,OrdStatus]'">
					    <td>
					    	<table class="table table-bordered table-striped table-condensed">
					    		<tr><td>OrderID:</td><td>{{key.split(',')[0]}}</td></tr>
					    		<tr><td>Status</td><td>{{key.split(',')[1]}}</td></tr>
					    	</table>
					    </td>
					    <td>
						    <table class="table table-bordered table-striped table-condensed">
						    	<thead>
						    		<th>Part Number</th>
						    		<th>Image</th>
						    		<th>Part Name</th>
						    		<th>Quantity</th>
						    		<th>Price</th>
						    	</thead>
						    	<tbody>
							        <tr class="ng-cloak" ng-repeat="item in value" ng-init="total = 0" ng-init="qty = 0">
							            <td align="left" style="vertical-align: middle;">{{ item.PartNo }}</td>
										<td align="center" style="vertical-align: middle;"><img ng-src='img/{{ item.PImage }}' alt='{{ item.Pname }}' height="100" width="100"></img></td>
										<td align="left" style="vertical-align: middle;">{{ item.PCompany }} {{ item.PName }}</td>
										<td align="center" style="vertical-align: middle;" ng-init="$parent.qty = $parent.qty + (item.OrQuantity)">{{ item.OrQuantity }}</td>
										<td align="left" style="vertical-align: middle;" ng-init="$parent.total = $parent.total + (item.PartsCost)">${{ item.PartsCost.toFixed(2) }}</td>
							        </tr>
							        <tr class="info">
      									<td><b>Total</b></td>
      									<td></td>
      									<td></td>
      									<td align="center" style="vertical-align: middle;">{{ qty }}</td>
      									<td align="left" style="vertical-align: middle;"><b>${{ total.toFixed(2) }}</b></td>
    								</tr>
								</tbody>
						    </table>
						</td>
					</tr>
				</tbody>
			</table>

			<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		</div>		
	</div>

	<div class="modal fade success-popup" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="logoutModalLabel">Logout</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead">Are you sure you want to logout?</p>
            <a href="php/logout.php" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-danger">Ok</a>
            <a href="#" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-success">Cancel</a>
          </div>
        </div>
      </div>
    </div>
	
	<script>
		var app = angular.module('history', ['angular.filter']);

		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});
		
		app.controller('histCtrl', function($scope, $http) {
			$scope.getOrders = function() {
				$http.get("php/GetUserHistory.php", {params:{}}).then(function (response) {
					$scope.orders = response.data.records;
					//console.log($scope.orders);
				});
			};
			
			$scope.getOrders();

			$scope.sort = function(keyname){
		        $scope.sortKey = keyname;   //set the sortKey to the param passed
		        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
		    }

			$scope.$on('LastRepeaterElement', function(){
				//$scope.sort('PartNo');
			});
		});
	</script>
</body>
</html>