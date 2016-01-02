<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('category_model', 'product_model'));
        $this->load->library('email');
    }

    function index($cat_name = '') {
        $data['content'] = "gallery_view";
        $data['productList'] = array();

        if ($cat_name == '') {
            redirect(base_url());
        }
        $cat_name = str_replace("_", " ", $cat_name);
        $category = $this->category_model->getCategoryIdByName($cat_name);
        if (count($category) == 0) {
            redirect(base_url());
        }
        $cat_id = $category->cat_id;
        $data['currentCat'] = $this->category_model->getCategoryList(array("cat_id", "cat_name", "cat_description", "image"), $cat_id);
        $data['productImageList'] = $this->product_model->getProductImagesByCatId($cat_id);
        $data['categoryList'] = $this->category_model->getParentCategoryList(array("cat_id", "cat_name", "cat_description", "image"), 0, array("active" => "1"));
        $data['productList'] = $this->product_model->getProductListByCategories();
        $data['cat_id'] = $cat_id;
        $data['title'] = "V.Art Graphics : Category";
        $this->load->view('main_template', $data);
    }

    function getProductsByCat() {
        $cat_id = $this->input->post("cat_id");
        $data['productImageList'] = $this->product_model->getProductImagesByCatId($cat_id);
        $result['content'] = $this->load->view('productlist_view', $data, true);
        echo json_encode($result);
    }

}
