<?php

class DBManager {

    public $connection;
    private $server = "localhost";
    private $my_username = "dikeio_heat";
    private $my_password = "N*P1ikhGIxV]";
    private $db = "dikeio_heatmap";

    public function __construct() {

        $this->connection = new PDO("mysql:host=$this->server;dbname=$this->db", $this->my_username, $this->my_password);
        // $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function show_errors($status) {
        if ($status) {
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public function execute_query($query) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function execute_update($query) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

}
