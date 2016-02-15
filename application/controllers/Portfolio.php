<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Portfolio extends Application {

    public function __construct() {
	parent::__construct();
    }

    public function index() {
	if ($this->session->userdata('username')) {
	    $this->profile();
	} else {
	    $this->login();
	}
    }
    
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

    public function logout() {
	$this->session->unset_userdata('username');
	$this->data['login-menu'] = $this->parser->parse("pages/login/login_menu", $this->data, true);
	$this->index();
    }

    public function profile() {
	$this->data['pagetitle'] = $this->session->userdata('username');
	$this->data['player-activity'] = $this->trade_activity($this->session->userdata('username'));
	$this->data['pagecontent'] = 'pages/portfolio/portfolio';
	$this->data['page'] = 'pages/portfolio/portfolio';
	$this->render();
    }

    public function detail($user) {
	$this->data['pagetitle'] = $user;
	$this->data['player-activity'] = $this->trade_activity($user);
	$this->data['pagecontent'] = 'pages/portfolio/portfolio';
	$this->data['page'] = 'pages/portfolio/portfolio';
	$this->render();
    }

    public function trade_activity($user) {
	$result = '';
	$query = $this->transactions->get_player_transaction($user);
	
	foreach ($query->result() as $row) {
	    $result .= $this->parser->parse('pages/portfolio/trading_row', (array) $row, true);
        }
	return $this->parser->parse('pages/portfolio/trading_table', array('rows' => $result), true);
    }

}
