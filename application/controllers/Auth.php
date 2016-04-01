<?php

/** 
  * Auth Controller class
  *
  * Created by Spencer 31/03/2016 11:35:12 am PDT
  */

class Auth extends Application {
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper('url');
    }
    function index()
    {
        $this->data['pagetitle'] = 'Login/Logout';
        $this->data['page'] = 'pages/login.php'; // Should load the login page
        $this->render(); // Calls Application.render();
    }
    function submit()
    {
        $key = $this->input->post('userid');
        $user = $this->users->get($key); // Gets the user from the users model loaded in
        
        if($user == null)
        {
            echo "User is not in the database";
        }
        
        if(password_verify($this->input->post('password'), $user->password))
        {
            // Gets the data from the database
            $this->session->set_userdata('userID', $key);
            $this->session->set_userdata('userName', $user->name);
            $this->session->set_userdata('userRole', $user->role);
            redirect('/'); // Go to the home page
        }else{
            //echo 'error';
            redirect('/error/login');
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/'); // Got to the home page
    }
    /**
     * Loads the register page
     */
    function signup()
    {
        $this->data['pagetitle'] = 'Register';
        $this->data['page'] = 'pages/register';
        $this->render();
    }
    function register()
    {
        // Sign up user
        $name = $this->input->post('name'); // This is case-sensitive
        $id = strtolower($this->input->post('userid')); // Sets the string to lower
        // search the database for a user with the same id
        $dbuserid = $this->users->findusers();
        foreach($dbuserid as $used)
        {
            if($used == $id)
            {
                redirect('/error/userid');
            }
        }
        $pass = $this->input->post('password'); // This is case-sensitive
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);

        if($name != null && $id != null && $pass != null)
        {
            $hashpass = password_hash($pass, PASSWORD_DEFAULT);
            if($hashpass == FALSE)
            {
                // Hash failed
                redirect('/error/register'); // Redirects to a registration error
            }
            else
            {
                $this->users->insert($name, $id, $hashpass, 'user');
                redirect('/');
            }
        }
        else
        {
            redirect('/error/register'); // Redirects to registeration error
        }
    }
    function newuser()
    {
        $this->data['pagetitle'] = 'Admin New User';
        $this->data['page'] = 'pages/admin/newuser';
        $this->render();
    }
    function adminNewUser()
    {
        // Sign up user
        $name = $this->input->post('name'); // This is case-sensitive
        $id = strtolower($this->input->post('userid')); // Sets the string to lower
        // search the database for a user with the same id
        $dbuserid = $this->users->findusers();
        foreach($dbuserid as $used)
        {
            if($used == $id)
            {
                redirect('/error/userid');
            }
        }
        $pass = $this->input->post('password'); // This is case-sensitive
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);
        $role = $this->input->post('role');

        if($name != null && $id != null && $pass != null && role != null)
        {
            $hashpass = password_hash($pass, PASSWORD_DEFAULT);
            if($hashpass == FALSE)
            {
                // Hash failed
                redirect('/error/register'); // Redirects to a registration error
            }
            else if($role == 'admin' || $role == 'user')
            {
                $this->users->insert($name, $id, $hashpass, $role);
                redirect('/');
            }
            else
            {
                redirect('/error/register');
            }
        }
        else
        {
            redirect('/error/register'); // Redirects to registeration error
        }
    }
}
