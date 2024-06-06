<?php

class Setting_model extends CI_Model
{
    private $_table = 'apps';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllSettings()
    {
        $settings = $this->db->get($this->_table);
        return $settings->result();
    }

    public function editSettings($data)
    {
        $this->db->trans_start();

        $settings = $this->db->get($this->_table, 1);
        $result = $settings->result()[0];
        // die(var_dump(empty($result)));
        if ($_FILES['site_logo']['error'] == 0) {
            $this->load->library('upload', $this->set_upload_options());
            if (!$this->upload->do_upload('site_logo')) {
                $this->db->trans_rollback();
                return $this->upload->display_errors();
            } else {
                $image_data = $this->upload->data();
                // die(var_dump($data));
                $original_filename = $image_data['file_name'];
                $file_ext = $image_data['file_ext'];
                $hashed_filename = hash('sha256', $original_filename . time() . $file_ext);
                // die(var_dump($hashed_filename));
                // rename the file
                rename($image_data['full_path'], $image_data['file_path'] . $hashed_filename . $file_ext);
                $data['logo_filename'] = $hashed_filename . $file_ext;
                if (empty($result)) {
                    $this->db->insert($this->_table, $data);
                } else {
                    $this->db->where('id', $result->id);
                    $this->db->update($this->_table, $data);
                }
                $this->db->trans_commit();
                return true;
            }
        } else {
            if (empty($result)) {
                $this->db->insert($this->_table, $data);
            } else {
                $this->db->where('id', $result->id);
                $this->db->update($this->_table, $data);
            }
            $this->db->trans_commit();
            return true;
        }
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = FCPATH . 'assets/img/systems/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['overwrite'] = FALSE;

        return $config;
    }
}
