<?php

require_once ("core/model.php");

class HeatSupport extends Model {

    protected $table_name = "heat_support";
    protected $primary_key = "fb_id";
    protected $order_by = "fb_id";

    function __construct() {
        parent::__construct();
    }

}
