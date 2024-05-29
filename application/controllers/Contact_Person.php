<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_person extends CI_Controller {

    public function contact()
	{
        // $data = $this->input()->get();
		$this->load->view('kontak');
	}
}