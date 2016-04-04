<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player extends Application {
        /*
            Default constructor for the class
        */
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');
        }
	/*
        Initially called on the controller name being passed in
        
        Loads in the title of the page
        Set's up the players content based on the user name
	*/
	public function index(){
            $this->data['pagetitle'] = 'Player';
            $this->data['page'] = 'pages/player/player';
            $this->data['searchbar'] = $this->populatesearchbar();
            $this->data['content'] = $this->getall();
            $this->render();
	}
        public function getall()
        {
            $result = '';
	    $users = $this->users->get_users();
	    foreach ($users->result() as $row) {
		  $result .= $this->parser->parse('pages/player/player_row', 
                          (array) $row, true);
	    }
            $data['rows'] = $result;
	    return $this->parser->parse('pages/player/players_table', $data, true);
        }
        public function populatesearchbar()
        {
            $result = '';
            $users = $this->users->get_users();
	    foreach ($users->result() as $user) {
		  $result .= $this->parser->parse('pages/player/searchoption', 
                          (array) $user, true);
	    }
            $data['selectdata'] = $result;
            $data['searchby'] = 'UserID';
 	    return $this->parser->parse('pages/player/select', $data, true);
        }
        public function display()
        {
            $user = $this->input->post('search');
            $this->data['pagetitle'] = 'Display - ' . (string) $user;
            $this->data['page'] = 'pages/player/player';
            $this->data['searchbar'] = $this->populatesearchbar();
            $this->data['content'] = $this->getuser($user);
            $this->render();
        }
        public function getuser($id)
        {
            $result = '';
	    $users = $this->users->get_users();
	    foreach ($users->result() as $row) {
                if($row->id == $id)
                {
		  $result .= $this->parser->parse('pages/player/player_row', 
                          (array) $row, true);
                }
	    }
            $data['rows'] = $result;
	    return $this->parser->parse('pages/player/players_table', $data, true);
        }
}
