<?php

require_once ("core/model.php");

class HeatUserInfo extends Model {

    protected $table_name = "heat_user_info";
    protected $primary_key = "email";
    protected $order_by = "email";

    function __construct() {
        parent::__construct();
    }

}
