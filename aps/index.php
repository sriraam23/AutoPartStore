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
	
	<title>Auto Parts Store</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/totop.js"></script>

	<script type="text/javascript" src="js/dirPagination.js"></script>
	
	<link rel="icon" type="image/png" href="img/favicon.ico" />
</head>

<body ng-controller="appCtrl">
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
					<li class="active"><a href="index.php">Buy Parts</a></li>
					
					<?php if($_SESSION['admin'] == 1) : ?>
			 		
			 		<li><a href="allparts.php">All Parts</a></li>
			 		<li><a href="addpart.php">Add Part</a></li>
					<li><a href="updatepart.php">Update Part</a></li> 
					<!--<li><a href="deletepart.php">Delete Part</a></li>-->
					<li><a href="about.php">About</a></li>

					<?php endif; ?>

					<!--<li><a href="usercart.php">Cart</a></li>-->
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="usercart.php" class="navbar-brand">
							<span class="glyphicon glyphicon-shopping-cart"></span> <span id="count"> {{ cartitems }} </span>
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
		<div>
			<form class="form-inline">
				<div class="form-group">
					<label for="carMake">Select Make:</label>
					<select class="form-control" id="carMake" ng-model="string" ng-change="getCarModel()"> 
						<option value="">Select Make</option>
						<option class="ng-cloak" ng-repeat="a in make" value={{a.Make}}>{{a.Make}}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="carModel">Select Model:</label>
					<select class="form-control" id="carModel"> 
						<option value="">Select Model</option>
						<option class="ng-cloak" ng-repeat="a in model" value={{a.Model}}>{{a.Model}}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="carYear">Enter Year:</label>
					<input type="text" pattern="\d*" minlength="4" maxlength="4" class="form-control" id="carYear" placeholder="Car Model Year" ng-model="carYear">
				</div>
				<div class="form-group">
					<label for="partName">Keyword:</label>
					<input type="text" class="form-control" id="partName" placeholder="Part Name" ng-model="partName">
				</div>
				<div class="form-group">
					<button  class="btn btn-primary" id="getPartsInfo" ng-model="button" ng-click="getParts()">Filter</button>
				</div>
			</form>
			
			<br/>
			<!--
			<form class="form-inline">
		        <div class="form-group">
		            <label >Search</label>
		            <input type="text" ng-model="search" class="form-control" placeholder="Search">
		        </div>
		    </form>
			-->
			<div class="table-responsive">
				<table id="partsList" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th ng-click="sort('PartNo')">Part Number
								<span class="glyphicon sort-icon" ng-show="sortKey=='PartNo'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th>Part Image</th>
							<th ng-click="sort('PCompany')">Part Name
								<span class="glyphicon sort-icon" ng-show="sortKey=='PCompany'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('Price')">Price
								<span class="glyphicon sort-icon" ng-show="sortKey=='Price'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('SubCatID')">Sub Category
								<span class="glyphicon sort-icon" ng-show="sortKey=='SubCatID'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('WarrantyID')">Warranty
								<span class="glyphicon sort-icon" ng-show="sortKey=='WarrantyID'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th ng-click="sort('Quantity')">Quantity
								<span class="glyphicon sort-icon" ng-show="sortKey=='Quantity'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
							<th>Add To Cart</th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="x in names|orderBy:sortKey:reverse|itemsPerPage:5" class="ng-cloak" emit-last-repeater-element>
							<td>{{ x.PartNo}}</td>
							<td align="center" style="vertical-align: middle;"><img ng-src='img/{{ x.PImage}}' alt='{{ x.Pname }}' height="100" width="100"></img></td>
							<td>{{ x.PCompany }} {{ x.Pname }}</td>
							<td>${{ x.Price }}</td>
							<td>{{ x.SubCatID }}</td>
							<td>{{ x.WarrantyID }}</td>
							<td>{{ x.Quantity }}</td>
							<td ng-if="x.Quantity > 0"><input type="button" id="{{ x.PartNo }}" ng-click="addToCart(x.PartNo)" class="btn btn-default" value="Add to Cart"><span><img id='{{ x.PartNo }}_qresult' name='{{ x.PartNo }}_qresult' class="qresult" src='img/empty.png' width="25px" height="25px"/></span></td>
							<td ng-if="x.Quantity < 1"><img id='{{ x.PartNo }}_qresult' name='{{ x.PartNo }}_qresult' class="qresult" src='img/sold_out.png' width="100" height="100"/></td>
						</tr>
					</tbody>
				</table>
				<dir-pagination-controls max-size="10" direction-links="true" boundary-links="true"></dir-pagination-controls>
			</div>
			<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		</div>		
	</div>

	<div class="modal fade success-popup" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="logoutModalLabel">Logout</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead">Are you sure you want to logout?</p>
            <a href="logout.php" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-danger">Ok</a>
            <a href="#" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-success">Cancel</a>
          </div>
        </div>
      </div>
    </div>
	
	<script>
		var app = angular.module('aps', ['angularUtils.directives.dirPagination']);

		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});
		
		app.controller('appCtrl', function($scope, $http) {
			$scope.updateCartCount = function() {
				$http.get("php/GetCartItemCount.php",{}).then(function (response) {
				    $scope.cartitems = response.data;
					//$('#count').html($scope.cartitems);
					//console.log($scope.cartitems);
				});
			}

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
				var name = $('#partName').val();
				
				//console.log(make + "," + model + "," + year);

				$http.get("php/GetPartsFromCarInfo.php",  {
					params:{"make": make, "model": model, "year": year, "name": name}
				}).then(function (response) {
					$scope.names = response.data.records;
				});

				setTimeout(function(){
					$scope.updateCartCount();
				}, 50);
			};
			
			$scope.getParts();

			$scope.getCarMake();

			$scope.sort = function(keyname){
		        $scope.sortKey = keyname;   //set the sortKey to the param passed
		        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
		    }

			$scope.$on('LastRepeaterElement', function(){
				//$scope.sort('PartNo');
				$scope.updateCartCount();
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
							$scope.updateCartCount();
						}, 1000);
					}
					else 
					{
						$('#' + partNo + '_qresult').attr("src","img/fail.png");

						setTimeout(function(){
							$('#' + partNo + '_qresult').attr("src","img/empty.png");
							$scope.updateCartCount();
						}, 1000);
					}
				});
			}
		});
	</script>
</body>
</html>