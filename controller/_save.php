<?php
/*
 * if you need to save the row of a  table  
 * Additional requirements requires model, page / page?key=value / page?key=value&key2=value2
 * returns  $data, $msg
 */

$saved = false;
if (isset($_REQUEST["model"])) {
    $class_name = $_REQUEST["model"];
    
    include_once "../model/" . strtolower($class_name) . ".php";
   // echo $class_name;
    $model = new $class_name;
     
    // called debug
    if(isset($_REQUEST["debug"])){
        $model->debug();
    } 
    // execute query
    $saved = $model->save($_REQUEST);
    // called exit
    if(isset($_REQUEST["exit"])){
       exit(0);
    } 
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
            header("Location: ../$page?save=Successfully Added&" . $url);
        } else {
            header("Location: ../$page?save=Failed&" . $url);
        }
    } else {
         if ($status) {
            header("Location: ../$page?save=Successfully Added");
        } else {
            header("Location: ../$page?save=Failed");
        }
    }
    return $page;
}

 
 


