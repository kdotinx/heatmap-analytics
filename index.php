
<!DOCTYPE html>
<html>
<head>
<title>Burn Me : Heatmap Analytics System</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="heatmap,analytics" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
	<div class="main">	
		<div class="w3layouts_main agileinfo w3">		
			<div class="w3_agile_signup_form agileits">
				<h1 class="w3_agileits w3ls"> Burn Me</h1>
                                <h2 class="wthree"><a href="register.php">Create new account </a></h2>
				<div class="agile_login_form">
                                    <form action="controller/logncheck.php" method="post" class="agileits_w3layouts_form">
					 
						<input type="email" name="email" placeholder="Email Address" required="">
						<input type="password" name="password" placeholder="Password" required=""> 
						<input type="submit" value="LOG IN">
						<br/>
						<?php
					//	echo "dsada";
						if (isset($_REQUEST["user"]))
					        echo $_REQUEST["user"];
						?>
					</form>
				</div>
			</div>
		</div>
		<div class="agileits_copyright w3l">
			<p>© All rights reserved | Dike 2017</p>
		</div>
	</div>
	<!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/get-location.js"></script>
</body>
</html>