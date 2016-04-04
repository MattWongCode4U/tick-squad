<?php

/** 
  * Error Controller class
  *
  * Created by Spencer 31/03/2016 06:34:17 pm PDT
  */

class Error extends Application {
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper('url');
    }
    function index()
    {
        $this->data['pagetitle'] = 'Error';
        $this->data['page'] = '<center>General Error</center>';
        $this->render();
    }
    /**
     * Load error page for Registration
     */
    function register()
    {
        $this->data['pagetitle'] = 'Registration Error';
        $this->data['page'] = 'errors/register_error'; 
        $this->render();
    }
    /**
     * Load error page for Login
     */
    function login()
    {
        $this->data['pagetitle'] = 'Login Error';
        $this->data['page'] = 'errors/login_error';
        $this->render();
    }
    function userid()
    {
        $this->data['pagetitle'] = 'UserID in use';
        $this->data['page'] = 'errors/userid_error';
        $this->render();
    }
    function wip()
    {
        $this->data['pagetitle'] = 'Work in progress';
        $this->data['page'] = 'errors/wip';
        $this->render();
    }
}
