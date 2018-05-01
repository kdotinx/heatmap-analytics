<?php

/*
 * if you need to save the row of a  table  
 * Additional requirements requires model
 * returns  $data, $msg
 */
if (isset($_REQUEST["model"])) {
    $class_name = $_REQUEST["model"];
    include_once "../model/" . strtolower($class_name) . ".php";
    $model = new $class_name;
    // called debug
    if (isset($_REQUEST["debug"])) {
        $model->debug();
    }
    $msg = "failed to update";
    if ($model->save($_REQUEST)) {
        $msg = "successfully added";
    }
    $data = $model->get();
    // called exit
    if (isset($_REQUEST["exit"])) {
        exit(0);
    }
    loadPages(array("msg" => $msg, "data" => $data), "../" . $_REQUEST["page"]);
} else {
    header("Location: ../404.php?page=not_found");
}

function loadPages($data, $page) {
    extract($data);
    $loc = '../';
    include $page;
}
