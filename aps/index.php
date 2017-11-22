<?php
	include 'php/CheckSession.php';
	include 'php/CheckAdmin.php';
?>
<html ng-app="aps" lang="en">
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
					<li class="active"><a href="index.php">Get Parts</a></li>
					
					<?php if($_SESSION['admin'] == 1) : ?>
			 		
			 		<li><a href="addpart.php">Add Part</a></li>
					<li><a href="updatepart.php">Update Part</a></li> 
					<li><a href="deletepart.php">Delete Part</a></li>
					<li><a href="about.php">About</a></li>

					<?php endif; ?>

					<li><a href="usercart.php">Cart</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li>
						<p class="navbar-text">
							<font size="+1">Hello, <?php echo $_SESSION['sess_username'] ?></font>
						</p> 
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
		<div ng-controller="appCtrl">
			<form class="form-inline">
				<div class="form-group">
					<label for="carMake">Select Make:</label>
					<select class="form-control" id="carMake" ng-model="string" ng-change="getCarModel()"> 
						<option value="">Select Make</option>
						<option ng-repeat="a in make" value={{a.Make}}>{{a.Make}}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="carModel">Select Model:</label>
					<select class="form-control" id="carModel"> 
						<option value="">Select Model</option>
						<option ng-repeat="a in model" value={{a.Model}}>{{a.Model}}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="carYear">Enter Year:</label>
					<input type="text" pattern="\d*" minlength="4" maxlength="4" class="form-control" id="carYear" placeholder="Car Model Year" ng-model="carYear">
				</div>
				<div class="form-group">
					<button  class="btn btn-primary" id="getPartsInfo" ng-model="button" ng-click="getParts()">Filter</button>
				</div>
			</form>
			
			<br/>
			
			<label>Search: <input ng-model="searchText"></label>
			<table class="table table-hover">
				<tr>
					<th>Part Number</th>
					<th>Part Image</th>
					<th>Part Name</th>
					<th>Price</th>
					<th>Sub Category</th>
					<th>Warranty</th>
					<th>Quantity</th>
					<th>Add To Cart</th>
				</tr>
				<tr ng-repeat="x in names | filter:searchText" emit-last-repeater-element>
					<td>{{ x.PartNo}}</td>
					<td><img ng-src='img/{{ x.PImage}}' alt='{{ x.Pname }}' height="100" width="100"></img></td>
					<td>{{ x.PCompany }} {{ x.Pname }}</td>
					<td>${{ x.Price }}</td>
					<td>{{ x.SubCatID }}</td>
					<td>{{ x.WarrantyID }}</td>
					<td>{{ x.Quantity }}</td>
					<td ng-if="x.Quantity > 0"><input type="button" id="{{ x.PartNo }}" ng-click="addToCart(x.PartNo)" class="btn btn-default" value="Add to Cart"><span><img id='{{ x.PartNo }}_qresult' name='{{ x.PartNo }}_qresult' class="qresult" src='img/empty.png' width="25px" height="25px"/></span></td>
					<td ng-if="x.Quantity < 1"><img id='{{ x.PartNo }}_qresult' name='{{ x.PartNo }}_qresult' class="qresult" src='img/sold_out.png' width="100" height="100"/></td>
				</tr>
			</table>
				
			<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		</div>		
	</div>
	
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/totop.js"></script>
	
	<script>
		var app = angular.module('aps', []);

		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});
		
		app.controller('appCtrl', function($scope, $http) {
			$scope.getCarMake = function() {
				$http.get("php/GetCarMakeInfo.php").then(function (response) {$scope.make = response.data.records;});
				//$scope.carYear = "";
			};
			
			$scope.getCarModel = function() {
				var make = $('#carMake').val();
				$http.get("php/GetCarModelInfo.php",{params:{"make": make}}).then(function (response) {$scope.model = response.data.records;});
				//$scope.carYear = "";
			};
			
			$scope.getParts = function() {
				var make = $('#carMake').val();
				var model = $('#carModel').val();
				var year = $('#carYear').val();
				
				//console.log(make + "," + model + "," + year);

				$http.get("php/GetPartsFromCarInfo.php",  {
					params:{"make": make, "model": model, "year": year}
				}).then(function (response) {
					$scope.names = response.data.records;
				});
			};
			
			$scope.getCarMake();
			
			$scope.getParts();

			$scope.$on('LastRepeaterElement', function(){
				//$(".qty").mask("99999");
				$(".qty").keypress(function (e) {
					//if the letter is not digit then display error and don't type anything
					if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						//display error message
						//console.log("Digits Only");
						return false;
					}
			   });
			});

			$scope.addToCart = function(partNo) {
				//console.log(partNo);
				var queryResult = "";
				
				$http.get("php/AddToCart.php",{params:{"partno": partNo, "username": <?php echo "'".$_SESSION['sess_username']."'";?>}}).then(function (response) {
				    queryResult = JSON.stringify(response.data.records);
					
					if(queryResult == "[{\"Status\":\"SUCCESS\"}]")
					{
						$('#' + partNo + '_qresult').attr("src","img/success.png");

						setTimeout(function(){
							$('#' + partNo + '_qresult').attr("src","img/empty.png");
						}, 500);
					}
					else 
					{
						$('#' + partNo + '_qresult').attr("src","img/fail.png");

						setTimeout(function(){
							$('#' + partNo + '_qresult').attr("src","img/empty.png");
						}, 500);
					}
				});
				
			}
		});
	</script>
</body>
</html>