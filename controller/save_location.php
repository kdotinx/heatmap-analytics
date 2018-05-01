<?php

session_start();
require_once ("../model/heatmap.php");
require_once ("../model/heatanalysis.php");
$model = new HeatMap();

if (isset($_REQUEST)) {
    date_default_timezone_set("Asia/Kolkata");
    $now = new DateTime();
    $d = $now->format('Y-m-d H:i:s');
    $_REQUEST['date_time'] = $d;
    $model->debug();
    $r = $model->save($_REQUEST);
    $vists = array("domain_name" => $_REQUEST["domain_name"], "datetime" => $d);
    $model2 = new HeatAnalysis();
    $model2->save($vists);
}
print_r($_REQUEST);
