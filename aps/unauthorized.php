<htmllang="en">
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
		<script type="text/javascript" src="js/totop.js"></script>
		
		<link rel="icon" type="image/png" href="img/favicon.ico" />

		<style>
			html, body, .container-table {
				height: 100%;
			}
			.container-table {
				display: table;
			}
			.vertical-center-row {
				display: table-cell;
				vertical-align: middle;
			}
	    </style>
		</head>

	<body>
		<div class="container container-table">
		    <div class="row vertical-center-row">
		        <div class="col-md-6 col-md-offset-3">
		            <div class="thumbnail">
		                <div class="caption">
		                    <h2><font color="red"><strong>Unauthorized Access</strong></font></h2>
		                    <hr/>
		                    <div class="row">
		                    	<div class="col-md-6">
		                    		<img class="img-responsive" src="img/forbidden.jpg" alt="unauthorized" />
		                    	</div>
		                    	<div class="col-md-6">
		                    		<p><font size="+2"><strong>Access is denied due to invalid credentials.</strong></font></p>
		                    		<p>You do not have permissions to view this page using the credentials that you supplied.</p>
		                    		<button onclick="goBack()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go Back</button>
		                    		<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Return Home</a>
		                    	</div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

		<script>
			function goBack() {
    			window.history.back();
			}
		</script>
	</body>
</html>