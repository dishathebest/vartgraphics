<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('category_model', 'product_model'));
        $this->load->library('tank_auth');
        if (!$this->tank_auth->is_logged_in()) {
            redirect($this->config->item('base_url_admin') . 'auth/login/');
        }
    }

    public function index() {
        $data['content'] = "productlist_view";
        $data['title'] = "Product List :: V.Art Graphics";
        $data['head_page'] = "Product List";
        $data['productList'] = $this->product_model->getProductList(array("pro_id", "pro_name", "active"));
        if ($this->session->userdata("deleted")) {
            $data['msg'] = "Product has been deleted successfully.";
            $data['msg_type'] = "danger";
        } else if ($this->session->userdata("edited")) {
            $data['msg'] = "Product has been edited successfully.";
            $data['msg_type'] = "success";
        } else if ($this->session->userdata("added")) {
            $data['msg'] = "Product has been added successfully.";
            $data['msg_type'] = "success";
        }
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
        $this->session->unset_userdata("deleted");
        $this->session->unset_userdata("edited");
        $this->session->unset_userdata("added");
    }

    public function add() {
        $data['content'] = "products_view";
        $data['title'] = "Product Add :: V.Art Graphics";
        $data['head_page'] = "Product Add";
        $data['parentCategoryList'] = $this->category_model->getParentCategoryList(array("cat_id", "cat_name"));
        $data['mode'] = "add";
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function edit($pro_id = "0") {
        if ($pro_id == "0") {
            redirect($this->config->item('base_url_admin') . "products");
        }
        $data['content'] = "products_view";
        $data['title'] = "Product Edit :: V.Art Graphics";
        $data['head_page'] = "Product Edit";
        $data['productDetail'] = $this->product_model->getProductList(array("pro_id", "cat_ids", "pro_name", "short_description", "long_description", "active"), $pro_id);
        $cat_ids_arr = explode(",", $data['productDetail']->cat_ids);
        $data['parentCategoryList'] = $this->category_model->getParentCategoryList(array("cat_id", "cat_name"));
        foreach ($data['parentCategoryList'] as $index => $cat) {
            if (in_array($cat->cat_id, $cat_ids_arr)) {
                $data['parentCategoryList'][$index]->subcategory = $this->category_model->getChildCategoryByCatId($cat->cat_id, array("cat_id", "cat_name"));
            }
        }
        //print_r($cat_ids_arr);die;
        $data['cat_ids_arr'] = $cat_ids_arr;
        $data['mode'] = "edit";
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function getSubcategory() {
        $response = array();
        $response['content'] = '';
        $cat_id = $this->input->post("cat_id");
        $result = $this->category_model->getChildCategoryByCatId($cat_id, array("cat_id", "cat_name"));
        if (count($result) > 0) {
            $data['catList'] = $result;
            $data['cat_level'] = $this->input->post("cat_level");
            $data['parent_cat_id'] = $cat_id;
            $response['content'] = $this->load->view($this->config->item('admin_folder') . 'get_subcategory_view', $data, TRUE);
        }
        echo json_encode($response);
    }

    public function save() {
        //print_r($this->input->post());die;
        $mode = $this->input->post("mode");
        $fields = array(
            "pro_name" => $this->input->post("pro_name"),
            "short_description" => $this->input->post('short_description'),
            "long_description" => $this->input->post("long_description"),
            "cat_ids" => implode(",", $this->input->post("category")),
            "active" => $this->input->post("active")
        );

        if ($mode == "add") {
            $fields['admin_id'] = $this->tank_auth->get_user_id();
            $fields['created_at'] = date("Y-m-d h:i:s");
            if ($this->product_model->insertProduct($fields)) {
                $this->session->set_userdata("added", "true");
                redirect($this->config->item('base_url_admin') . "products");
            }
        } else if ($mode == "edit") {
            if ($this->product_model->updateProduct($fields, $this->input->post("pro_id"))) {
                $this->session->set_userdata("edited", "true");
                redirect($this->config->item('base_url_admin') . "products");
            }
        }
    }

    public function delete($del_id = "0") {
        if ($del_id == "0") {
            redirect($this->config->item('base_url_admin') . "products");
        }
        $this->session->set_userdata("deleted", "true");
        $this->product_model->deleteProductById($del_id);
        redirect($this->config->item('base_url_admin') . "products");
    }

    public function active() {
        $response = array();
        $pro_id = $this->input->post("entity_id");
        $active = !$this->input->post("active");
        $response['isError'] = false;
        $response['status'] = $active;
        $this->product_model->updateProduct(array("active" => "$active"), $pro_id);
        echo json_encode($response);
    }

    public function images() {
        $data['content'] = "product_imagelist_view";
        $data['title'] = "Product Image List :: V.Art Graphics";
        $data['head_page'] = "Product Image List";
        $data['productList'] = $this->product_model->getProductListWithImageCount(array("pro.pro_id", "pro.pro_name", "pro.active", "COUNT(img.pro_id) as total"));
        if ($this->session->userdata("deleted")) {
            $data['msg'] = "Product images have been deleted successfully.";
            $data['msg_type'] = "danger";
        } else if ($this->session->userdata("edited")) {
            $data['msg'] = "Product images have been edited successfully.";
            $data['msg_type'] = "success";
        } else if ($this->session->userdata("added")) {
            $data['msg'] = "Product images have been added successfully.";
            $data['msg_type'] = "success";
        } else if ($this->session->userdata("image_err")) {
            $data['msg'] = $image_err_msg;
            $data['msg_type'] = "danger";
        }
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
        $this->session->unset_userdata("deleted");
        $this->session->unset_userdata("edited");
        $this->session->unset_userdata("added");
        $this->session->unset_userdata("image_err");
    }

    public function singleUpload($pro_id = "0") {
        if ($pro_id == "0") {
            redirect($this->config->item('base_url_admin') . "products/images");
        }
        $data['content'] = "product_singleupload_image_view";
        $data['title'] = "Product Image Upload :: V.Art Graphics";
        $data['head_page'] = "Product Image Upload";
        $data['mode'] = "add";
        $data['pro_id'] = $pro_id;
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function save_singleupload() {
        $filepath = $this->getProductImageUploadPath();
        $config = array(
            'upload_path' => $filepath . "/",
            'upload_url' => base_url() . "/uploads/product_image/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'max_size' => "204800",
            'max_width' => "1024",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("image")) {
            $fileupload_arr = $this->upload->data('file_name');
            $filename = $fileupload_arr['file_name'];
            $fields = array(
                "pro_id" => $this->input->post("pro_id"),
                "image" => $filename,
                "caption" => $this->input->post("caption"),
                "short_description" => $this->input->post("short_description"),
                "long_description" => $this->input->post("long_description"),
                "admin_id" => $this->tank_auth->get_user_id(),
                "created_at" => date("Y-m-d h:i:s")
            );
            $this->product_model->uploadImageProduct($fields);
            //$error = array('upload_data' => $this->upload->data());
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata("image_err", "true");
            $this->session->set_userdata("image_err_msg", $error);
        }
        redirect($this->config->item('base_url_admin') . "products/images");
    }

    public function multipleUpload($pro_id = "0") {
        if ($pro_id == "0") {
            redirect($this->config->item('base_url_admin') . "products/images");
        }
        $data['content'] = "product_multipleupload_image_view";
        $data['title'] = "Product Image Upload :: V.Art Graphics";
        $data['head_page'] = "Product Image Upload Bulk";
        $data['mode'] = "add";
        $data['pro_id'] = $pro_id;
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function save_multipleUpload() {
        $result = array();
        $pro_id = $_REQUEST['pro_id'];
        if ($pro_id == '') {
            exit;
        }
        $filepath = $this->getProductImageUploadPath();
        $config = array(
            'upload_path' => $filepath . "/",
            'upload_url' => base_url() . "/uploads/product_image/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'max_size' => "204800",
            'max_width' => "1024",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("file")) {
            $fileupload_arr = $this->upload->data('file_name');
            $filename = $fileupload_arr['file_name'];
            $fields = array(
                "pro_id" => $this->input->post("pro_id"),
                "image" => $filename,
                "admin_id" => $this->tank_auth->get_user_id(),
                "created_at" => date("Y-m-d h:i:s")
            );
            $this->product_model->uploadImageProduct($fields);
            //$error = array('upload_data' => $this->upload->data());
            $result['status'] = "Success!";
            $result['class'] = "text-success";
        } else {
            $error = array('error' => $this->upload->display_errors());
            $result['status'] = $error;
            $result['class'] = "text-danger";
        }
        $result['org_filename'] = $_FILES['file']['name'];
        echo json_encode($result);
        exit;
    }

    private function getProductImageUploadPath() {
        $filepath = $this->config->item("document_url") . "/uploads/pro_images";
        if (!is_dir($filepath)) {
            mkdir($filepath, 0777);
        }
        return $filepath;
    }

    public function deleteImage($pro_id = "0") {
        if ($pro_id == "0") {
            redirect($this->config->item('base_url_admin') . "products/images");
        }
        $this->session->set_userdata("deleted", "true");
        $this->product_model->deleteProductImageByProId($pro_id);
        redirect($this->config->item('base_url_admin') . "products/images");
    }

    public function imageview($pro_id = "0") {
        if ($pro_id == "0") {
            redirect($this->config->item('base_url_admin') . "products/images");
        }
        $data['content'] = "product_imageview_view";
        $data['title'] = "Product Image View :: V.Art Graphics";
        $data['head_page'] = "Product Image View";
        $data['productImageList'] = $this->product_model->getProductImagesByProId($pro_id);
        $data['pro_id'] = $pro_id;
        $data['filepath'] = base_url("uploads/pro_images") . "/";
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function saveSortOrder() {
        $image_ids = $this->input->post("img_ids");
        foreach ($image_ids as $index => $img_id) {
            $this->product_model->updateImageProduct(array("sort_order" => $index + 1), $img_id);
        }
        echo "success";
    }

    public function editImageProperties() {
        $result = array();
        $pro_img_id = $this->input->post("pro_img_id");
        if ($pro_img_id == "") {
            $result['content'] = "No Data Found!";
        } else {
            $data['productImageDetail'] = $this->product_model->getProductImageByImageId($pro_img_id);
            $result['content'] = $this->load->view($this->config->item('admin_folder') . 'display_productimage_data_view', $data, TRUE);
        }
        echo json_encode($result);
    }

    public function saveImageProperties() {
        $pro_img_id = $this->input->post("pro_img_id");
        $fields = array(
            "caption" => $this->input->post("caption"),
            "short_description" => $this->input->post("short_description"),
            "long_description" => $this->input->post("long_description")
        );
        $this->product_model->updateImageProduct($fields, $pro_img_id);
    }

    public function deleteImageById() {
        $img_id = $this->input->post('pro_img_id');
        $response = array();
        if ($img_id == "" || $img_id <= 0) {
            $response['status'] = "error";
        } else {
            $delete = "1";
            if ($this->input->post("delete") != '') {
                $delete = $this->input->post("delete");
            }
            $this->product_model->deleteProductImageByImageId($img_id, $delete);
            $response['status'] = "success";
            $response['delete'] = ($delete == "1" ? "0" : "1");
        }
        echo json_encode($response);
    }

}

?>