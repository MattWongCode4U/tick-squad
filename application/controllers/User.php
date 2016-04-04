<?php

/** 
  * User Controller class
  *
  * Created by Spencer 04/04/2016 11:44:02 am PDT
  */

class User extends Application {
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper('url');
    }
    function index()
    {
        $this->data['pagetitle'] = 'User Settings';
        $this->data['page'] = 'pages/user/settings';
        $this->data['content'] = $this->userimg();
        $this->render();
    }
    function upload()
    {
        redirect('/upload');
    }
    function userimg()
    {
        $id = $this->session->userdata('userID');
        $user['avatar'] = $this->users->get_avatar($id); // path 
        if($user['avatar'] == NULL){
            $user['avatar'] = './data/uploads/default/default.png'; 
        }
        return $this->parser->parse('pages/user/img', $user, true);
    }
}
