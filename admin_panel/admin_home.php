<?php

    session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
}
$email = $_SESSION["email"];

include_once '../model/heatwebsite.php';
include_once '../model/heatuserinfo.php';
$heat_website = new HeatWebsite();
$heat_users_mgr = new HeatUserInfo();
$heat_users = $heat_users_mgr->getBy(array("user_type"=>"client"));
$urls = $heat_website->getBy(array("email" => $email));



function getFavicon($url) {
    # make the URL simpler
    $elems = parse_url($url);
    $url = $elems['scheme'] . '://' . $elems['host'];

    # load site
    $output = file_get_contents($url);

    # look for the shortcut icon inside the loaded page
    $regex_pattern = "/rel=\"shortcut icon\" (?:href=[\'\"]([^\'\"]+)[\'\"])?/";
    preg_match_all($regex_pattern, $output, $matches);

    if (isset($matches[1][0])) {
        $favicon = $matches[1][0];

        # check if absolute url or relative path
        $favicon_elems = parse_url($favicon);

        # if relative
        if (!isset($favicon_elems['host'])) {
            $favicon = $url . '/' . $favicon;
        }

        return $favicon;
    }

    return false;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="heatmap" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <script src="js/jquery.min.js"></script>
        <!-- Mainly scripts -->
        <script src="js/jquery.metisMenu.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
        <!-- Custom and plugin javascript -->
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/custom.js"></script>
        <script src="js/screenfull.js"></script>
     
        <script src="js/skycons.js"></script>
        <!--//skycons-icons-->
    </head>
    <body>
        <div id="wrapper">

            <!----->
            <nav class="navbar-default navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h1> <a class="navbar-brand" href="index.php">BurnMe</a></h1>         
                </div>
                <div class=" border-bottom">


                    <!-- Brand and toggle get grouped for better mobile display -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="drop-men" >
                        <ul class=" nav_1">
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <div class="clearfix">

                    </div>

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">

                                <li>
                                    <a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Users</span> </a>
                                </li>                 
                                 
                                
                                <li>
                                    <a href="../controller/logout.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Logout</span> </a>
                                </li> 
                            </ul>
                        </div>
                    </div>
            </nav>
            <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="content-main">

                    <!--banner-->	
                    <div class="banner">

                        <h2>
                            <a href="index.php">Home</a>
                            <i class="fa fa-angle-right"></i>
                            <span>Users</span>
                        </h2>
                    </div>
                    <!--//banner-->
                    <!--content-->
                    <div class="content-top">


                        <div class="col-md-12 ">
                            <div class="content-top-1">
                                <div class="grid-form1">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50%">Name</th>
                                                <th width="50%">Email</th> 
                                                <th width="50%">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                       
                                           


                                            if (isset($heat_users)) {
                                                foreach ($heat_users as $u) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $u["name"] ?></td>
                                                        <td><?= $u["email"] ?></td>
                                                        <td>
                                                            <a href="../controller/_delete.php?model=HeatUserInfo&id=<?= $u["email"] ?>&page=admin_panel/admin_home.php"> <i class="fa fa-trash"> </i> </a>&nbsp;
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="clearfix"> </div>
                            </div>


                        </div>

                        <div class="clearfix"> </div>
                    </div>
                    <!---->


                    <!--//content-->



                    <!---->
                    <div class="copy">
                        <p> &copy; Dike Heatmap  </p>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!---->
        <!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

