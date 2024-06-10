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
        if ($_FILES['image-upload']['error'] == 0) {
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
                $data['slug'] = $this->createSlug($data['name']);
                $this->db->insert($this->_table, $data);

                return true;
            }
        } else {
            return "Gambar harus di upload!";
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
                $data['slug'] = $this->createSlug($data['name']);
                $this->db->where('id', $id);
                $this->db->update($this->_table, $data);

                return true;
            }
        } else {
            $data['slug'] = $this->createSlug($data['name']);
            $this->db->where('id', $id);
            $this->db->update($this->_table, $data);
            return true;
        }
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = FCPATH . 'assets/img/categories/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['overwrite'] = FALSE;

        return $config;
    }

    public function delete_category_by_id($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('products');
        return $this->db->delete($this->_table, ['id' => $id]);
    }

    function createSlug($string)
    {
        // Convert to lowercase
        $string = strtolower($string);

        // Remove non-alphanumeric characters (excluding hyphens and spaces)
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);

        // Replace multiple spaces or hyphens with a single hyphen
        $string = preg_replace('/[\s-]+/', '-', $string);

        // Trim hyphens from the beginning and end of the string
        $string = trim($string, '-');

        return $string;
    }


    public function get_image_categories($slug)
    {
        $this->db->where('slug', $slug);
        $category = $this->db->get($this->_table)->result()[0];
        return $category->image_filename;
    }
}
