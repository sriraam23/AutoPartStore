<?php
	include 'php/CheckSession.php';
	include 'php/CheckAdmin.php';
?>
<html ng-app="part" lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="en" />
	<meta name="google" content="notranslate" />
	
	<title>Auto Parts Store - Part Info</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
	<script type="text/javascript" src="js/totop.js"></script>
	<script type="text/javascript" src="js/validator.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>

    <style type="text/css">
    	.item-photo{display:flex;justify-content:center;align-items:center;border-right:1px solid #f6f6f6;}
    </style>
</head>

<body id='partCtrl' ng-controller="partCtrl">
	<?php
	session_start();
	if(!(isset($_SESSION['sess_username']))){
		header('Location: login.html');
	}
	?>
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
							<span class="glyphicon glyphicon-shopping-cart"></span> <span id="count" class="ng-cloak"> {{ cartitems }} </span>
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
			<div class="ng-cloak" ng-repeat="part in parts" emit-last-repeater-element>
	        	<div class="row">
	               <div class="col-xs-4 item-photo">
	                    <img style="max-width:100%;" ng-src="img/{{part.PImage}}" />
	                </div>
	                <div class="col-xs-5" style="border:0px solid gray">
	                    <h2>{{part.PCompany}} {{part.Pname}}</h2>    
	                    <!--<h5 style="color:#337ab7">Vendor: <a href="#">{{part.PCompany}}</a></h5>-->
	        
	                    <h4 class="title-price"><small>Price</small></h4>
	                    <h3 style="margin-top:0px;">US ${{part.Price.toFixed(2)}}</h3>
	        			
	        			<h4 class="title-price"><small>Subcategory</small></h4>
	                    <h3 style="margin-top:0px;">{{part.SubCatID}}</h3>

	                    <h4 class="title-price"><small>Warranty</small></h4>
	                    <h3 style="margin-top:0px;">{{part.WarrantyID}}</h3>

	                    <div class="section" style="padding-bottom:20px;">
	                        <h4 class="title-attr"><small>Quantity</small></h4>
	                        <input id='qty' name='qty' type='number' ng-model='number' ng-value='{{part.Quantity}}' readonly hidden /> 
	                        <div>
	                        	<button type="button" class="btn btn-default btn-minus" disabled="disabled"><span class="glyphicon glyphicon-minus"></span></button>
	                            <input class="ng-cloak" id='pquantity' name='pquantity' type='number' min='1' style="width:70px; text-align:center;" value="1" ng-disabled="{{part.Quantity}} == 0" />
	                            <button type="button" class="btn btn-default btn-plus" ng-disabled="{{part.Quantity}} == 0"><span class="glyphicon glyphicon-plus"></span></button>
	                            <button class="btn btn-success" id="addcart" ng-click="addToCart(part.PartNo, part.Price)" ng-disabled="{{part.Quantity}} == 0">
	                            	<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart
	                            </button>
	                        </div>
	                    </div>
	                </div>
				</div>		
			</div>
		</div>
	</div>

	<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left">
		<span class="glyphicon glyphicon-chevron-up"></span>
	</a>

	<div class="modal fade success-popup" id="succcheck" tabindex="-1" role="dialog" aria-labelledby="succCheckLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="succCheckLabel">Add to Cart</h4>
          </div>
          <div class="modal-body text-center">
            <p class="lead"><img src='img/success.png'/><br/>Add to Cart Successful!</p>
            <a href="#" onclick="$('#succcheck').modal('hide');" class="rd_more btn btn-default">Continue Shopping</a>
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
            <a href="#" onclick="$('#failcheck').modal('hide');" class="rd_more btn btn-default">Close</a>
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
            <a href="#" onclick="$('#logoutModal').modal('hide');" class="rd_more btn btn-success">Cancel</a>
          </div>
        </div>
      </div>
    </div>

	<script>
		$(function(){
			
      	});

		var app = angular.module('part', []);

		app.directive('emitLastRepeaterElement', function() {
			return function(scope) {
				if (scope.$last){
					scope.$emit('LastRepeaterElement');
				}
			};
		});
		
		app.controller('partCtrl', function($scope, $http) {
			$scope.updateCartCount = function() {
				$http.get("php/GetCartItemCount.php",{}).then(function (response) {
				    $scope.cartitems = response.data;
					//$('#count').html($scope.cartitems);
					//console.log($scope.cartitems);
				});
			}

			$scope.getAllPartInfo = function() {
				var part = '<?php echo $_GET['partno'] ?>';

				$http.get("./php/GetAllPartFromPartNo.php",{params:{"part": part}}).then(function (response) {
					$scope.parts = response.data.records;
					//console.log($scope.parts);
					setTimeout(function(){
						$scope.updateCartCount();
					}, 50);
				});

				//$('#message').css("display", "none");
			};

			$scope.getAllPartInfo();

			$scope.$on('LastRepeaterElement', function() {
				setTimeout(function(){
					var isDisabled = $(".section > div > input").prop('disabled');
					//console.log($('#qty').val());
					if(isDisabled) {
						$(".section > div > input").attr("min", "0");
						$(".section > div > input").val("0");
					}
				}, 0);

				$(".btn-minus").on("click",function(){
					var maxQty = $('#qty').val();
	                var now = $(".section > div > input").val();

	                if ($.isNumeric(now)){
	                    if (parseInt(now) -1 > 0){ now--;}

	                    if(now <= maxQty) {
	                    	$(".section > div > input").val(now);
	                	}
	                	else {
	                		$(".section > div > input").val(maxQty);
	                	}
	                }else{
	                    $(".section > div > input").val("1");
	                }

    				if(now == maxQty) {
						$(".btn-plus").attr("disabled", "disabled");
					}
					else if(now == 1) {
						$(".btn-minus").attr("disabled", "disabled");
					}
					else {
						$(".btn-plus").removeAttr("disabled");
						$(".btn-minus").removeAttr("disabled");
					}
	            }) 

	            $(".btn-plus").on("click",function(){
	                var maxQty = $('#qty').val();
	                var now = $(".section > div > input").val();
	                
	                if ($.isNumeric(now)){
	                	now = parseInt(now) + 1;

	                	if(now <= maxQty) {
	                    	$(".section > div > input").val(now);
	                	}
	                	else {
	                		$(".section > div > input").val(maxQty);
	                	}
	                }else{
	                    $(".section > div > input").val("1");
	                }

	                if(now == maxQty) {
						$(".btn-plus").attr("disabled", "disabled");
					}
					else if(now == 1) {
						$(".btn-minus").attr("disabled", "disabled");
					}
					else {
						$(".btn-plus").removeAttr("disabled");
						$(".btn-minus").removeAttr("disabled");
					}
	            }) 

				setTimeout(function(){
					$scope.updateCartCount();
				}, 50);
			});

			$scope.addToCart = function(partNo, price) {
				//console.log(partNo);
				//console.log(price);
				var queryResult = "";

				var pquantity = $('#pquantity').val();
				
				$http.get("php/AddToCart.php",{params:{"partno": partNo, "price": price, "pquantity": pquantity}}).then(function (response) {
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
</body>
</html>