<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	private $now;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Application_model');
        $this->load->model('Setting_model');
        $this->load->model('Social_Media_model');
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
    }

	public function index()
	{
        $data = [
            'categories' => $this->Category_model->getAllCategories(null, null),
            'settings' => $this->Setting_model->getAllSettings()[0],
            'social_medias' => $this->Social_Media_model->getAllSocialMedias()
        ];
        $data['meta'] = [
            'title' => $this->Setting_model->getAllSettings()[0]->company_name,
        ];
		$this->load->view('app/index', $data);
	}
}
