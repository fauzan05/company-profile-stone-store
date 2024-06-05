<?php

class Category_model extends CI_Model
{
    private $_table = 'categories';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllCategories($limit, $offset)
    {
        $categories = $this->db->get($this->_table, $limit, $offset);
        return $categories->result();
    }

    public function get_total()
    {
        return $this->db->count_all($this->_table);
    }

    public function categoryRules()
    {
        return [
            [
                'field' => 'category_name',
                'label' => 'Name',
                'rules' => 'required|max_length[100]'
            ],
            [
                'field' => 'category_description',
                'label' => 'Description',
                'rules' => 'required'
            ],
        ];
    }

    public function addCategory($data)
    {        
        $this->load->library('upload', $this->set_upload_options());

        if (!$this->upload->do_upload('image-upload')) {
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
            $data['image_filename'] = $hashed_filename . $file_ext;
            $this->db->insert($this->_table, $data);
            
            return true;
        }
    }

    public function editCategory($data, $id)
    {
        if ($_FILES['image-upload-edit']['error'] == 0) {
            $this->load->library('upload', $this->set_upload_options());
            if (!$this->upload->do_upload('image-upload-edit')) {
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
                $data['image_filename'] = $hashed_filename . $file_ext;
                $this->db->where('id', $id);
                $this->db->update($this->_table, $data);
                
                return true;
            }
        } else {
            $this->db->where('id', $id);
            $this->db->update($this->_table, $data);
            return true;
        }

    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = FCPATH . 'assets/img/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function delete_category_by_id($id)
    {
        return $this->db->delete($this->_table, ['id' => $id]);
    }

}