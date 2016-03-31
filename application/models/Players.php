<?php 
/*
 * Data access wrapper for "players" table
 */
class Players extends my_model2 {
    public $player; //player
    public $cash;   //cash that the player has

    /*
     *  constructor
     */
    public function __construct() {
        parent::__construct("players", "Player");
    }

    /*
     *  query database and retrieve players table
     */
    public function get_players() {
        return $this->db->query('SELECT * FROM players');
    }

    /*
     *  query database and retrieves player names
     */
    public function get_names() {
        return $this->db->query('SELECT Name from players');
    }
}
