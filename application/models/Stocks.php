<?php
class Stocks extends my_model2 {
    public $code;
    public $name;
    public $category;
    public $value;

    public function __construct() {
        parent::__construct("stocks","DateTime");
    }

    public function get_stocks() {
        return $this->db->query('SELECT * FROM stocks');
    }

    public function stock_name() {
        return $this->db->query('SELECT Code, Name, FROM stocks');
    }
}
