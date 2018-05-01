<?php

/*
 * if you need to delete the row of a  table and list the same row 
 * Additional requirements requires model, page
 * returns  $data, $msg
 *  $data  is table values
 */
if (isset($_REQUEST["model"])) {
    $class_name = $_REQUEST["model"];
    include_once "../model/" . strtolower($class_name) . ".php";
    $model = new $class_name;
    // called Debug
    if (isset($_REQUEST["debug"])) {
        $model->debug();
    }
    $msg = FALSE;
    // execute query
    if ($model->delete($_REQUEST["id"])) {
        $msg = TRUE;
    }

    if (isset($_REQUEST["exit"])) {
        exit(0);
    }
    $page = $_REQUEST[page];
    createurl($page, $msg);
} else {
    header("Location: ../404.php?page=not_found");
}

function createurl($page, $status) {
    if (strpos($page, '?') !== false) {
        $args = array_reverse(explode("?", $page));
        $url = implode("&", $args);
        if ($status) {
            header("Location: ../$args[1]?save=Successfully removed&" . $url);
        } else {
            header("Location: ../$args[1]?save=failed to removed&" . $url);
        }
    } else {
        if ($status) {
            header("Location: ../$page?save=Successfully removed");
        } else {
            header("Location: ../$page?save=Failed to remove");
        }
    }
    return $page;
}
