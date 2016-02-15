<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Portfolio extends Application {

    /*
        Default constructor for the class
    */
    public function __construct() {
    	parent::__construct();
    }

    /*
        Initially called on the controller name being passed in
        
        Checks if there is someone logged in, else prompts the user to login
	*/
    public function index() {
        if ($this->session->userdata('username')) {
            $this->profile();
        } else {
            $this->login();
        }
    }
    
    /*
        If there is an input int he field-username, then set the username of the session based to the username inserted and login
        Else asks the user to login and opens the login page
    */
    public function login() {
        if($this->input->post('field-username')) {
            $nData = array('username' => $this->input->post('field-username'));
            $this->session->set_userdata($nData);
            $this->data['login-menu'] = $this->parser->parse("pages/login/logout_menu", $this->data, true);
            $this->index();
        } else {
            $this->data['pagetitle'] = "Login";
            $this->data['page'] = 'pages/login/login';
            $this->data['pagecontent'] = 'pages/login/login';
            $this->render();
        }
    }

    /*
        "Loggs the user out" (unsets the session) and opens the user login page
    */
    public function logout() {
        $this->session->unset_userdata('username');
        $this->data['login-menu'] = $this->parser->parse("pages/login/login_menu", $this->data, true);
        $this->index();
    }

    /*
        Loads in the user profile when there is a user signed in to the session
    */
    public function profile() {
        $this->data['pagetitle'] = $this->session->userdata('username');
        $this->data['player-activity'] = $this->trade_activity($this->session->userdata('username'));
        $this->data['pagecontent'] = 'pages/portfolio/portfolio';
        $this->data['page'] = 'pages/portfolio/portfolio';
        $this->render();
    }

    /*
        Used to get the details from the user that is selected and shows their information
    */
    public function detail($user) {
        $this->data['pagetitle'] = $user;
        $this->data['player-activity'] = $this->trade_activity($user);
        $this->data['pagecontent'] = 'pages/portfolio/portfolio';
        $this->data['page'] = 'pages/portfolio/portfolio';
        $this->render();
    }

    /*
        Shows all the trade_activity for the currently selected user
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
