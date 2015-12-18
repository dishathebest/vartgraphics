<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->library('tank_auth');
	$this->load->model(array('category_model', 'product_model', 'banner_model', 'cms'));
	if (!$this->tank_auth->is_logged_in()) {
	    redirect($this->config->item('base_url_admin') . 'auth/login/');
	}
    }

    public function index() {
	$data['content'] = "dashboard_view";
	$data['title'] = "Dashboard :: V.Art Graphics";
	$data['head_page'] = "Dashboard";
	$data['categories'] = $this->category_model->getParentCategoryList(array("cat_id"));
	$data['products'] = $this->product_model->getProductList(array("pro_id"));
	$data['pages'] = $this->cms->getPageList(array("page_id"));
	$data['banners'] = $this->banner_model->getBannerList(array("banner_id"));
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

}
