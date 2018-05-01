<?php

require_once ("core/model.php");

class HeatMap extends Model {

    protected $table_name = "heat_map";
    protected $primary_key = "cordinate_id";
    protected $order_by = "cordinate_id";

    function __construct() {
        parent::__construct();
    }

}
