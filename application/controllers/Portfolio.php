<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Portfolio extends Application {

    /**
     * Default constructor for the class
     */
    public function __construct() {
    	parent::__construct();
    }

    /**
     * Initially called on the controller name being passed in
     * 
     * Checks if there is someone logged in, else prompts the user to login
     */
    public function index() {
        if ($this->session->userdata('userName')) {
            $this->profile();
        } else {
            redirect('/auth/');
        }
    }

    /**
     * Loads in the user profile when there is a user signed in to the session
     */
    public function profile() {
        $this->data['pagetitle'] = $this->session->userdata('username');
        $this->data['player-activity'] = $this->trade_activity($this->session->userdata('username'));
        $this->data['pagecontent'] = 'pages/portfolio/portfolio';
        $this->data['page'] = 'pages/portfolio/portfolio';
        $this->render();
    }

    /**
     * Used to get the details from the user that is selected and shows their information
     * 
     * @param type $user Selected user
     */
    public function detail($user) {
        $this->data['pagetitle'] = $user;
        $this->data['player-activity'] = $this->trade_activity($user);
        $this->data['pagecontent'] = 'pages/portfolio/portfolio';
        $this->data['page'] = 'pages/portfolio/portfolio';
        $this->render();
    }

    /**
     * Shows all the trade_activity for the currently selected user
     */
    public function trade_activity($user) {
        $result = '';
        $query = $this->transactions->get_player_transaction($user);
        foreach ($query->result() as $row) {
            $result .= $this->parser->parse('pages/portfolio/trading_row', (array) $row, true);
        }
        return $this->parser->parse('pages/portfolio/trading_table', array('rows' => $result), true);
    }
}
