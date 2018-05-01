<?php


/*
 * if you need to update the row of a  table and list the same row 
 * Additional requirements requires model, page
 * returns  $data, $msg
 */
$saved = FALSE;
if (isset($_REQUEST["model"])) {
    $class_name = $_REQUEST["model"];
    include_once "../model/" . strtolower($class_name) . ".php";
    $model = new $class_name;
   
    // called Debug
    if (isset($_REQUEST["debug"])) {
        $model->debug();
    }
    if ($model->update($_REQUEST)) {
       $saved = true;
    }
    $data = $model->getBy($_REQUEST);
    // called exit
    if (isset($_REQUEST["exit"])) {
        exit(0);
    }
    
} else {
    header("Location: ../404.php?model=not_found");
}

 
/* redirect headders */
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    $page = createurl($page, $saved);
   
} else {
    header("Location: ../404.php");
}

function createurl($page, $status) {
    if (strpos($page, '?') !== false) {
        $args = array_reverse(explode("?", $page));
        $url = implode("&", $args);
        if ($status) {
            header("Location: ../$page?save=Successfully Updated &" . $url);
        } else {
            header("Location: ../$page?save=Failed&" . $url);
        }
    } else {
         if ($status) {
            header("Location: ../$page?save=Successfully Updated");
        } else {
            header("Location: ../$page?save=Failed");
        }
    }
    return $page;
}
