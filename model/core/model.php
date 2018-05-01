<?php

require_once("dbmanager.php");

class Model {

    protected $table_name = "";
    protected $primary_key = "";
    protected $order_by;
    protected $db;
    protected $show_query;

    /**
     * Methord to save the data into the database
     */
    function __construct() {

        $this->db = new DBManager;
    }

    function debug($status = TRUE) {
        $this->db->show_errors($status);
        $this->show_query = $status;
    }

    /**
     *  This methord is used to save the record
     * @param  $param array(colunm => value, column => value, ...)
     */
    function save($param) {
        $param = $this->filter($param);
        $str = "";
        $counter = 0;
        foreach ($param as $value) {
            $counter++;
            $str.= " '$value' ";
            if ($counter != count($param)) {
                $str.= ", ";
            }
        }
        $cols = implode(", ", array_keys($param));
        $query = "INSERT INTO $this->table_name ($cols) VALUES( $str) ;";
        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_update($query);
    }

    /**
     * This methord is used to save record into db
     * @param  $param array(colunm => value, column => value, ...)
     * @return last inserted record id
     */
    function savereturn($param) {
        $param = $this->filter($param);
        $str = "";
        $counter = 0;
        foreach ($param as $value) {
            $counter++;
            $str.= " '$value' ";
            if ($counter != count($param)) {
                $str.= ", ";
            }
        }
        $cols = implode(", ", array_keys($param));
        $query = "INSERT INTO $this->table_name ($cols) VALUES( $str) ;";
        if ($this->show_query) {
            echo $query;
        }
        if ($this->db->execute_update($query)) {
            return $this->db->lastInsertId();
        } else {
            return 0;
        }
    }

    /**
     * This methord is used to update the record
     * @param  $param array(colunm => value, column => value, ...)
     */
    function update($param) {
        $param = $this->filter($param);
        $query = "UPDATE $this->table_name SET ";
        $counter = 0;
        foreach ($param as $key => $value) {
            $counter++;
            $query.= " $key = '$value' ";
            if ($counter != count($param)) {
                $query.= ", ";
            }
        }
        $query .= " WHERE  $this->primary_key = '" . $param[$this->primary_key] . "' ; ";

        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_update($query);
    }

    /**
     * This methord is used to retrive the record
     * @return all records in data
     */
    function get() {
        $query = "SELECT * FROM $this->table_name ";
        if (isset($this->order_by)) {
            $query .=" ORDER BY  $this->order_by ";
        }

        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_query($query);
    }

    /**
     * This methord is used to retrive the record
     * @param param_array  array(column => value, column => value, ...)
     * @param $single to retive a single record by default it is false; returns multiple record
     * @param $condition to specify AND or OR Condition in DB
     * @return  records in data  
     */
    function getBy($param_array, $single = FALSE, $condition = "AND") {
        $query = "SELECT * FROM  $this->table_name WHERE";
        $param_array = $this->filter($param_array);
        $counter = 0;
        foreach ($param_array as $key => $value) {
            $counter++;
            $query.= " $key = '$value' ";
            if ($counter != count($param_array)) {
                $query.= " $condition ";
            }
        }

        if (isset($this->order_by)) {
            $query .=" ORDER BY  $this->order_by ";
        }

        if ($single) {
            $query.=" LIMIT  1 ";
        }

        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_query($query);
    }

    /**
     * Methord to delete a row data  
     * @param  $id  Id of the record to be deleted
     */
    function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE  $this->primary_key =  '$id' ";
        $db = new DBManager;
        if ($this->show_query) {
            echo $query;
        }
        return $db->execute_update($query);
    }

    /**
     * Methord to delete a row data  
     * @param  $col_name  column and value  of the record to be deleted
     */
    function deleteBy($col_name, $value) {
        $query = "DELETE FROM $this->table_name WHERE  $col_name =  '$value' ";
        $db = new DBManager;
        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_update($query);
    }

    public function filter($arr) {
        $query = "SHOW COLUMNS FROM " . $this->table_name;
        $newarr = array();
        if ($this->show_query) {
            echo $query;
        }
        $r = $this->db->execute_query($query);
        foreach ($r as $key => $value) {
            $k = trim($value['Field']);
            if (array_key_exists($k, $arr)) {
                $newarr[$k] = $arr[$k];
            }
        }
        return $newarr;
    }

    /**
     * This methord is used to retrive the record
     * @param query query to be executed
     * @return all records in data
     */
    function execute($query) {
        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_query($query);
    }

    /**
     * This methord is used to update/insert the record
     * @param query query to be executed
     * @return all records in data
     */
    function execute_update($query) {
        if ($this->show_query) {
            echo $query;
        }
        return $this->db->execute_update($query);
    }

}
