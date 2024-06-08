<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    private $now;
    private $domain_url;
    public function __construct()
    {
        parent::__construct();
        $this->domain_url = $this->config->item('domain_url');
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
        $data['domain_url'] = $this->domain_url;
        $data['meta'] = [
            'title' => $this->Setting_model->getAllSettings()[0]->company_name,
        ];
        $this->load->view('app/index', $data);
    }
    public function products()
    {
        $data = [
            'categories' => $this->Category_model->getAllCategories(null, null),
            'settings' => $this->Setting_model->getAllSettings()[0],
            'social_medias' => $this->Social_Media_model->getAllSocialMedias()
        ];
        $data['domain_url'] = $this->domain_url;
        $data['meta'] = [
            'title' => $this->Setting_model->getAllSettings()[0]->company_name,
        ];
        $this->load->view('app/product', $data);
    }

    public function show_all_products($slug)
    {
        $data = [
            'categories' => $this->Category_model->getAllCategories(null, null),
            'settings' => $this->Setting_model->getAllSettings()[0],
            'social_medias' => $this->Social_Media_model->getAllSocialMedias()
        ];
        $data['domain_url'] = $this->domain_url;
        $result = $this->Product_model->get_all_products_by_slug($slug);
        //    echo '<pre>' . var_export($result, true) . '</pre>';
        //     return;
        $data['meta'] = [
            'title' => $this->Setting_model->getAllSettings()[0]->company_name . ' - ' . $this->unslug($slug),
        ];
        $data['image_filename'] = $this->Category_model->get_image_categories($slug);
        $data['unslug'] = $this->unslug($slug);
        $data['products'] = $result;
        $this->load->view('app/slug', $data);
    }

    private function unslug($slug)
    {
        // Mengganti tanda hubung dengan spasi
        $text = str_replace('-', ' ', $slug);
        // Mengembalikan teks dengan huruf kapital pada awal kata
        return ucwords($text);
    }
}
