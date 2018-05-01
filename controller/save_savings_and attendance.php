<?php

include_once '../model/attninfo.php';
print_r($_REQUEST);

if (isset($_REQUEST["username"])) {
    $attn = new AttnInfo();
    $attn->markAttendance($_REQUEST);
      header("Location: ../unit_add_aatn_savings.php?save=Successfully Marked attendance");
} else {

    header("Location: ../unit_add_aatn_savings.php?save=Failed");
}

