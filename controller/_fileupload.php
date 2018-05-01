<?php

/*
 * if you need to save the row of a  table having file   
 * require a folder called upload
 * INPUT TYPE= FILE NAME SHOULD BE file
 * automatically renames file if exists with same name
 * Additional requirements requires model, img_col,  page / page?key=value / page?key=value&key2=value2
 * returns  $data, $msg
 */
require_once '../model/core/fupload.php';



$saved = false;
if (isset($_REQUEST["img_col"])) {

    $uploader = new FUpload();
    $result = $uploader->uploadFile();
    // called debug

    if (isset($result) && $result[0] == "success") {
        $img = explode("upload", $result[1])[1];
        //echo $img;
        $file_info = array($_REQUEST["img_col"] => $img); // column in table where img exists
        $finalArray = array_merge($file_info, $_REQUEST);
        $_REQUEST = $finalArray;

        if (isset($_REQUEST["model_count"])) {
            $count = $_REQUEST["model_count"];
            for ($i = 0; $i < $count; $i++) {
                $pos = "model" . $i;
                //echo $pos;
                if (isset($_REQUEST[$pos])) {
                    $saved = save($_REQUEST[$pos], $_REQUEST);
                }
            }

            $page = $_REQUEST["page"];
            createurl($page, $saved);
        }
    } else {
        $page = $_REQUEST["page"];
        createurl($page, $saved);
    }
} else {
    echo "Usage : ?img_col=col_where_path_of_saved";
    echo "&model_count=<count> ";
    echo "&model1=<prmarytable> ";
    echo "&model<n>=<Secondory Table> ";
}

function save($model, $request) {
    $class_name = $model;
    //echo $class_name;
    include_once "../model/" . strtolower($class_name) . ".php";
    $model = new $class_name;
    // called debug
    //$model->debug();
    if (isset($_REQUEST["debug"])) {
        $model->debug();
    }
    return $model->save($_REQUEST);
}

function loadPages($arry, $page) {
    extract($arry);
    $loc = '../';
    include $page;
}

/* redirect headders */
if (isset($_REQUEST["page"])) {
    
} else {
    header("Location: ../404.php");
}

function createurl($page, $status) {
    if (strpos($page, '?') !== false) {
        $args = array_reverse(explode("?", $page));
        $url = implode("&", $args);
        if ($status) {
            header("Location: ../$args[1]?save=Successfully Added&" . $url);
        } else {
            header("Location: ../$args[1]?save=failed&" . $url);
        }
    } else {
        if ($status) {
            header("Location: ../$page?save=Successfully Added");
        } else {
            header("Location: ../$page?save=failed");
        }
    }
    return $page;
}
