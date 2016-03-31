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
        $this->data['pagetitle'] = '';
    }

    /**
     * Render this page
     * Used on all. We need to load data into content in the controller
     */
    function render() {
        $mymenu = array('menudata' => $this->makemenu());

        $this->data['pagetitle'] = $this->data['pagetitle'];
        $this->data['menubar'] = $this->parser->parse('menu', $mymenu, true); // this will load a menu bar into the page
        $this->data['pagecontent'] = $this->parser->parse($this->data['page'], $this->data, true);

        // Testing session
        //$this->data['user'] = $this->session->userdata['userName'];
        //$this->data['role'] = $this->session->userdata['userRole'];
        
        $this->parser->parse('template', $this->data);
    }
    function makemenu()
    {
        $choices = array();
        $role = $this->session->userdata('userRole');
        $name = $this->session->userdata('userName');
        $choices[] = array('name' => 'Dashboard', 'link' => '/');
        // Check if user
        if($role != null && $name != null)
        {
            if($role ==  ROLE_ADMIN) // constant defined in config/constants
            {
                // Only admin controls
            }
            else
            {
                // Only user controls
            }
            $choices[] = array('name' => 'Player', 'link' => '/portfolio');
            $choices[] = array('name' => 'History', 'link' => '/history');
            $choices[] = array('name' => (string) $name, 
                                 'link' => '/portfolio/detail/' . (string) $name);
            $choices[] = array('name' => 'Logout', 'link' => '/auth/logout');
        }
        else
        {
           $choices[] = array('name' => 'Login', 'link' => '/auth'); 
           $choices[] = array('name' => 'Register', 'link' => '/auth/signup');
        }
        return $choices;
    }
}
