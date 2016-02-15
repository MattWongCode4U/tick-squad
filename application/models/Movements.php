<?php
/*
 *  Data access wrapper for "movements" table
 */
class Movements extends my_model2 {

    /* 
     * constructor
     */
    function __construct() {
        parent::__construct("movements", "DateTime");
    }

    /* 
     * query database and retrieves movements
     */
    function get_movements() {
        return $this->db->query('SELECT * FROM movements ORDER BY Datetime DESC');
    }

    /* 
     * query database and retrieve details of a specific stock from earliest to latest order
     */
    function details($code) {
        return $this->db->query('SELECT * FROM movements WHERE Code = "' .$code .'" ORDER BY Datetime DESC');
    }

    /*
     *  query database and retrieves the most recent movement
     */
    function recent_movement() {
        $query = $this->db->query('SELECT Code from movements ORDER BY Datetime DESC LIMIT 1');
        foreach($query->result() as $row)
            $result = $row;
        return $result->Code;
    }
}
