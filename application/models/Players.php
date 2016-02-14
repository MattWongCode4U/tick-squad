<?php 
class Players extends my_model2 {
    public $player;
    public $cash;

    public function __construct() {
        parent::__construct("players", "Player");
    }

    public function get_players() {
        return $this->db->query('SELECT * FROM players');
    }

    public function get_names() {
        return $this->db->query('SELECT Player from players');
    }
}
