<?php

class User_model extends CI_Model
{
	private $_table = 'users';

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
				'rules' => 'required|valid_email|max_length[32]'
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
			return false;
		}
		return true;
	}
}