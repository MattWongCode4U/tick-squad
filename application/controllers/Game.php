<?php

/** 
  * Game Controller class
  *
  * Game controller for the majority of the game.
  *
  * Created by Spencer 04/04/2016 04:23:04 pm PDT
  */

class Game extends Application {
    /**
     * Game constructor
     */
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
    }
    
    /**
     * Loads the game
     */
    function index()
    {
        $this->data['pagetitle'] = 'Game';
        $this->data['page'] = 'pages/game/game';
        $this->data['sidebar'] = $this->loadSidebar();
        $this->data['chart'] = $this->generategame();
        $this->data['scripts'] = $this->loadscripts();
        $this->render();
    }
    
    /**
     * Load the game's sidebar
     */
    function loadSidebar()
    {
        // Get stocks
        $stuff = array();
        $stuff['selectdata'] = $this->populateSearchBar();
        return $this->parser->parse('pages/game/sidebar', $stuff, true);
    }
    
    /**
     * Populate search bar
     */
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
    
    /**
     * Generates the game
     */
    function generategame()
    {
        return $this->parser->parse('pages/game/chart', array(), true);
    }
    
    /**
     * Load scripts
     */
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
