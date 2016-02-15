<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2015, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
	
	//Login
	if($this->session->userdata('username')) {
	    $this->data['login-menu'] = $this->parser->parse("pages/login/logout_menu", $this->data, true);	        
   	} else {
	    $this->data['login-menu'] = $this->parser->parse("pages/login/login_menu", $this->data, true);
    	}
    }

    /**
     * Render this page
     * Used on all. We need to load data into content in the controller
     */
    function render() {
        $this->data['pagetitle'] = $this->data['pagetitle'];
        $this->data['pagecontent'] = $this->parser->parse($this->data['page'], $this->data, true);
        $this->parser->parse('template', $this->data);
    }
}
