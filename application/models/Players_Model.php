<?php 
class Players_Model extends CI_Model {
    public $player;
    public $cash;

    public function __construct() {
	parent::__construct();
    }

    public function get_players() {
	return $this->db->query('SELECT * FROM players');
    }

    public function get_names() {
	return $this->db->query('SELECT Player from players');
    }
}
