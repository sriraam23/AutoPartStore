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
	
	<title>Auto Parts Store - Buy Parts</title>

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
</head>

<body ng-controller="appCtrl">
	<div class="inner" ng-view>
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

						<?php endif; ?>

						<li><a href="about.php">About</a></li>
						<!--<li><a href="usercart.php">Cart</a></li>-->
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="usercart.php" class="navbar-brand">
								<span class="glyphicon glyphicon-shopping-cart"></span>
								<span class="ng-cloak" id="count">
									<span class="badge badge-notify">{{ cartitems }}</span>
								</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, <?php echo $_SESSION['sess_username'] ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="history.php">Order History</a></li>
								<li class="divider"></li>
								<li><a href="javascript:void(0)" onclick="$('#logoutModal').modal('show');"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			                </ul>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container">
			<div>
				<form id='filter' name="filter" class="form-inline">
					<fieldset>
						<div class="form-group">
							<label for="carMake">Select Make:</label>
							<select class="form-control" id="carMake" ng-model="string" ng-change="getCarModel()"> 
								<option value="">Select Make</option>
								<option class="ng-cloak" ng-repeat="a in make" value={{a.Make}}>{{a.Make}}</option>
							</select>
						</div>
						<div class="form-group">
							<label for="carModel">Select Model:</label>
							<select class="form-control" id="carModel" ng-model="carModel"> 
								<option value="">Select Model</option>
								<option class="ng-cloak" ng-repeat="a in model" value={{a.Model}}>{{a.Model}}</option>
							</select>
						</div>
						<div class="form-group">
							<label for="carYear">Enter Year:</label>
							<input type="text" pattern="\d*" class="form-control" id="carYear" placeholder="Car Model Year" ng-model="carYear">
						</div>
						<div class="form-group">
							<label for="partName">Keyword:</label>
							<input type="text" class="form-control" id="partName" placeholder="Keyword" ng-model="partName">
						</div>
						<div class="form-group">
							<button  class="btn btn-primary" id="getPartsInfo" ng-model="button" ng-click="getParts()">Filter</button>
						</div>
						<div class="form-group">
							<button  class="btn btn-warning" id="getPartsInfoClear" ng-model="button" ng-click="getPartsClear()">Clear</button>
						</div>
					</fieldset>
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
					<table id="partsList" class="table table-striped table-condensed">
						<thead>
							<tr class="row">
								<th ng-click="sort('PartNo')">Part Number
									<span class="glyphicon sort-icon" ng-show="sortKey=='PartNo'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
								<th>Part Image</th>
								<th ng-click="sort('PCompany')">Part Name
									<span class="glyphicon sort-icon" ng-show="sortKey=='PCompany'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
								<th ng-click="sort('Price')">Price
									<span class="glyphicon sort-icon" ng-show="sortKey=='Price'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
								<th ng-click="sort('SubCatID')">Subcategory
									<span class="glyphicon sort-icon" ng-show="sortKey=='SubCatID'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
								<th ng-click="sort('WarrantyID')">Warranty
									<span class="glyphicon sort-icon" ng-show="sortKey=='WarrantyID'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
								<th style="text-align:center;" ng-click="sort('Quantity')">Quantity
									<span class="glyphicon sort-icon" ng-show="sortKey=='Quantity'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
								<th style="text-align:center;"></th>
							</tr>
						</thead>
						<tbody>
							<tr dir-paginate="x in names|orderBy:sortKey:reverse|itemsPerPage:5" class="ng-cloak row" emit-last-repeater-element>
								<td class="col-md-1" align="left" style="vertical-align: middle;">{{ x.PartNo}}</td>
								<td class="col-md-1" align="center" style="vertical-align: middle;"><img class="img-responsive" ng-src='img/{{ x.PImage}}' alt='{{ x.Pname }}' height="100" width="100"></img></td>
								<td class="col-md-4" align="left" style="vertical-align: middle;"><a href="part.php?partno={{x.PartNo}}">{{ x.PCompany }} {{ x.Pname }}</a></td>
								<td class="col-md-1" align="left" style="vertical-align: middle;">${{ x.Price.toFixed(2) }}</td>
								<td class="col-md-2" align="left" style="vertical-align: middle;">{{ x.SubCatID }}</td>
								<td class="col-md-1" align="left" style="vertical-align: middle;">{{ x.WarrantyID }}</td>
								<td class="col-md-1" align="center" style="vertical-align: middle;">{{ x.Quantity }}</td>
								<td class="col-md-1" align="center" style="vertical-align: middle;" ng-if="x.Quantity > 0">
									<button type="button" id="{{ x.PartNo }}" ng-click="addToCart(x.PartNo, x.Price)" class="btn btn-success">
										<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart
									</button>
								</td>
								<td class="col-md-1" align="center" style="vertical-align: middle;" ng-if="x.Quantity < 1">
									<img class="img-responsive" id='{{ x.PartNo }}_qresult' name='{{ x.PartNo }}_qresult' class="qresult" src='img/sold_out.png' height="100" width="100"/>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="row">
					<div class="col-md-5 col-md-offset-4">
						<dir-pagination-controls max-size="10" direction-links="true" boundary-links="true"></dir-pagination-controls>
					</div>
				</div>

				<a id="back-to-top" href="javascript:void(0)" class="btn btn-primary btn-lg back-to-top" role="button">
					<span class="glyphicon glyphicon-chevron-up"></span>
				</a>
			</div>		
		</div>

		<div class="modal fade success-popup" id="succcheck" tabindex="-1" role="dialog" aria-labelledby="succCheckLabel">
	      <div class="modal-dialog modal-md" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h4 class="modal-title" id="succCheckLabel">Add to Cart</h4>
	          </div>
	          <div class="modal-body text-center">
	            <p class="lead"><img src='img/success.png'/><br/>Add to Cart Successful!</p>
	            <a href="javascript:void(0)" onclick="$('#succcheck').modal('hide');" class="rd_more btn btn-default">Continue Shopping</a>
	            <a href="usercart.php" class="rd_more btn btn-primary">Proceed to Checkout</a>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="modal fade success-popup" id="failcheck" tabindex="-1" role="dialog" aria-labelledby="failCheckLabel">
	      <div class="modal-dialog modal-md" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h4 class="modal-title" id="failCheckLabel">Add to Cart</h4>
	          </div>
	          <div class="modal-body text-center">
	            <p class="lead"><img src='img/fail.png'/><br/>Add to Cart Failed! <br/> <span id="failstatus"></span></p>
	            <a href="javascript:void(0)" onclick="$('#failcheck').modal('hide');" class="rd_more btn btn-default">Close</a>
	          </div>
	        </div>
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
	            <a href="javascript:void(0)" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-success">Cancel</a>
	          </div>
	        </div>
	      </div>
	    </div>
		
		<script>
			window.loading_screen = window.pleaseWait({
	        	logo: "",
	        	backgroundColor: '#FFF',
	        	loadingHtml: "<p class='loading-message'></p><div class='spinner'><div class='rect1'></div><div class='rect2'></div><div class='rect3'></div><div class='rect4'></div><div class='rect5'></div></div>"
			});

			var app = angular.module('aps', ['angularUtils.directives.dirPagination']);

			app.directive('emitLastRepeaterElement', function() {
				return function(scope) {
					if (scope.$last){
						scope.$emit('LastRepeaterElement');
					}
				};
			});
			
			app.controller('appCtrl', function($scope, $window, $http) {
				$scope.updateCartCount = function() {
					$http.get("php/GetCartItemCount.php",{}).then(function (response) {
					    $scope.cartitems = response.data;
					    $window.loading_screen.finish();
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

				$scope.getPartsClear = function() {
					$('#filter')[0].reset();
					$scope.getParts();
				}

				$scope.getCarMake();

				$scope.sort = function(keyname){
			        $scope.sortKey = keyname;   //set the sortKey to the param passed
			        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
			    }

				$scope.$on('LastRepeaterElement', function(){
					//$scope.sort('PartNo');
					$scope.updateCartCount();
				});

				$scope.addToCart = function(partNo, price) {
					//console.log(partNo);
					//console.log(price);
					var queryResult = "";
					
					$http.get("php/AddToCart.php",{params:{"partno": partNo, "price": price}}).then(function (response) {
					    queryResult = JSON.stringify(response.data.records);
						
						if(queryResult == "[{\"Status\":\"SUCCESS\"}]")
						{
							/*
							$('#' + partNo + '_qresult').attr("src","img/success.png");

							setTimeout(function(){
								$('#' + partNo + '_qresult').attr("src","img/empty.png");
							}, 1000);
							*/
							$('#succcheck').modal('show');

							setTimeout(function(){
								$scope.updateCartCount();
							}, 50);
						}
						else 
						{
							/*
							$('#' + partNo + '_qresult').attr("src","img/fail.png");

							setTimeout(function(){
								$('#' + partNo + '_qresult').attr("src","img/empty.png");
							}, 1000);
							*/
							
							$('#failstatus').text(response.data.records[0].Status);
							$('#failcheck').modal('show');

							setTimeout(function(){
								$scope.updateCartCount();
							}, 50);
						}
					});
				}
			});
		</script>
	</div>
</body>
</html>