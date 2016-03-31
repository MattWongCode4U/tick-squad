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
            echo 'error';
        }
        
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/'); // Got to the home page
    }
    function signup()
    {
        $this->data['pagetitle'] = 'Register';
        $this->data['page'] = 'pages/register';
        $this->render();
    }
    function register()
    {
        // Sign up user
        $name = $this->input->post('name');
        $id = $this->input->post('userid');
        $pass = $this->input->post('password');
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);
        if($hashpass == FALSE)
        {
            echo "Hashpass has failed.";
        }
        else
        {
            $this->users->insert($name, $id, $hashpass, 'user');
        }
        redirect('/');
    }
}
