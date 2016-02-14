<?php
class Transactions_Model extends CI_Model {
    
    function __construct() {
	parent::__construct();
    }

    function get_transactions() {
	return $this->db->query('SELECT * FROM transaction ORDER BY Datetime DESC');
    }

    function details($i) {
	return $this->db->query('SELECT * FROM transactions WHERE Stock = "' .$i .'" ORDER BY Datetime DESC');
    }

    function get_player_transaction($i) {
	return $this->db->query('SELECT DateTime, Stock, Trans, Quantity FROM transactions where Player = "'  .$i.  '" ORDER BY DateTime DESC');
    }
}
