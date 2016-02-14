<?php
class Transactions extends my_model2 {

    function __construct() {
        parent::__construct("transactions", "DateTime");
    }

    function get_transactions() {
        return $this->db->query('SELECT * FROM transaction ORDER BY Datetime DESC');
    }

    function details($i) {
        return $this->some("Stock", $i);
    }

    function get_player_transaction($i) {
        return $this->db->query('SELECT DateTime, Stock, Trans, Quantity FROM transactions where Player = "'  .$i.  '" ORDER BY DateTime DESC');
    }
}
