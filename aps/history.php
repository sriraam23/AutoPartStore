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
	
	<title>Auto Part Store</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
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
						Auto Part Store  
					</span>
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Get Parts</a></li>
					
					<?php if($_SESSION['admin'] == 1) : ?>
			 		
			 		<li><a href="addpart.php">Add Part</a></li>
					<li><a href="updatepart.php">Update Part</a></li> 
					<li><a href="deletepart.php">Delete Part</a></li>
					<li><a href="about.php">About</a></li>

					<?php endif; ?>

					<li><a href="usercart.php">Cart</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, <?php echo $_SESSION['sess_username'] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="history.php">Order History</a></li>
		                </ul>
					</li>
					<li>
						<a href="logout.php" class="navbar-brand" onclick="return confirm('Are you sure you want to logout?');">
							<span class="glyphicon glyphicon-log-out"></span> Log out
						</a>
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
					<tr data-ng-repeat="(order, items) in groups">
					    <td data-label="OrderID">{{order}}</td>
					    <td>
						    <table class="table table-bordered table-striped table-condensed">
						    	<thead>
						    		<th>Part Number</th>
						    		<th>Image</th>
						    		<th>Part Name</th>
						    		<th>Price</th>
						    		<th>Quantity</th>
						    	</thead>
						    	<tbody>
							        <tr data-ng-repeat="item in items">
							            <td>{{ item.PartNo}}</td>
										<td><img ng-src='img/{{ item.PImage}}' alt='{{ item.Pname }}' height="100" width="100"></img></td>
										<td>{{ item.PCompany }} {{ item.PName }}</td>
										<td>${{ item.PartsCost }}</td>
										<td>{{ item.OrQuantity }}</td>
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
	
	<script>
		var app = angular.module('history', []);

		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});
		
		app.controller('histCtrl', function($scope, $http) {
			$scope.getOrders = function() {
				$http.get("php/GetUserHistory.php", {params:{"username": <?php echo "'".$_SESSION['sess_username']."'";?>}}).then(function (response) {
					$scope.names = response.data.records;
					$scope.groups = _.groupBy($scope.names, "OrderID");
					console.log($scope.groups);
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