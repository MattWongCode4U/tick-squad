<?php

/** 
  * Users Model class
  *
  * Created by Spencer 24/03/2016 03:57:55 pm PDT
  */

class Users extends MY_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct('user', 'id');
    }
    function insert($name, $id, $pass, $role)
    {
        $user = array('name' => $name,
                      'id' => $id,
                      'password' => $pass,
                      'role' => $role,
                     );
        $this->add($user);
    }
    function findusers()
    {
       return $this->db->query('SELECT id from user'); 
    }
}
