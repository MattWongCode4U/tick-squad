<?php

/** 
  * Users Model class
  *
  * Created by Spencer 24/03/2016 03:57:55 pm PDT
  */

class Users extends MY_Model {
    public $name;
    public $id;
    public $role;
    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct('user', 'id');
    }
    public function insert($name, $id, $pass, $role)
    {
        $user = array('name' => $name,
                      'id' => $id,
                      'password' => $pass,
                      'role' => $role,
                     );
        $this->add($user);
    }
    public function findusers()
    {
       return $this->db->query('SELECT id from user'); 
    }
    public function get_users()
    {
        return $this->db->query('SELECT * from user');
    }
    public function searchuserid($id)
    {
        return $this->db->query('SELECT * from user WHERE id = \'' . $id . '\'');
    }
    public function removeuser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
    public function edit($name, $id, $role)
    {
        $data = array(
            'name' => $name,
            'role' => $role,
        );
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    public function get_avatar($id)
    {
        $ext = './data/uploads/avatars/';
        $png = $ext.$id.'.png';
        $jpg = $ext.$id.'.jpg';
        $gif = $ext.$id.'.gif';
        if(is_file($png) != FALSE)
        {
            return $png;
        }
        else if(is_file($jpg) != FALSE)
        {
            return $jpg; 
        }
        else if(is_file($gif) != FALSE)
        {
            return $gif;
        }
        else
        {
            return null;
        }
    }
}
