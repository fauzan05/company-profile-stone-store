<?php

class Product_model extends CI_Model
{
    private $_table = 'products';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllProducts($limit, $offset)
    {
        $this->db->select($this->_table . '.*, image_products.filename as product_image, categories.name as category_name, products.name as product_name, categories.description as category_desc,
        products.description as product_desc, products.created_at as product_created_at, products.updated_at as product_updated_at, products.id as product_id, categories.id as category_id');
        $this->db->from($this->_table);
        $this->db->join('image_products', 'image_products.product_id = ' . $this->_table . '.id');
        $this->db->join('categories', 'categories.id = ' . $this->_table . '.category_id');
        $this->db->limit($limit, $offset); // Menambahkan LIMIT dan OFFSET di sini
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total()
    {
        return $this->db->count_all($this->_table);
    }

    // public function addProductImageMany($data)
    // {
    //     $this->load->library('upload');
    //     $files = $_FILES;
    //     foreach ($_FILES['product_images']['name'] as $key => $image) {
    //         $_FILES['product_images']['name'] = $files['product_images']['name'][$key];
    //         $_FILES['product_images']['type'] = $files['product_images']['type'][$key];
    //         $_FILES['product_images']['tmp_name'] = $files['product_images']['tmp_name'][$key];
    //         $_FILES['product_images']['error'] = $files['product_images']['error'][$key];
    //         $_FILES['product_images']['size'] = $files['product_images']['size'][$key];
    //         $this->upload->initialize($this->set_upload_options());
    //         if (!$this->upload->do_upload('product_images')) {
    //             // die(var_dump("Sampai Sini"));
    //             return $this->upload->display_errors();
    //         }
    //     }
    //     return true;
    //     // $result = $this->db->insert($this->_table, $data);
    //     // if ($result) {
    //     // 	return true;
    //     // }
    //     // return false;
    // }

    public function addProduct($data)
    {
        $this->load->library('upload', $this->set_upload_options());

        if (!$this->upload->do_upload('image-upload')) {
            return $this->upload->display_errors();
        } else {
            $this->db->insert($this->_table, $data);
            $product_id = $this->db->insert_id();

            $image_data = $this->upload->data();
            // die(var_dump($data));
            $original_filename = $image_data['file_name'];
            $file_ext = $image_data['file_ext'];
            $hashed_filename = hash('sha256', $original_filename . time() . $file_ext);
            // die(var_dump($hashed_filename));
            // rename the file
            rename($image_data['full_path'], $image_data['file_path'] . $hashed_filename . $file_ext);
            $image_product['filename'] = $hashed_filename . $file_ext;
            $image_product['product_id'] = $product_id;

            $this->db->insert('image_products', $image_product);
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

    public function delete_product_by_id($id)
    {
        return $this->db->delete($this->_table, ['id' => $id]);
    }

    public function editProduct($data, $id)
    {
        if ($_FILES['image-upload-edit']['error'] == 0) {
            $this->load->library('upload', $this->set_upload_options());
            if (!$this->upload->do_upload('image-upload-edit')) {
                return $this->upload->display_errors();
            } else {
                $this->db->where('id', $id);
                $this->db->update($this->_table, $data);

                $image_data = $this->upload->data();
                // die(var_dump($data));
                $original_filename = $image_data['file_name'];
                $file_ext = $image_data['file_ext'];
                $hashed_filename = hash('sha256', $original_filename . time() . $file_ext);
                // die(var_dump($hashed_filename));
                // rename the file
                rename($image_data['full_path'], $image_data['file_path'] . $hashed_filename . $file_ext);
                $image_product['filename'] = $hashed_filename . $file_ext;

                $this->db->where('product_id', $id);
                $this->db->update('image_products', $image_product);
                return true;
            }
        } else {
            $this->db->where('id', $id);
            $this->db->update($this->_table, $data);
            return true;
        }
    }
}
