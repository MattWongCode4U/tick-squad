<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player extends Application {

	/*
        Initially called on the controller name being passed in
        
        Loads in the title of the page
        Set's up the players content based on the user name
	*/
	public function index(){
            $this->data['pagetitle'] = ucfirst('player'); // Capitalize the first letter
            $this->data['page'] = 'pages/player';
            $this->data['content'] = '';
            $this->render();
	}
}
