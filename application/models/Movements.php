<?php
class Movements extends my_model2 {

    function __construct() {
        parent::__construct("movements", "DateTime");
    }

    function get_movements() {
        return $this->db->query('SELECT * FROM movements ORDER BY Datetime DESC');
    }

    function details($code) {
        return $this->db->query('SELECT * FROM movements WHERE Code = "' .$code .'" ORDER BY Datetime DESC');
    }

    function recent_movement() {
        $query = $this->db->query('SELECT Code from movements ORDER BY Datetime DESC LIMIT 1');
        foreach($query->result() as $row)
            $result = $row;
        return $result->Code;
    }
}
