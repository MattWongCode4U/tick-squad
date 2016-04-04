<?php

/** 
  * Upload Controller class
  *
  * Created by Spencer 04/04/2016 11:52:50 am PDT
  */

class Upload extends Application {
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }
    function index()
    {
        $this->data['pagetitle'] = 'Upload Form';
        $this->data['page'] = 'pages/upload/upload_form';
        $this->data['error'] = '';
        $this->render();
    }
    function do_upload()
    {
        $this->data['pagetitle'] = 'Uploading...';

        $newname = $this->session->userdata('userID');

        $upconfig['upload_path'] = './data/uploads/avatars';
        $upconfig['allowed_types'] = 'gif|jpg|png';
        $upconfig['max_size'] = 2048;
        $upconfig['max_width'] = 1920;
        $upconfig['max_height'] = 1080;
        $upconfig['overwrite'] = TRUE;

        $upconfig['file_name'] = $newname;

        $this->load->library('upload', $upconfig);
        
        $file = $this->users->get_avatar($this->session->userdata('userID'));
        if($file != NULL)
        {
            unlink($file);
        }

        if (! $this->upload->do_upload('userfile'))
        {
            $this->data['page'] = 'pages/upload/upload_form';
            $this->data['error'] = $this->upload->display_errors();
            $this->render();
        }
        else
        {
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config2['new_image'] = './data/uploads/avatars';
            $config2['maintain_ratio'] = TRUE;
            $config2['create_thumb'] = TRUE;
            $config2['thumb_marker'] = '';
            $config2['width'] = 60;
            $config2['height'] = 60;
            $this->load->library('image_lib',$config2);
            $this->image_lib->resize();

            $this->data['page'] = 'pages/upload/upload_success';
            $this->render();
        }
    }
}
