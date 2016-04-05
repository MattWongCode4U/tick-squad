<?php

/** 
  * Auth Controller class
  *
  * Authentication controller, used when creating/registering users, or signing in/out.
  *
  * Created by Spencer 31/03/2016 11:35:12 am PDT
  */

class Auth extends Application {
    /**
     *  Construct called when the class is created.
     */
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper('url');
    }
    /**
     *  Called when directed to '/auth'.
     */
    function index()
    {
        $this->data['pagetitle'] = 'Login/Logout';
        $this->data['page'] = 'pages/login.php'; // Should load the login page
        $this->render(); // Calls Application.render();
    }
    /**
     * Called when the trying to login.
     */
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
            $this->session->set_userdata('userID', $key);
            $this->session->set_userdata('userName', $user->name);
            $this->session->set_userdata('userRole', $user->role);
            redirect('/'); // Go to the home page
        }else{
            redirect('/error/login');
        }
    }
    /**
     *  Called when the user logs out.
     */
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
    /**
     *  Called when anyone signs up as a new user.
     */
    function register()
    {
        $name = $this->input->post('name'); // This is case-sensitive
        $id = strtolower($this->input->post('userid')); // Sets the string to lower
        $dbuserid = $this->users->findusers();
        foreach($dbuserid->result() as $used)
        {
            if(strcmp((string) $used->id, (string) $id) == 0)
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
    /**
     *  Called when the admin is signing up a new users. This loads the page.
     */
    function newuser()
    {
        $this->data['pagetitle'] = 'Admin New User';
        $this->data['page'] = 'pages/admin/newuser';
        $this->render();
    }
    /**
     *  Called when the admin submits the new user form.
     */
    function adminNewUser()
    {
        $name = $this->input->post('name'); // This is case-sensitive
        $id = strtolower($this->input->post('userid')); // Sets the string to lower
        $dbuserid = $this->users->findusers();
        foreach($dbuserid as $used)
        {
            if(strcmp((string)$used, (string)$id) == 0)
            {
                redirect('/error/userid');
            }
        }
        $pass = $this->input->post('password'); // This is case-sensitive
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);
        $role = $this->input->post('role');
        if($name != null && $id != null && $pass != null && $role != null)
        {
            $hashpass = password_hash($pass, PASSWORD_DEFAULT);
            if($hashpass == FALSE)
            {
                redirect('/error/register'); // Redirects to a registration error
            }
            else
            {
                $this->users->insert($name, $id, $hashpass, $role);
                redirect('/admin/edituser');
            }
        }
        else
        {
            redirect('/error/register'); // Redirects to registeration error
        }
    }
}
