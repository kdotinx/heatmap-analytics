<?php

    session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
}
$email = $_SESSION["email"];

include_once '../model/heatwebsite.php';
$heat_website = new HeatWebsite();
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
        <script>
            $(function () {
                $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

                if (!screenfull.enabled) {
                    return false;
                }



                $('#toggle').click(function () {
                    screenfull.toggle($('#container')[0]);
                });



            });
        </script>

        <!----->

        <!--pie-chart--->
        <script src="js/pie-chart.js" type="text/javascript"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('#demo-pie-1').pieChart({
                    barColor: '#3bb2d0',
                    trackColor: '#eee',
                    lineCap: 'round',
                    lineWidth: 8,
                    onStep: function (from, to, percent) {
                        $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                    }
                });

                $('#demo-pie-2').pieChart({
                    barColor: '#fbb03b',
                    trackColor: '#eee',
                    lineCap: 'butt',
                    lineWidth: 8,
                    onStep: function (from, to, percent) {
                        $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                    }
                });

                $('#demo-pie-3').pieChart({
                    barColor: '#ed6498',
                    trackColor: '#eee',
                    lineCap: 'square',
                    lineWidth: 8,
                    onStep: function (from, to, percent) {
                        $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                    }
                });


            });

        </script>
        <!--skycons-icons-->
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
                                    <a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a>
                                </li>                 
                                <li>
                                    <a href="forms.php" class=" hvr-bounce-to-right">
                                        <i class="fa fa-sitemap nav_icon"></i>
                                        <span class="nav-label">New Site</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-list nav_icon"></i> <span class="nav-label">Sites</span><span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <?php
                                        foreach ($urls as $key => $s) {
                                            ?>

                                        <li><a href="<?= $s['domain_name'] ?>" class=" hvr-bounce-to-right"><br/>&nbsp; <?= $s['domain_name'] ?> </a></li>

                                            <?php
                                        }
                                        ?>
                                    </ul>
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
                            <span>Dashboard</span>
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
                                                <th width="50%">URLs</th>
                                                <th width="50%">Date</th> 
                                                <th width="50%">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once ("../model/heatwebsite.php");
                                            $model = new HeatWebsite();


                                            if (isset($urls)) {
                                                foreach ($urls as $u) {
                                                    $paths = $model->getBy(array('domain_name' => $u["domain_name"]));
                                                    ?>
                                                    <tr>
                                                        <td><?= $u["domain_name"] ?></td>
                                                        <td><?= $u["create_date"] ?></td>
                                                        <td>
                                                            <a href="heatmap.php?domain_name=<?= $u["domain_name"] ?>&image=<?= $paths[0]['heat_image'] ?>"> <i class="fa fa-firefox"> </i> </a>&nbsp;
                                                            <a href="graph.php?web=<?= $u["domain_name"] ?>"> <i class="fa fa-bar-chart"> </i></a>
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

