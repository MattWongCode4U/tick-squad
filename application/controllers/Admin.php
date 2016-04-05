<?php

/** 
  * Admin Controller class
  *
  * Handles the Admin accounts when they access the admin control panel.
  *
  * Created by Spencer 03/04/2016 08:37:45 pm PDT
  */

class Admin extends Application {
    /**
     *  Constructor for the Admin Class.
     */
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper('url');
    }
    /**
     *  Index called when accessing '/admin'
     *  Loads the basic page.
     */
    function index()
    {
        $this->data['pagetitle'] = 'Console';
        $this->data['page'] = 'pages/admin/console';
        $this->data['content'] = $this->loadconsole();
        $this->render();
    }
    /**
     *  Loads the admin console onto the page for admin controls.
     */
    function loadconsole()
    {
        $console = '';
        $console .= $this->parser->parse('pages/admin/consolelist', array('option' => 'newuser', 'optiontext' => 'New User'), true);
        $console .= $this->parser->parse('pages/admin/consolelist', array('option' => 'edituser', 'optiontext' => 'Edit Users'), true);
        return $console;
    }
    /**
     *  Create a new user with extra control.
     */
    function newuser()
    {
        redirect('/auth/newuser');
    }
    /**
     *  Edit users and their data. Cannot edit the user's avatar.
     */
    function edituser()
    {
        $this->data['pagetitle'] = 'Edit Users';
        $this->data['page'] = 'pages/admin/console';
        $this->data['content'] = $this->loadconsole() . $this->getall();
        $this->render();
    }
    /**
     *  Get's all the users and puts them into the admin console when editing users is selected.
     */
    public function getall()
    {
        $result = '';
	    $users = $this->users->get_users();
	    foreach ($users->result() as $row) {
		    $result .= $this->parser->parse('pages/admin/user_row', 
                          (array) $row, true);
	    }
        $data['rows'] = $result;
	    return $this->parser->parse('pages/admin/user_table', $data, true);
    }
    /**
     *  Edit the user based on the user's id.
     *  This loads in the user's current information.
     *  Cannot edit the user's ID after being created.
     */
    public function edit($id)
    {
        $userdb = $this->users->searchuserid($id); 
        $user = array();
        foreach ($userdb->result() as $result)
        {
            $user = (array) $result;
        }
        $this->data['page'] = 'pages/admin/console';
        $this->data['content'] = $this->loadconsole() . $this->parser->parse('pages/admin/edituser', (array) $user, true);
        $this->render();
    }
    /**
     *  Update the user based on the ID and the information submitted from the form.
     */
    public function update($id)
    {
        $name = $this->input->post('name');
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        
        $this->users->edit($name, $id, $role);
        redirect('/admin/edituser');
    }
    /**
     *  Delete the user from the database based on their ID.
     */
    public function delete($id)
    {
       $this->users->removeuser($id); 
       redirect('/admin/edituser');
    }
}
