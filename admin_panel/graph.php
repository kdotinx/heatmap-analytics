<?php
include_once '../model/heatwebsite.php';

    session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
}
$email = $_SESSION["email"];
$heat_website = new HeatWebsite();
$urls = $heat_website->getBy(array("email" => $email));
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Traffic Statistics</title>
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
                    <h1> <a class="navbar-brand" href="index.php">Burn Me</a></h1>         
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
                    <?php
                    require_once '../model/core/model.php';
                    $model = new Model();
                    $web = $_REQUEST['web'];
                    if (isset($web) && count($web)) {
                        $day = $model->execute("SELECT COUNT(*) as day FROM heat_analysis ha WHERE DATE(ha.datetime) = CURDATE() AND domain_name = '" . $web . "';");
                        $dayAvg = $model->execute("SELECT COUNT(*) AS co FROM heat_analysis ha WHERE domain_name ='" . $web . "' GROUP BY DAY(datetime) ORDER by co DESC");

                        $month = $model->execute("SELECT COUNT(*) as month FROM heat_analysis ha WHERE MONTH(ha.datetime) = MONTH(CURDATE()) AND YEAR(ha.datetime) = YEAR(CURDATE()) AND domain_name = '" . $web . "';");
                        $monthAvg = $model->execute("SELECT COUNT(*) AS co FROM heat_analysis ha WHERE domain_name ='" . $web . "' GROUP BY MONTH(datetime) ORDER by co DESC");

                        $year = $model->execute("SELECT COUNT(*) as year FROM heat_analysis ha WHERE YEAR(ha.datetime) = YEAR(CURDATE()) AND domain_name = '" . $web . "';");
                        
                        $yearAvg = $model->execute("SELECT COUNT(*) AS co FROM heat_analysis ha WHERE domain_name ='" . $web . "' GROUP BY YEAR(datetime) ORDER by co DESC");
                       
                        
                        if (isset($yearAvg[0]) && isset($monthAvg[0]) && isset($dayAvg[0])) {
                            ?>
                            <div class="content-top">

                                <div class="col-md-4 ">
                                    <div class="content-top-1">
                                        <div class="col-md-6 top-content">
                                            <h5>Daily</h5>
                                            <label><?= $day[0]['day'] ?></label>
                                        </div>
                                        <div class="col-md-6 top-content1">	   
                                            <div id="demo-pie-1" class="pie-title-center" data-percent="<?= ($day[0]['day'] / $dayAvg[0]['co']) * 100 ?>"> <span class="pie-value"></span> </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                    <div class="content-top-1">
                                        <div class="col-md-6 top-content">
                                            <h5>Monthly</h5>
                                            <label><?= $month[0]['month'] ?></label>
                                        </div>
                                        <div class="col-md-6 top-content1">	   
                                            <div id="demo-pie-2" class="pie-title-center" data-percent="<?= ($month[0]['month'] / $monthAvg[0]['co']) * 100 ?>"> <span class="pie-value"></span> </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                    <div class="content-top-1">
                                        <div class="col-md-6 top-content">
                                            <h5>Yearly</h5>
                                            <label><?= $year[0]['year'] ?></label>
                                        </div>
                                        <div class="col-md-6 top-content1">	   
                                            <div id="demo-pie-3" class="pie-title-center" data-percent="<?= ($year[0]['year'] / $yearAvg[0]['co']) * 100 ?>"> <span class="pie-value"></span> </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>

                                <div class="col-md-8 content-top-2">
                                    <!---start-chart---->
                                    <!----->
                                    <div class="content-graph">
                                        <div class="content-color">
                                            <div class="content-ch"><p><i></i>Chrome </p><span>100%</span>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="content-ch1"><p><i></i>Safari</p><span> 50%</span>
                                                <div class="clearfix"> </div>
                                            </div>
                                        </div>
                                        <!--graph-->
                                        <link rel="stylesheet" href="css/graph.css">
                                        <!--//graph-->
                                        <script src="js/jquery.flot.js"></script>
                                        <script>
                    $(document).ready(function () {

        // Graph Data ##############################################
                        var graphData = [{
        // Visits
                                data: [
        <?php
        for ($index = 0; $index < 24; $index++) {

            $hours = $model->execute("SELECT COUNT(*) as hour FROM heat_analysis ha WHERE HOUR(ha.datetime) = " . $index . " AND domain_name = '" . $_REQUEST['web'] . "'");
            ?>

                                        [<?= $index ?>, <?= $hours[0]['hour'] ?>],
            <?php
        }
        ?>
                                ],
                                color: '#999999'
                            }
                        ];
        // Lines Graph #############################################
                        $.plot($('#graph-lines'), graphData, {
                            series: {
                                points: {
                                    show: true,
                                    radius: 5
                                },
                                lines: {
                                    show: true
                                },
                                shadowSize: 0
                            },
                            grid: {
                                color: '#7f8c8d',
                                borderColor: 'transparent',
                                borderWidth: 20,
                                hoverable: true
                            },
                            xaxis: {
                                tickColor: 'transparent',
                                tickDecimals: 2
                            },
                            yaxis: {
                                tickSize: 10
                            }
                        });
        // Bars Graph ##############################################
                        $.plot($('#graph-bars'), graphData, {
                            series: {
                                bars: {
                                    show: true,
                                    barWidth: .9,
                                    align: 'center'
                                },
                                shadowSize: 0
                            },
                            grid: {
                                color: '#7f8c8d',
                                borderColor: 'transparent',
                                borderWidth: 20,
                                hoverable: true
                            },
                            xaxis: {
                                tickColor: 'transparent',
                                tickDecimals: 2
                            },
                            yaxis: {
                                tickSize: 10
                            }
                        });
        // Graph Toggle ############################################
                        $('#graph-bars').hide();
                        $('#lines').on('click', function (e) {
                            $('#bars').removeClass('active');
                            $('#graph-bars').fadeOut();
                            $(this).addClass('active');
                            $('#graph-lines').fadeIn();
                            e.preventDefault();
                        });
                        $('#bars').on('click', function (e) {
                            $('#lines').removeClass('active');
                            $('#graph-lines').fadeOut();
                            $(this).addClass('active');
                            $('#graph-bars').fadeIn().removeClass('hidden');
                            e.preventDefault();
                        });
        // Tooltip #################################################
                        function showTooltip(x, y, contents) {
                            $('<div id="tooltip" style="color:red">' + contents + '</div>').css({
                                top: y - 16,
                                left: x + 20
                            }).appendTo('body').fadeIn();
                        }

                        var previousPoint = null;
                        $('#graph-lines, #graph-bars').bind('plothover', function (event, pos, item) {
                            if (item) {
                                if (previousPoint !== item.dataIndex) {
                                    previousPoint = item.dataIndex;
                                    $('#tooltip').remove();
                                    var x = item.datapoint[0],
                                            y = item.datapoint[1];
                                    showTooltip(item.pageX, item.pageY, y + ' visitors at ' + x + '.00h');
                                }
                            } else {
                                $('#tooltip').remove();
                                previousPoint = null;
                            }
                        });
                    });
                                        </script>
                                        <div class="graph-container">

                                            <div id="graph-lines"> </div>
                                            <div id="graph-bars"> </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!---->
                    <!--//content-->
                    <!---->
                    <div class="copy">
                        <p> &copy; Dike Heatmap </p>
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

