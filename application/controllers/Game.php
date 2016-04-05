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
        $this->render();
    }
}
