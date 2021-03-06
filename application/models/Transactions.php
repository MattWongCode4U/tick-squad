<?php
/*
 * Data access wrapper for "transactions" table
 */
class Transactions extends my_model2 {

    /*
     *  constructor
     */
    function __construct() {
        parent::__construct("transactions", "DateTime");
    }

    /*
     *  query database and retrieve transactions table from newest to oldest order
     */
    function get_transactions() {
        return $this->db->query('SELECT * FROM transactions ORDER BY DateTime DESC');
    }

    /*
     *  gets the details of the transaction
     */
    function details($i) {
        return $this->some("Stock", $i);
    }

    function get_trans($code)
    {
        return $this->db->query('SELECT * FROM transactions WHERE `Stock` LIKE "' . $code . '" ORDER BY DateTime DESC');
    } 

    /*
     *  query database and retrieve a transaction of a player
     */
    function get_player_transaction($i) {
        return $this->db->query('SELECT DateTime, Stock, Trans, Quantity FROM transactions where Player = "'  .$i.  '" ORDER BY DateTime DESC');
    }
}
