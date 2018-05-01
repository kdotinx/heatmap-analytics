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
        <title>Dike Heatmap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

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
                    <h1> <a class="navbar-brand" href="index.php">Burn Me</a></h1>         
                </div>
                <div class=" border-bottom">
                    <div class="full-left">
                        <section class="full-top">
                            <button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
                        </section>
                       <form class=" navbar-left-right">
                            <input type="text" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') { this.value = 'Search...'; }"> 
                            <input type="submit" value="" class="fa fa-search"> </form>
                        <div class="clearfix"> </div>
                    </div>


                    <!-- Brand and toggle get grouped for better mobile display -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="drop-men" >

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
    <!--                                            <li><a href="<?= $s['domain_name'] ?>" class=" hvr-bounce-to-right"><i class="fa nav_icon"><img width="21.69" height="24" src="<?= getFavicon($s['domain_name']) ?>"/></i>Site <?= $key + 1 ?></a></li>-->
                                                <!--<li><a href="validation.php" class=" hvr-bounce-to-right"><i class="fa fa-globe nav_icon"></i>site two</a></li>-->
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
                            <span>Forms</span>
                        </h2>
                    </div>
                    <!--//banner-->
                    <!--grid-->
                    <div class="grid-form">
                        <div class="grid-form1">
                            <!--<img src="<?= getFavicon("http://www.google.com") ?>"-->
                            <h3 id="forms-example" class="">New  Site</h3>
                            <form enctype="multipart/form-data" method="post" action="../controller/_fileupload.php">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Site URL</label>
                                    <input type="url" name="domain_name"  class="form-control" id="exampleInputEmail1" placeholder="URL ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">File </label>
                                    <input type="file" name="file" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Created Date </label>
                                    <input type="date" name="create_date" id="create_date" class="form-control" id="exampleInputPassword1" placeholder="Created Date">
                                </div>
                                <input type="hidden" name="email" value="<?php echo $email ?>"/>
                                <input type="hidden" name="img_col" value="heat_image"/>
                                <input type="hidden" name="page" value="admin_panel/forms.php"/>
                                
                                <input type="hidden" name="model_count" value="1"/>
                                <input type="hidden" name="model0" value="HeatWebsite"/>

                                <button type="submit" class="btn btn-default">Submit</button>
                                <h4><br></h4><a target="_blank" href="http://heat.dike.io/guide/tracking.pdf" >Download Tracking Manual</a>
                                    <?php
                                    if (isset($_REQUEST["save"])) {
                                        echo $_REQUEST["save"];
                                    }
                                    ?>
                                </h4>

                            </form>
                        </div>
                        <!----->
                        <div class="grid-form1">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50%">Site URL</th>
                                        <th width="50%">Date</th> 
                                        <th width="50%">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($urls)) {
                                        foreach ($urls as $u) {
                                            ?>
                                            <tr>
                                                <td><?= $u["domain_name"] ?></td>
                                                <td><?= $u["create_date"] ?></td>
                                                <td>
                                                    <!--<a href=""> <i class="fa fa-edit"></i> </a>-->
                                                    <a href="../controller/_delete.php?model=heatwebsite&id=<?= $u['domain_name'] ?>&page=admin_panel/forms.php"> <i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table> 
                        </div>



                    </div>
                    <!--//grid-->
                    <!---->
                    <div class="copy">
                        <p> &copy; Dike Heatmap</a> </p>	    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
        <!---->

    </body>
</html>

