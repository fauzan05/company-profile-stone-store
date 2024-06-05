<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    private $now;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->model('Category_model');
        $this->load->library('form_validation');
        if(!$this->User_model->current_user()){
			redirect('login');
		} 
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
    }

    public function index()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Admin Dashboard',
        ];
        $this->load->view('admin/dashboard', $data);
    }

    public function product()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_add_product_post();
                break;
            case 'get':
                $this->handle_add_product_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_add_product_post()
    {
        $data = [
            'name' => $this->input->post('product_name'),
            'category_id' => (int)$this->input->post('category_id'),
            'sizes' => $this->input->post('sizes', false),
            'description' => $this->input->post('product_desc'),
            'color' => $this->input->post('product_color')
        ];
        // die(var_dump($data));
        $result = $this->Product_model->addProduct($data);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil menambahkan data produk');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('products');
        }
    }

    public function handle_add_product_get()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Admin Products',
        ];
        $limit = 10;
        $data['limit'] = $limit;
        $query_string = $this->input->get("page", true) ? $this->input->get("page", true) : 1;
        $data['current_page'] = $query_string;
        $result = $this->Category_model->getAllCategories(null, null);
        $data['categories'] = $result;
        $result = $this->Product_model->getAllProducts($limit, $query_string-1);
        $data['products'] = $result;
        $result = $this->Product_model->get_total();
        $data['total'] = $result;
        $data['error'] = '';
        $this->load->view('admin/product', $data);
    }

    public function create_account()
    {
        $admin_data = array(
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'email' => 'admin@email.com',
            'role' => 'admin',
            'image_filename' => 'guest.jpg',
            'phone_number' => '123456789'
        );
        $table = 'users';
        return $this->db->insert($table, $admin_data);
    }

    // Kategori

    public function category()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_category_post();
                break;
            case 'get':
                $this->handle_category_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_category_post()
    {
        $data['meta'] = [
        'title' => 'Stone Store - Admin Categories',
        ];
        // $data['error'] = '';
        $rules = $this->Category_model->categoryRules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('add_category_error', 'Data tidak valid');
            return $this->load->view('admin/category', $data);
        }
        if ($_FILES) {
            $data = [
                'name' => trim($this->input->post('category_name')),
                'description' => trim($this->input->post('category_description'))
            ];
            $this->Category_model->addCategory($data, $_FILES);
        }
        return redirect('categories');
    }
    public function handle_category_get()
    {
        $query_string = $this->input->get("page", true) ? $this->input->get("page", true) : 1;
        $limit = 10;
        $data['categories'] = $this->Category_model->getAllCategories($limit, $query_string-1);
        $data['total'] = $this->Category_model->get_total();
        // die(var_dump($data['total']));
        $data['limit'] = $limit;
        $data['current_page'] = $query_string;
        $data['meta'] = [
            'title' => 'Stone Store - Admin Categories',
        ];
        $data['error'] = '';
        $this->load->view('admin/category', $data);
    }

    public function edit_category($id)
    {
        // cek methodnya
        $method = $this->input->method();
        if ($method === "get") {
            $this->Category_model->delete_category_by_id($id);
            $this->session->set_flashdata('message', 'Berhasil menghapus data kategori');
            $this->session->set_flashdata('alert_color', 'success');
            return redirect('categories');
        }
        $data = [
            'name' => trim($this->input->post('category_name')),
            'description' => trim($this->input->post('category_description')),
            'updated_at' => $this->now
        ];
        $result = $this->Category_model->editCategory($data, $id);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil mengubah data kategori');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('categories');
        }
    }
}