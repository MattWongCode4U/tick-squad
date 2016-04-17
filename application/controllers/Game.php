<?php

/** 
  * Game Controller class
  *
  * Game controller for the majority of the game.
  *
  * Created by Spencer 04/04/2016 04:23:04 pm PDT
  */

class Game extends Application {
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
    }
    function index()
    {
        $this->data['pagetitle'] = 'Game';
        $this->data['page'] = 'pages/game/game';
        $this->data['sidebar'] = $this->loadSidebar();
        $this->data['chart'] = $this->generategame();
        $this->data['scripts'] = $this->loadscripts();
        $this->render();
    }
    function loadSidebar()
    {
        // Get stocks
        $stuff = array();
        $stuff['selectdata'] = $this->populateSearchBar();
        return $this->parser->parse('pages/game/sidebar', $stuff, true);
    }
    function populateSearchBar()
    {
        $result ='';
        $stocks = $this->stocks->get_stocks();
        foreach ($stocks->result() as $stock)
        {
            $result .= $this->parser->parse('pages/history/searchoption',
                (array) $stock, true);
        }
        return $result;
    }
    function generategame()
    {
        return $this->parser->parse('pages/game/chart', array(), true);
    }
    function loadscripts()
    {
        $query = $this->stocks->get_stocks();
        $stockinfo['stockname'] = '';
        $stockinfo['stockvalue'] = '';
        foreach ($query->result() as $info) {
	        $stockinfo['stockname'] .= '"' . (string) $info->Name . '", ';
            $stockinfo['stockvalue'] .= (string) $info->Value . ', ';
	    }
        return $this->parser->parse('pages/game/scripts', $stockinfo, true);
    }
}
