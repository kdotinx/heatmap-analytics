<?php

require_once ("core/model.php");

class HeatWebsite extends Model {

    protected $table_name = "heat_website";
    protected $primary_key = "domain_name";
    protected $order_by = "domain_name";

    function __construct() {
        parent::__construct();
    }

}
