<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    private $now;
    private $domain_url;
    public function __construct()
    {
        parent::__construct();
        $this->domain_url = $this->config->item('domain_url');
        $this->load->model('Product_model');
        $this->load->model('User_model');
        if(!$this->User_model->current_user()){
			redirect('login');
		}
        $this->load->model('Category_model');
        $this->load->model('Application_model');
        $this->load->model('Setting_model');
        $this->load->model('Social_Media_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
    }

    public function index()
    {
        $total_product = $this->Product_model->get_total();
        $total_category = $this->Category_model->get_total();
        $total_app = $this->Application_model->get_total();
        $data['total_product'] = $total_product;
        $data['total_category'] = $total_category;
        $data['total_app'] = $total_app;
        $data['domain_url'] = $this->domain_url;
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
        $data['domain_url'] = $this->domain_url;
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
    
    public function edit_product($id)
    {
        if ($this->input->method() === 'get') {
            $this->Product_model->delete_product_by_id($id);
            $this->session->set_flashdata('message', 'Berhasil menghapus data produk');
            $this->session->set_flashdata('alert_color', 'success');
            return redirect('products');
        }
        $data = [
            "name" => $this->input->post("product_name"),
            "color" => $this->input->post("product_color"),
            "category_id" => $this->input->post("category_id"),
            "description" => $this->input->post("product_desc"),
            "sizes" => $this->input->post("sizes"),
            "updated_at" => $this->now
        ];

        $result = $this->Product_model->editProduct($data, $id);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil mengubah data produk');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('products');
        }
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
        $data['domain_url'] = $this->domain_url;
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

    public function application()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_application_post();
                break;
            case 'get':
                $this->handle_application_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_application_post()
    {
        $data = [
            'title' => $this->input->post('app_title'),
            'description' => $this->input->post('app_desc'),
        ];

        $result = $this->Application_model->addApplication($data);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil menambahkan data aplikasi');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('applications');
        } else {
            $this->session->set_flashdata('message', 'Gagal menambahkan data aplikasi');
            $this->session->set_flashdata('alert_color', 'danger');
            redirect('applications');
        }
    }
    public function handle_application_get()
    {
        $data['domain_url'] = $this->domain_url;
        $query_string = $this->input->get("page", true) ? $this->input->get("page", true) : 1;
        $limit = 10;
        $data['applications'] = $this->Application_model->getAllApplications($limit, $query_string-1);
        // echo '<pre>' . var_export($data['applications'], true) . '</pre>';
        // return;
        $data['total'] = $this->Application_model->get_total();
        // die(var_dump($data['total']));
        $data['limit'] = $limit;
        $data['current_page'] = $query_string;
        $data['meta'] = [
            'title' => 'Stone Store - Admin Application',
        ];
        $data['error'] = '';
        $this->load->view('admin/application', $data);
    }

    public function edit_application($id)
    {
        // cek methodnya
        $method = $this->input->method();
        if ($method === "get") {
            $this->Application_model->delete_app_by_id($id);
            $this->session->set_flashdata('message', 'Berhasil menghapus data aplikasi');
            $this->session->set_flashdata('alert_color', 'success');
            return redirect('applications');
        }
        $data = [
            'title' => trim($this->input->post('app_title')),
            'description' => trim($this->input->post('app_desc')),
            'updated_at' => $this->now
        ];
        $result = $this->Application_model->editApplication($data, $id);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil mengubah data aplikasi');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('applications');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengubah data aplikasi');
            $this->session->set_flashdata('alert_color', 'danger');
            redirect('applications');
        }
    }

    public function setting()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_setting_post();
                break;
            case 'get':
                $this->handle_setting_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_setting_post()
    {
        $data = [
            'company_name' => $this->input->post('company_name'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'is_show_logo' => (boolean)$this->input->post('show_logo') ? true : false
        ];
        $result = $this->Setting_model->editSettings($data);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil mengubah data pengaturan');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('settings');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengubah data pengaturan');
            $this->session->set_flashdata('alert_color', 'danger');
            redirect('settings');
        }
    }

    public function handle_setting_get()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Admin Setting',
        ];
        $data['domain_url'] = $this->domain_url;
        $data['settings'] = $this->Setting_model->getAllSettings()[0];
        $this->load->view('admin/setting', $data);
    }

    public function setting_profile()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_setting_profile_post();
                break;
            case 'get':
                $this->handle_setting_profile_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_setting_profile_post()
    {
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number')
        ];

        $result = $this->User_model->update_user($data);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil mengubah data pengguna');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('settings/profile');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengubah data pengguna');
            $this->session->set_flashdata('alert_color', 'danger');
            redirect('settings/profile');
        }
    }
    public function handle_setting_profile_get()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Admin Profile',
        ];
        $data['domain_url'] = $this->domain_url;
        $data['current_user'] = $this->User_model->current_user();
        $this->load->view('admin/profile', $data);
    }

    public function setting_password()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_setting_password_post();
                break;
            case 'get':
                $this->handle_setting_password_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_setting_password_post()
    {
        $this->load->library('form_validation');
        $rules = $this->User_model->update_password_rules();
        $this->form_validation->set_rules($rules);
        if (!$this->form_validation->run()) {
            $this->load->view('admin/password');
        } else {
            $data = [
                'old_password' => $this->input->post('old_password'),
                'new_password' => $this->input->post('new_password'),
                'new_password_confirm' => $this->input->post('new_password_confirm')
            ];
            $result = $this->User_model->update_password($data);
            if ($result) {
                $this->session->set_flashdata('message', 'Berhasil mengubah password');
                $this->session->set_flashdata('alert_color', 'success');
                redirect('settings/password');
            } else {
                $this->session->set_flashdata('message', 'Gagal mengubah password');
                $this->session->set_flashdata('alert_color', 'danger');
                redirect('settings/password');
            }
        }
    }
    
    public function handle_setting_password_get()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Admin Password',
        ];
        $data['domain_url'] = $this->domain_url;
        $this->load->view('admin/password', $data);
    }

    public function setting_social_media()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_setting_social_media_post();
                break;
            case 'get':
                $this->handle_setting_social_media_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_setting_social_media_post()
    {
        $data = [
            'link' => trim($this->input->post('link')),
            'type' => trim($this->input->post('type')),
            'account_name' => 'dummy'
        ];

        $result = $this->Social_Media_model->add_social_media($data);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil menambah sosial media');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('settings/social-media');
        } else {
            $this->session->set_flashdata('message', 'Gagal menambah sosial media');
            $this->session->set_flashdata('alert_color', 'danger');
            redirect('settings/social-media');
        }
    }
    public function handle_setting_social_media_get()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Admin Sosial Media',
        ];
        $data['domain_url'] = $this->domain_url;
        $data['social_medias'] = $this->Social_Media_model->getAllSocialMedias();
        $this->load->view('admin/social_media', $data);
    }

    public function edit_social_media($id)
    {
        // cek methodnya
        $method = $this->input->method();
        if ($method === "get") {
            $this->Social_Media_model->delete_social_media_by_id($id);
            $this->session->set_flashdata('message', 'Berhasil menghapus sosial media');
            $this->session->set_flashdata('alert_color', 'success');
            return redirect('settings/social-media');
        }

        $data = [
            'link' => trim($this->input->post('link')),
            'type' => trim($this->input->post('type')),
            'account_name' => 'dummy'
        ];

        $result = $this->Social_Media_model->edit_social_media($data, $id);
        if ($result) {
            $this->session->set_flashdata('message', 'Berhasil mengedit sosial media');
            $this->session->set_flashdata('alert_color', 'success');
            redirect('settings/social-media');
        } else {
            $this->session->set_flashdata('message', 'Gagal mengedit sosial media');
            $this->session->set_flashdata('alert_color', 'danger');
            redirect('settings/social-media');
        }
    }
}