<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->library('form_validation');
    }

    public function login()
	{
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_login_post();
                break;
            case 'get':
                $this->handle_login_get();
                break;
            case 'delete':
                $this->handle_login_delete();
                break;
            default:
                show_404();
                break;
        }
	}

    private function handle_login_post() {
        $data['meta'] = [
            'title' => 'Stone Store - Login'
        ];
        echo json_encode($data);
    }
    private function handle_login_get() {
        $data['meta'] = [
            'title' => 'Stone Store - Login'
        ];
		$this->load->view('auth/login', $data);
    }
    private function handle_login_delete() {

    }

    public function register()
    {
        $method = $this->input->method();
        switch ($method) {
            case 'post':
                $this->handle_register_post();
                break;
            case 'get':
                $this->handle_register_get();
                break;
            default:
                show_404();
                break;
        }
    }

    public function handle_register_post()
    {
        $this->form_validation->set_rules($this->User_model->registerRules());

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan kesalahan
            $this->load->view('auth/register');
        } else {
            // Jika validasi berhasil, simpan data ke database
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'email' => $this->input->post('email'),
                'phone_number' => $this->input->post('phone_number')
            ];

            if ($this->User_model->register($data)) {
                // Jika pendaftaran berhasil, redirect ke halaman sukses atau login
                redirect('auth/login');
            } else {
                // Jika pendaftaran gagal, tampilkan pesan kesalahan
                $this->load->view('auth/register', ['error' => 'Failed to register user. Please try again.']);
            }
        }
    }

    public function handle_register_get()
    {
        $data['meta'] = [
            'title' => 'Stone Store - Register'
        ];
        $this->load->view('auth/register', $data);
    }
}