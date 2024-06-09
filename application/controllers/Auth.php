<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Setting_model');
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
            default:
                show_404();
                break;
        }
	}

    private function handle_login_post() {
        $rules = $this->User_model->loginRules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            return $this->load->view('auth/login');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember_me = $this->input->post('remember_me');
        if ($this->User_model->login($email, $password, $remember_me)) {
            redirect('admin/dashboard', 'location');
        } else {
			$this->session->set_flashdata('message_login_error', 'Email atau password salah!');
            $this->load->view('auth/login');
        }
    }

    private function handle_login_get() {
        $data['meta'] = [
            'title' => 'Stone Store - Login'
        ];
        $data['error'] = '';

		$this->load->view('auth/login', $data);
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
        $rules = $this->User_model->registerRules();
        $this->form_validation->set_rules($rules);
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
                'role' => 'admin',
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
            'title' => 'Stone Store - Register',
        ];
        $data['error'] = '';
        $this->load->view('auth/register', $data);
    }

    public function logout()
    {
        $this->load->model('User_model');
		$this->User_model->logout();
		redirect(site_url());
    }
}