<?php
	include 'php/CheckSession.php';
	include 'php/CheckAdmin.php';	
?>
<html ng-app="cart" lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="en" />
	<meta name="google" content="notranslate" />
	
	<title>Auto Parts Store - User Cart</title>

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

<body ng-controller="cartCtrl">
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
					<li class="active">
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
			<table class="table table-hover table-condensed">
				<thead>
					<tr class="row">
						<th>Part Number</th>
						<th>Part Image</th>
						<th>Part Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr class="ng-cloak row" ng-repeat="x in names" emit-last-repeater-element ng-init="total = 0" ng-init="pqty = 0">
						<td class="col-md-1" align="center" style="vertical-align: middle;">{{ x.PartNo }}</td>
						<td class="col-md-1" align="center" style="vertical-align: middle;">
							<img class="img-responsive" ng-src='img/{{ x.PImage}}' alt='{{ x.Pname }}' height="100" width="100"></img>
						</td>
						
						<td class="col-md-4" align="left" style="vertical-align: middle;"><a href="part.php?partno={{x.PartNo}}">{{ x.PCompany }} {{ x.Pname }}</a></td>

						<td class="col-md-1" align="left" style="vertical-align: middle;" ng-init="$parent.total = $parent.total + (x.TPPrice)">${{ x.TPPrice.toFixed(2) }}</td>
						
						<td class="col-md-3" align="left" style="vertical-align: middle; text-align: left;" ng-init="$parent.pqty = $parent.pqty + (x.PartQuantity)">
							<input type='text' style="text-align:center;" class="col-xs-3 qty" id='{{ x.PartNo }}_qty' name='{{ x.PartNo }}_qty' value='{{ x.PartQuantity }}'/>
						</td>
						
						<td class="col-md-1" align="right" style="vertical-align: middle; text-align: right;">
							<input type='button' class="btn btn-success" id="{{ x.PartNo }}" ng-click="updateCart(x.PartNo)" value="Update Cart"/>
						</td>
						<td class="col-md-1" align="right" style="vertical-align: top;">
							<a href="javascript:void(0)" ng-click="deleteFromCart(x.PartNo)">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
						</td>
					</tr>
					<tr class="info row">
						<th align="left">Total</th>
						<th></th>
						<th></th>
						<th class="ng-cloak" align="left" style="vertical-align: middle;">${{ total.toFixed(2) }}</th>
						<th class="ng-cloak" align="left" style="vertical-align: middle;">
							<input type='text' class="col-xs-3 qty" style="text-align:center;border: 0;box-shadow: none;background-color:rgba(0,0,0,0);" value='{{ pqty }}' readonly>
						</th>
						<th></th>
						<th></th>

					</tr>
				</tbody>
				<tfoot>
					<tr class="row">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th align="right" style="vertical-align: middle; text-align: right;">
							<input type='button' class="btn btn-warning cart" id="emptycart" ng-click="emptycart()" value="Empty Cart"/>
						</th>
						<th align="right" style="vertical-align: middle; text-align: right;">
							<input type='button' class="btn btn-primary cart" id="checkout" ng-click="checkout()" value="Checkout"/>
						</th>

					</tr>
				</tfoot>
			</table>
				
			<a id="back-to-top" href="javascript:void(0)" class="btn btn-primary btn-lg back-to-top" role="button">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		</div>		
	</div>

	<div class="modal fade success-popup" id="succcheck" tabindex="-1" role="dialog" aria-labelledby="succCheckLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="succCheckLabel">Checkout</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/success.png'/>Checkout Successful!</p>
            <a href="javascript:void(0)" onclick="$('#succcheck').modal('hide');" class="rd_more btn btn-default">Close</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade success-popup" id="failcheck" tabindex="-1" role="dialog" aria-labelledby="failCheckLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="failCheckLabel">Checkout</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/fail.png'/>Checkout Failed! <span id="failstatus"></span></p>
            <a href="javascript:void(0)" onclick="$('#failcheck').modal('hide');" class="rd_more btn btn-default">Close</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade success-popup" id="succupdate" tabindex="-1" role="dialog" aria-labelledby="succUpdateLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="succUpdateLabel">Update Cart</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/success.png'/>Update Cart Successful!</p>
            <a href="javascript:void(0)" onclick="$('#succupdate').modal('hide');" class="rd_more btn btn-default">Close</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade success-popup" id="failupdate" tabindex="-1" role="dialog" aria-labelledby="failUpdateLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="failUpdateLabel">Update Cart</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/fail.png'/>Update Cart Failed! <span id="failupstatus"></span></p>
            <a href="javascript:void(0)" onclick="$('#failupdate').modal('hide');" class="rd_more btn btn-default">Close</a>
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

		var app = angular.module('cart', []);
		
		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});

		app.controller('cartCtrl', function($scope, $window, $http) {
			$scope.updateCartCount = function() {
				$http.get("php/GetCartItemCount.php",{}).then(function (response) {
				    $scope.cartitems = response.data;
					//$('#count').html($scope.cartitems);
					//console.log($scope.cartitems);

					if($scope.cartitems == 0) {
						$('.cart').prop("disabled",true);
					}
					else {
						$('.cart').prop("disabled",false);
					}
				});

				$window.loading_screen.finish();
			}

			$scope.updateCartCount();

			$scope.getCart = function() {
				$scope.total = 0;
				$scope.pqty = 0;

				$http.get("php/GetUserCart.php", {params:{}}).then(function (response) {
					$scope.names = response.data.records;
				});

				setTimeout(function(){
					$scope.updateCartCount();
				}, 50);
			};

			$scope.getCart();
			
			$scope.$on('LastRepeaterElement', function(){
				//$(".qty").mask("99999");
				$scope.updateCartCount();

				$(".qty").keypress(function (e) {
					//if the letter is not digit then display error and don't type anything
					if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
						//display error message
						//console.log("Digits Only");
						return false;
					}
			   });
			});

			$scope.updateCart = function(partNo) {
				var qty = $('#' + partNo + '_qty').val();
				
				if(qty.length > 0) {
					var queryResult = "";
					
					$http.get("php/UpdateCart.php", {params:{"pquantity": qty, "partno": partNo}}).then(function (response) {
					    //queryResult = JSON.stringify(response.data.records);
					    $scope.updatestatus = response.data.records;
						queryResult = $scope.updatestatus[0].Status;

						
						if(queryResult.indexOf("SUCCESS") >= 0)
						{
							//console.log(queryResult);
							
							if(qty == '0') {
								$('#succupdate').modal('show');

								setTimeout(function(){
									$scope.getCart();
								}, 1000);

								setTimeout(function(){
									$scope.updateCartCount();
								}, 50);
							}
							else {
								/*
								$('#' + partNo + '_qresult').attr("src","img/success.png");

								setTimeout(function(){
									$scope.getCart();
								}, 1000);
								*/

								$('#succupdate').modal('show');

								setTimeout(function(){
									$scope.names = "";
									$scope.getCart();
								}, 1000);

								setTimeout(function(){
									$scope.updateCartCount();
								}, 50);
							}
							
						}
						else 
						{
							//console.log("FAIL: " + queryResult);
							/*
							$('#' + partNo + '_qresult').attr("src","img/fail.png");
							
							setTimeout(function(){
								$scope.getCart();
							}, 1000);
							*/
							$('#failupstatus').text(queryResult);
							$('#failupdate').modal('show');

							setTimeout(function(){
								$scope.getCart();
							}, 1000);

							setTimeout(function(){
								$scope.updateCartCount();
							}, 50);
						}
					});
				}
				else {
					/*
					$('#' + partNo + '_qresult').attr("src","img/fail.png");
					
					setTimeout(function(){
						$('#' + partNo + '_qresult').attr("src","img/empty.png");
					}, 1000);
					*/

					$('#failupdate').modal('show');

					setTimeout(function(){
						$scope.getCart();
					}, 1000);

					setTimeout(function(){
						$scope.updateCartCount();
					}, 50);
				}
			}

			$scope.deleteFromCart = function(partNo) {
				var queryResult = "";
				var qty = 0;

				$http.get("php/UpdateCart.php", {params:{"pquantity": qty, "partno": partNo}}).then(function (response) {
				    queryResult = JSON.stringify(response.data.records);
					
					if(queryResult == "[{\"Status\":\"SUCCESS\"}]")
					{
						//console.log(queryResult);
						
						if(qty == '0') {
							$scope.getCart();
						}
						else {
							$('#' + partNo + '_qresult').attr("src","img/success.png");

							setTimeout(function(){
								$scope.getCart();
							}, 1000);

							setTimeout(function(){
								$scope.updateCartCount();
							}, 50);
						}
						
					}
					else 
					{
						console.log("FAIL: " + queryResult);

						$('#' + partNo + '_qresult').attr("src","img/fail.png");
						
						setTimeout(function(){
							$scope.getCart();
						}, 1000);

						setTimeout(function(){
							$scope.updateCartCount();
						}, 50);
					}
				});
			}

			$scope.emptycart = function() {
				var queryResult = "";
				
				$http.get("php/EmptyCart.php", {params:{}}).then(function (response) {
					$scope.emptystatus = response.data.records;
					queryResult = $scope.emptystatus[0].Status;

					if(queryResult.indexOf("SUCCESS") >= 0) {
						//console.log(queryResult);
						//$('#successstatus').text(queryResult);
						//$('#succcheck').modal('show');
						$scope.getCart();
					}
					else {
						//console.log(queryResult);
						//$('#failstatus').text($queryResult);
						//$('#failcheck').modal('show');
						//console.log(queryResult);
					}
				});
			}

			$scope.checkout = function() {
				var queryResult = "";
				
				$http.get("php/Checkout.php", {params:{}}).then(function (response) {
					queryResult = JSON.stringify(response.data.records);
					
					if(queryResult == "[{\"Status\":\"SUCCESS\"}]") {
						$('#succcheck').modal('show');
						$scope.getCart();
					}
					else {
						$scope.failstatus = response.data.records;
						//console.log($scope.failstatus[0].Status);
						$('#failstatus').text($scope.failstatus[0].Status);
						$('#failcheck').modal('show');
						//console.log(queryResult);
					}
				});
			}
		});
	</script>
	</div>
</body>
</html>