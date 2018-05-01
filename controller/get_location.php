<?php

session_start();
require_once ("../model/heatmap.php");
$model = new HeatMap();

if (isset($_REQUEST)) {
    $r = $model->getBy($_REQUEST);
    echo(json_encode($r));
}
