
<!DOCTYPE html>
<html>
    <head>
        <title>Register - Burn ME</title>
        <!-- custom-theme -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="heatmap" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //custom-theme -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- js -->
        <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    </head>
    <body>
        <div class="main">	
            <div class="w3layouts_main agileinfo w3">		
                <div class="w3_agile_signup_form agileits">
                    <h1 class="w3_agileits w3ls"> Sign Up</h1>
                    <h2 class="wthree"><a href="index.php">Sign in with existing account</a></h2>
                    <div class="agile_login_form">
                        <form action="controller/_save.php" method="post" class="agileits_w3layouts_form">
                            <input type="hidden" name="model" value="HeatUserInfo" /> 
                            <input type="hidden" name="user_type" value="client" />
                            <input type="hidden" name="page" value="register.php" />
                            <input type="text" name="name" placeholder="Name" required=""/>
                            <input type="email" name="email" placeholder="Email Address" required=""/>
                            <input type="password" name="password" placeholder="Password" required=""/>
                            <input type="password" name="confirm" placeholder="Confirm Password" required=""/>
                            <input type="submit" value="SIGN UP">
                        </form>
                        <?php
                        if(isset($_REQUEST['save'])){
                            print_r($_REQUEST['save']);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="agileits_copyright w3l">
                <p>©  All rights reserved | Dike</a></p>
            </div>
        </div>
    </body>
</html>