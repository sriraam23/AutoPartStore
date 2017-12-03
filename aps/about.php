<?php
	include 'php/CheckSession.php';
	include 'php/CheckAdmin.php';
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="en" />
	<meta name="google" content="notranslate" />
	
	<title>Auto Parts Store - About</title>

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

					<li class="active"><a href="about.php">About</a></li>
					<!--<li><a href="usercart.php">Cart</a></li>-->
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="usercart.php" class="navbar-brand">
							<span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge badge-notify"><?php include 'php/GetCartItemCount.php' ?></span>
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
		<div id="teaminfo">
			<h3>CS 6314-002 Web Programming Languages</h3>
			<h3>Online Auto Parts Store</h3>
			<h4>Members:</h4>
			<h5>Kartheek Kopparapu (kxk060100)</h5>
			<h5>Sriraam Ramakrishnan (sxr163730)</h5>
		</div>
		
		<div>
			<a id="back-to-top" href="javascript:void(0)" class="btn btn-primary btn-lg back-to-top" role="button">
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
</body>
</html>