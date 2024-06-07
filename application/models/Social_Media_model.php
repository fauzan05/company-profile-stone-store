<?php

class Social_Media_model extends CI_Model
{
    private $_table = 'social_media';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllSocialMedias()
    {
        $social_media = $this->db->get($this->_table);
        return $social_media->result();
    }

    public function add_social_media($data)
    {
        $this->db->insert($this->_table, $data);
        return true;
    }
}