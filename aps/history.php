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

<body ng-controller="histCtrl">
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
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>OrderID</th>
						<th>Inventory</th>
					</tr>
				</thead>
				<tbody>
					<tr class="ng-cloak" ng-repeat="(key, value) in orders | groupBy: '[OrderID,OrdStatus,OrdDate]'">
					    <td>
					    	<table class="table table-bordered table-striped table-condensed">
					    		<tr class="row">
					    			<td class="col-md-4">Order ID:</td>
					    			<td class="col-md-8">{{key.split(',')[0]}}</td>
					    		</tr>
					    		<tr class="row">
					    			<td class="col-md-4">Order Date:</td>
					    			<td class="col-md-8">{{key.split(',')[2]}}</td>
					    		</tr>
					    		<tr class="row">
					    			<td class="col-md-4">Status:</td>
					    			<td class="col-md-8" ng-class="{'alert alert-info': key.split(',')[1] === 'Processing', 'alert alert-danger': key.split(',')[1] === 'Cancelled', 'alert alert-warning': key.split(',')[1] === 'Shipped', 'alert alert-success': key.split(',')[1] === 'Delivered'}">{{key.split(',')[1]}}</td>
					    		</tr>
					    			
					    		<tr class="row" ng-hide="{{key.split(',')[1] != 'Processing'}}">
					    			<td class="col-md-4" style="vertical-align: middle;">Ordered by mistake?</td>
					    			<td class="col-md-8" style="vertical-align: middle;">
					    				<button type="button" id="{{ key.split(',')[0] }}" ng-disabled="{{key.split(',')[1] != 'Processing'}}" onclick="$('#cancelModal').modal('show')" ng-click="setOrder(key.split(',')[0])" class="btn btn-danger">
											Cancel Order
										</button>
					    			</td>
					    		</tr>
					    	</table>
					    </td>
					    <td>
						    <table class="table table-bordered table-striped table-condensed">
						    	<thead>
						    		<tr class="row">
						    			<th>Part Number</th>
						    			<th>Image</th>
						    			<th>Part Name</th>
						    			<th>Quantity</th>
						    			<th>Price</th>
						    		</tr>
						    	</thead>
						    	<tbody>
							        <tr class="ng-cloak row" ng-repeat="item in value" ng-init="total = 0" ng-init="qty = 0">
							            <td class="col-md-2" align="left" style="vertical-align: middle;">{{ item.PartNo }}</td>
										<td class="col-md-2" align="center" style="vertical-align: middle;"><img class="img-responsive" ng-src='img/{{ item.PImage }}' alt='{{ item.Pname }}' height="100" width="100"></img></td>
										<td class="col-md-4" align="left" style="vertical-align: middle;"><a href="part.php?partno={{item.PartNo}}">{{ item.PCompany }} {{ item.Pname }}</a></td>
										<td class="col-md-2" align="center" style="vertical-align: middle;" ng-init="$parent.qty = $parent.qty + (item.OrQuantity)">{{ item.OrQuantity }}</td>
										<td class="col-md-2" align="left" style="vertical-align: middle;" ng-init="$parent.total = $parent.total + (item.PartsCost)">${{ item.PartsCost.toFixed(2) }}</td>
							        </tr>
							        <tr class="info row">
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

			<a id="back-to-top" href="javascript:void(0)" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">
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
            <a href="javascript:void(0)" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-success">Cancel</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade success-popup" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="cancelModal">Cancel Order</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead">Are you sure you want to cancel your order?</p>
            <button type="button" onclick="$('#cancelModal').modal('hide');" ng-click="cancelOrder()" class="rd_more btn btn-danger">Yes</button>
            <button type="button" onclick="$('#cancelModal').modal('hide');" class="rd_more btn btn-success">No</button>
          </div>
        </div>
      </div>
    </div>

     <div class="modal fade success-popup" id="failcheck" tabindex="-1" role="dialog" aria-labelledby="failCheckLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="failCheckLabel">Cancel Order</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/fail.png'/><br/>Cancel Order Failed! <br/> <span id="failstatus"></span></p>
            <a href="javascript:void(0)" onclick="$('#failcheck').modal('hide');" class="rd_more btn btn-default">Close</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade success-popup" id="cancCheck" tabindex="-1" role="dialog" aria-labelledby="cancCheckLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="cancCheck">Cancel Order</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/success.png'/><br/>Cancel Order Successful!</p>
            <a href="javascript:void(0)" onclick="$('#cancCheck').modal('hide');" class="rd_more btn btn-default">Close</a>
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

			$scope.setOrder = function(order) {
				$scope.cancelOrderNo = order;
			}

			
			$scope.cancelOrder = function() {
				//console.log($scope.cancelOrderNo);
				var queryResult = "";
				
				$http.get("php/CancelOrder.php",{params:{"orderNo": $scope.cancelOrderNo}}).then(function (response) {
				    queryResult = JSON.stringify(response.data.records);
					
					if(queryResult == "[{\"Status\":\"SUCCESS\"}]"){

						$('#cancCheck').modal('show');
						
						setTimeout(function(){
							$scope.getOrders();
						}, 0);
					}
					else{
						$('#failstatus').text(response.data.records[0].Status);
						$('#failcheck').modal('show');
					}			
				});	

				$scope.cancelOrderNo = ""
				console.log($scope.cancelOrderNo);
			}		
		});
	</script>
</body>
</html>