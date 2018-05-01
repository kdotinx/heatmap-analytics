<?php

require_once ("core/model.php");

class HeatAnalysis extends Model {

    protected $table_name = "heat_analysis";
    protected $primary_key = "traffic_id";
    protected $order_by = "traffic_id";

    function __construct() {
        parent::__construct();
    }

}
