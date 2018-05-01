<?php

session_start();
require_once ("../model/heatuserinfo.php");


$model = new HeatUserInfo();

if (isset($_REQUEST)) {
    //$model->debug();

    $result = $model->getBy($_REQUEST, FALSE);
    if (count($result)) {
        if ($result[0]['user_type'] == 'admin') {
            $_SESSION["email"] = $_REQUEST["email"];
            header('location: ../admin_panel/admin_home.php');
        } else if ($result[0]['user_type'] == 'client') {
            $_SESSION["email"] = $_REQUEST["email"];
            header('location: ../admin_panel/');
        } else {
            header('location: ../index.php?user=Invalid username or password');
        }
    } else {
        header('location: ../index.php?user=Invalid username or password');
    }
} else {
    header('location:../index.php');
}
           