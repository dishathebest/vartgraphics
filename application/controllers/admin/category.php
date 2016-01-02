<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->library('tank_auth');
        if (!$this->tank_auth->is_logged_in()) {
            redirect($this->config->item('base_url_admin') . 'auth/login/');
        }
    }

    public function index() {
        $data['content'] = "categorylist_view";
        $data['title'] = "Category List :: V.Art Graphics";
        $data['head_page'] = "Category List";
        $data['categoryList'] = $this->category_model->getCategoryListAdvanced(array("cat1.cat_id", "cat1.cat_name", "cat1.active", "cat1.cat_parent_id", "cat2.cat_name as parent_cat_name"));
        if ($this->session->userdata("deleted")) {
            $data['msg'] = "Category has been deleted successfully.";
            $data['msg_type'] = "danger";
        } else if ($this->session->userdata("edited")) {
            $data['msg'] = "Category has been edited successfully.";
            $data['msg_type'] = "success";
        } else if ($this->session->userdata("added")) {
            $data['msg'] = "Category has been added successfully.";
            $data['msg_type'] = "success";
        }
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
        $this->session->unset_userdata("deleted");
        $this->session->unset_userdata("edited");
        $this->session->unset_userdata("added");
    }

    public function add() {
        $data['content'] = "category_view";
        $data['title'] = "Category Add :: V.Art Graphics";
        $data['head_page'] = "Category Add";
        $parentCatList = $this->category_model->getParentCategoryList(array("cat_id", "cat_name"));
        $parentCatArr = array("" => "Select");
        if (count($parentCatList) > 0) {
            foreach ($parentCatList as $item) {
                $parentCatArr[$item->cat_id] = $item->cat_name;
            }
        }
        $data['parentCategoryList'] = $parentCatArr;
        $data['mode'] = "add";
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function edit($cat_id = "0") {
        if ($cat_id == "0") {
            redirect($this->config->item('base_url_admin') . "category");
        }
        $data['content'] = "category_view";
        $data['title'] = "Category Edit :: V.Art Graphics";
        $data['head_page'] = "Category Edit";
        $data['categoryDetail'] = $this->category_model->getCategoryList(array("cat_id", "cat_name", "cat_description", "cat_parent_id", "active", "image_home", "image"), $cat_id);
        $parentCatList = $this->category_model->getParentCategoryList(array("cat_id", "cat_name"), $cat_id);
        $parentCatArr = array("" => "Select");
        if (count($parentCatList) > 0) {
            foreach ($parentCatList as $item) {
                $parentCatArr[$item->cat_id] = $item->cat_name;
            }
        }
        $data['parentCategoryList'] = $parentCatArr;
        $data['mode'] = "edit";
        $this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function save() {
        $mode = $this->input->post("mode");
        $fields = array(
            "cat_name" => $this->input->post("cat_name"),
            "cat_description" => $this->input->post('cat_description'),
            "cat_parent_id" => $this->input->post("cat_parent_id"),
            "active" => $this->input->post("active")
        );

        $filepath = $this->categoryDir();
        $config = array(
            'upload_path' => $filepath . "/",
            'allowed_types' => "gif|jpg|png|jpeg",
            /* 'max_size' => "204800",
              'max_width' => "1024", */
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);

        /* save home image */
        if ($_FILES['image_home']['name'] != '') {
            $file_name = pathinfo($_FILES['image_home']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['image_home']['name'], PATHINFO_EXTENSION);
            $filename = md5($file_name) . "." . $extension;

            $config['file_name'] = $filename;
            if ($this->upload->do_upload("image_home")) {
                $fileupload_arr = $this->upload->data('image_home');
                $filename = $fileupload_arr['file_name'];
                $fields["image_home"] = $filename;
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata("image_err", "true");
                $this->session->set_userdata("image_err_msg", $error);
            }
        }

        /* save image */
        if ($_FILES['image']['name'] != '') {
            $file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = md5($file_name) . "." . $extension;

            $config['file_name'] = $filename;
            if ($this->upload->do_upload("image")) {
                $fileupload_arr = $this->upload->data('image');
                $filename = $fileupload_arr['file_name'];
                $fields["image"] = $filename;
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata("image_err", "true");
                $this->session->set_userdata("image_err_msg", $error);
            }
        }

        if ($mode == "add") {
            $fields['created_at'] = date("Y-m-d h:i:s");
            if ($this->category_model->insertCategory($fields)) {
                $this->session->set_userdata("added", "true");
                redirect($this->config->item('base_url_admin') . "category");
            }
        } else if ($mode == "edit") {
            if ($this->category_model->updateCategory($fields, $this->input->post("cat_id"))) {
                $this->session->set_userdata("edited", "true");
                redirect($this->config->item('base_url_admin') . "category");
            }
        }
    }

    public function categoryDir() {
        $categoryDir = $this->config->item('base_dir') . "images/category";
        if (!is_dir($categoryDir)) {
            mkdir($categoryDir, 0777);
        }
        return $categoryDir;
    }

    public function delete($del_id = "0") {
        if ($del_id == "0") {
            redirect($this->config->item('base_url_admin') . "category");
        }
        $this->session->set_userdata("deleted", "true");
        $this->category_model->deleteCategoryById($del_id);
        redirect($this->config->item('base_url_admin') . "category");
    }

    public function active() {
        $response = array();
        $cat_id = $this->input->post("entity_id");
        $active = !$this->input->post("active");
        $response['isError'] = false;
        $response['status'] = $active;
        $this->category_model->updateCategory(array("active" => "$active"), $cat_id);
        echo json_encode($response);
    }

}
