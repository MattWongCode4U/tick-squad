<?php
/*
 * Data access wrapper for "stocks" table
 */
class Stocks extends my_model2 {
    public $code;       //codename of the stock
    public $name;       //name of the stock
    public $category;   //category the stock belongs to
    public $value;      //value of the stock

    /*
     *  constructor
     */
    public function __construct() {
        parent::__construct("stocks","DateTime");
    }

    /*
     *  query database and retrieves "stocks" table
     */
    public function get_stocks() {
        return $this->db->query('SELECT * FROM stocks');
    }

    /*
     *  query database and retrieves name of the stocks
     */
    public function stock_name() {
        return $this->db->query('SELECT Code, Name, FROM stocks');
    }
}
