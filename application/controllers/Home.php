<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Application {

	/*
        Initially called on the controller name being passed in
        
        Loads in the title of the page
        Sets up the players panel and stock panel of the page by parsing in the data obtained from the players data by user name and stock data by time
        Players_panel gets the data from all the players in the database
        Stocks_panel passees in  the data from all the stocks in the database
	*/
	public function index()	{
            $this->data['pagetitle'] = ucfirst('home'); // Capitalize the first letter
            $this->data['players-panel'] = $this->players_panel();
            $this->data['stocks-panel'] = $this->stocks_panel();
            $this->data['page'] = 'pages/home/home';
            $this->data['content'] = 'pages/home/home';
            $this->render();
	}
	
	public function players_panel() {
	    $result = '';
	    $players = $this->players->get_players();
	    foreach ($players->result() as $row) {
		  $result .= $this->parser->parse('pages/home/player_row', (array) $row, true);
	    }
        $data['rows'] = $result;
	    return $this->parser->parse('pages/home/players_table', $data, true);
	}

	public function stocks_panel() {
	    $result = '';
        $query = $this->stocks->get_stocks();
 	    foreach ($query->result() as $row) {
		  $result .= $this->parser->parse('pages/home/stock_row', (array) $row, true);
	    }
	    $data['rows'] = $result;
	    return $this->parser->parse('pages/home/stocks_table', $data, true);
	}
}
