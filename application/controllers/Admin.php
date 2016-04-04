<?php

/** 
  * Admin Controller class
  *
  * Created by Spencer 03/04/2016 08:37:45 pm PDT
  */

class Admin extends Application {
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper('url');
    }
    function index()
    {
        $this->data['pagetitle'] = 'Console';
        $this->data['page'] = 'pages/admin/console';
        $this->data['content'] = $this->loadconsole();
        $this->render();
    }
    function loadconsole()
    {
        $console = '';
        $console .= $this->parser->parse('pages/admin/consolelist', array('option' => 'newuser', 'optiontext' => 'New User'), true);
        $console .= $this->parser->parse('pages/admin/consolelist', array('option' => 'edituser', 'optiontext' => 'Edit Users'), true);
        return $console;
    }
    function newuser()
    {
        redirect('/auth/newuser');
    }
    function edituser()
    {
        $this->data['pagetitle'] = 'Edit Users';
        $this->data['page'] = 'pages/admin/console';
        $this->data['content'] = $this->loadconsole() . $this->getall();
        $this->render();
    }
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
    public function edit($id)
    {
        // Get all the information from the database and put it into text boxes
        // then just delete the user from the database before inserting again
        // or just edit the information 
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
    public function update($id)
    {
        $name = $this->input->post('name');
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        
        $this->users->edit($name, $id, $role);
        redirect('/admin/edituser');
    }
    public function delete($id)
    {
       $this->users->removeuser($id); 
       redirect('/admin/edituser');
    }
}
