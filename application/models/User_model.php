<?php

class User_model extends CI_Model
{
	private $_table = 'users';
	const SESSION_KEY = 'user_id';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function getAllUsers()
	{
		$query = $this->db->get($this->_table);
		return $query->result;
	}

	public function loginRules()
	{
		return [
			[
				'field' => 'email', 
				'label' => 'Email', 
				'rules' => 'required'
			],
			[
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'required'
			]
		];
	}
	public function registerRules()
	{
		return [
			[
				'field' => 'first_name', 
				'label' => 'First Name', 
				'rules' => 'required|max_length[32]'
			],
			[
				'field' => 'last_name', 
				'label' => 'Last Name', 
				'rules' => 'required|max_length[32]'
			],
			[
				'field' => 'username', 
				'label' => 'Username', 
				'rules' => 'required|max_length[32]'
			],
			[
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'required'
			],
			[
				'field' => 'password_confirmation', 
				'label' => 'Password Confirmation', 
				'rules' => 'required|matches[password]'
			],
			[
				'field' => 'email', 
				'label' => 'Email', 
				'rules' => 'required|valid_email|max_length[32]'
			],
			[
				'field' => 'phone_number', 
				'label' => 'Phone Number', 
				'rules' => 'required|max_length[15]'
			],
		];
	}

	public function register($data)
	{
		$result = $this->db->insert($this->_table, $data);
		if ($result) {
			return true;
		}
		return false;
	}

	public function login($email, $password, $remember_me)
	{	
		$this->db->where('email', $email);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah password-nya benar?
		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		// bikin session
		if ($remember_me == "on") {
			$this->session->set_userdata([self::SESSION_KEY => $user->id], 604800);
		} else {
			$this->session->set_userdata([self::SESSION_KEY => $user->id], 86400);
		}
		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id' => $user_id]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}