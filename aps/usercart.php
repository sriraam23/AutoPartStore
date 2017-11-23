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
					<li><a href="index.php">Get Parts</a></li>
					
					<?php if($_SESSION['admin'] == 1) : ?>
			 		
			 		<li><a href="addpart.php">Add Part</a></li>
					<li><a href="updatepart.php">Update Part</a></li> 
					<li><a href="deletepart.php">Delete Part</a></li>
					<li><a href="about.php">About</a></li>

					<?php endif; ?>

					<li class="active"><a href="usercart.php">Cart</a></li>
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
		<div ng-controller="cartCtrl">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>Part Image</th>
					<th>Part Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Update Cart</th>
				</tr>
				</thead>
				<tbody>
				<tr ng-repeat="x in names" emit-last-repeater-element>
					<td><img ng-src='img/{{ x.PImage}}' alt='{{ x.Pname }}' height="100" width="100"></img></td>
					<td>{{ x.PCompany }} {{ x.Pname }}</td>
					<td>${{ x.Price }}</td>
					<td><input type='text' class="col-xs-2 qty" id='{{ x.PartNo }}_qty' name='{{ x.PartNo }}_qty' value='{{ x.PartQuantity }}'/></td>
					<td><input type="button" id="{{ x.PartNo }}" ng-click="updateCart(x.PartNo)" class="btn btn-default" value="Update Cart"/><span><img id='{{ x.PartNo }}_qresult' name='{{ x.PartNo }}_qresult' class="qresult" src='img/empty.png' width="25px" height="25px"/></span></td>
				</tr>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><input type="button" id="checkout" ng-click="checkout()" class="btn btn-primary" value="Checkout"/></th>
					</tr>
				</tfoot>
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
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	
	<script>
		var app = angular.module('cart', []);
		
		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});

		app.controller('cartCtrl', function($scope, $http) {
			$scope.getCart = function() {
				$http.get("php/GetUserCart.php", {params:{"username": <?php echo "'".$_SESSION['sess_username']."'";?>}}).then(function (response) {
					$scope.names = response.data.records;
				});
			};

			$scope.getCart();

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

			$scope.updateCart = function(partNo) {
				var qty = $('#' + partNo + '_qty').val();
				
				if(qty.length > 0) {
					var queryResult = "";
					
					$http.get("php/UpdateCart.php", {params:{"pquantity": qty, "partno": partNo, "username": <?php echo "'".$_SESSION['sess_username']."'";?>}}).then(function (response) {
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
								}, 500);
							}
							
						}
						else 
						{
							//console.log("FAIL: " + queryResult);

							$('#' + partNo + '_qresult').attr("src","img/fail.png");
							
							setTimeout(function(){
								$('#' + partNo + '_qresult').attr("src","img/empty.png");
							}, 500);
						}
					});
				}
				else {
					$('#' + partNo + '_qresult').attr("src","img/fail.png");
					
					setTimeout(function(){
						$('#' + partNo + '_qresult').attr("src","img/empty.png");
					}, 500);
				}
			}

			$scope.checkout = function() {
				var queryResult = "";
					
				$http.get("php/Checkout.php", { params: { "username": <?php echo "'".$_SESSION['sess_username']."'";?> } }).then(function (response) {
					queryResult = JSON.stringify(response.data.records);
					
					if(queryResult == "[{\"Status\":\"SUCCESS\"}]") {
						alert("Checkout SUCCESS!");
						$scope.getCart();
					}
					else {
						console.log(queryResult);
					}
				});
			}
		});
	</script>
</body>
</html>