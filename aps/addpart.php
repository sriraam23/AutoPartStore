<html ng-app="addpart" lang="en">
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
					<li class="active"><a href="addpart.php">Add Part</a></li>
					<li><a href="updatepart.php">Update Part</a></li>
					<li><a href="deletepart.php">Delete Part</a></li>
					<li><a href="about.php">About</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	<div class="container">	
		<div ng-controller="addpartCtrl">
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="control-label col-sm-2" for="carMake">Select Make:</label>
					<div class="col-sm-10">
						<select class="form-control" id="carMake" ng-model="string" ng-change="getCarModel()"> 
							<option value="">Select Make</option>
							<option ng-repeat="a in make" value={{a.Make}}>{{a.Make}}</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="carModel">Select Model:</label>
					<div class="col-sm-10">
						<select class="form-control" id="carModel"> 
							<option value="">Select Model</option>
							<option ng-repeat="a in model" value={{a.Model}}>{{a.Model}}</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="carMinYear">Enter Min Year:</label>
					<div class="col-sm-10">
						<input type="text" pattern="\d*" minlength="4" maxlength="4" class="form-control" id="carMinYear" placeholder="Car Model Minimum Year">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="carMaxYear">Enter Max Year:</label>
					<div class="col-sm-10">
						<input type="text" pattern="\d*" minlength="4" maxlength="4" class="form-control" id="carMaxYear" placeholder="Car Model Maximum Year">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="partno">PartNo:</label>
					<div class="col-sm-10">
						<input minlength="1" maxlength="10" type="text" class="form-control" id="partno" placeholder="Part Number">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="pname">Part Name:</label>
					<div class="col-sm-10">
						<input minlength="1" maxlength="50" type="text" class="form-control" id="pname" placeholder="Part Name">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="pcompany">Part Company:</label>
					<div class="col-sm-10">
						<input minlength="1" maxlength="50" type="text" class="form-control" id="pcompany" placeholder="Part Company">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="pprice">Part Price:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="pprice" placeholder="Part Price">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="psubcatid">Subcategory:</label>
					<div class="col-sm-10">
						<select class="form-control" id="psubcatid">
							<option value="">Sub Category</option>
							<option ng-repeat="a in cats" value={{a.SubCat}}>{{a.SubCat}}</option>
						</select>
					</div>
				</div> 
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwarrantyid">Warranty:</label>
					<div class="col-sm-10">
						<select class="form-control" id="pwarrantyid"> 
							<option value="">Warranty</option>
							<option value="">No Warranty</option>
							<option ng-repeat="a in warrn" value={{a.WarrantyID}}>{{a.Type}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-primary" ng-model="button" ng-click="addParts()">Submit</button>
					</div>
				</div>
				<div class="form-group">
					<div ng-class="resultclass">
						<p ng-repeat="a in result"><strong>>{{a.Status}}</strong></p>
					</div>
				</div>
			</form>
			
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
		var app = angular.module('addpart', []);
		
		app.controller('addpartCtrl', function($scope, $http) {
			$scope.getCarMake = function() {
				$http.get("php/GetCarMakeInfo.php").then(function (response) {$scope.make = response.data.records;});
			};
			
			$scope.getCarModel = function() {
				var make = $('#carMake').val();
				$http.get("php/GetCarModelInfo.php",{params:{"make": make}}).then(function (response) {$scope.model = response.data.records;});
			};
			
			$scope.getPartSubCat = function() {
				$http.get("php/GetPartSubCat.php").then(function (response) {$scope.cats = response.data.records;});
			};
			
			$scope.getPartWarranty = function() {
				$http.get("php/GetPartWarranty.php").then(function (response) {$scope.warrn = response.data.records;});
			};
			
			$scope.addParts = function() {
				var make = $('#carMake').val();
				var model = $('#carModel').val();
				var carMinYear = $('#carMinYear').val();
				var carMaxYear = $('#carMaxYear').val();
								
				var partno = $('#partno').val();
				var pname = $('#pname').val();
				var pcompany = $('#pcompany').val();
				var pprice = $('#pprice').val();
				var psubcatid = $('#psubcatid').val();
				var pwarrantyid = $('#pwarrantyid').val();
									
			    var queryResult = "";
				
				$http.get("php/AddNewPart.php",{params:{"make": make, "model": model, "carMinYear": carMinYear, "carMaxYear": carMaxYear, "partno": partno, "pname": pname, "pcompany": pcompany, "pprice": pprice, "psubcatid": psubcatid, "pwarrantyid": pwarrantyid}}).then(function (response) {
				    queryResult = JSON.stringify(response.data.records);
					
					if(queryResult == "[{\"Status\":\"SUCCESS\"}]")
					{
						//console.log(queryResult);
						$scope.resultclass = "alert alert-success";
					}
					else 
					{
						//console.log("FAIL: " + queryResult);
						$scope.resultclass = "alert alert-danger";
					}
					
					$scope.result = response.data.records;
				});
			}
			
			$scope.getCarMake();
			$scope.getPartSubCat();
			$scope.getPartWarranty();
		});
	</script>
</body>
</html>