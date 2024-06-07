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
	public function socialMediaRules()
	{
		return [
			[
				'field' => 'link',
				'label' => 'Link',
				'rules' => 'required'
			],
			[
				'field' => 'type',
				'label' => 'Tipe',
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

	public function update_password_rules()
	{
		return [
			[
				'field' => 'old_password',
				'label' => 'Password Lama',
				'rules' => 'required'
			],
			[
				'field' => 'new_password',
				'label' => 'Password Baru',
				'rules' => 'required'
			],
			[
				'field' => 'new_password_confirm',
				'label' => 'Konfirmasi Password Baru',
				'rules' => 'required|matches[new_password]'
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

	public function update_user($data)
	{
		$current_user_id = $this->current_user()->id;
		$this->db->where('id', $current_user_id);
		$this->db->update($this->_table, $data);
		return true;
	}

	public function update_password($data)
	{
		$current_user_password = $this->current_user()->password;
		if (!password_verify($data['old_password'], $current_user_password)) {
			return false;
		}
		$current_user_id = $this->current_user()->id;
		$new_password = password_hash($data['new_password'], PASSWORD_BCRYPT);
		$hash_password = [
			'password' => $new_password
		];
		$this->db->where('id', $current_user_id);
		$this->db->update($this->_table, $hash_password);
		return true;
	}
}
