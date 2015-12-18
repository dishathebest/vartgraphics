<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->model('banner_model');
	$this->load->library('tank_auth');
	if (!$this->tank_auth->is_logged_in()) {
	    redirect($this->config->item('base_url_admin') . 'auth/login/');
	}
    }

    public function index() {
	$data['content'] = "bannerlist_view";
	$data['title'] = "Banner List :: V.Art Graphics";
	$data['head_page'] = "Banner List";
	$data['bannerList'] = $this->banner_model->getBannerList(array("banner_id", "name", "image", "active"));
	if ($this->session->userdata("deleted")) {
	    $data['msg'] = "Banner has been deleted successfully.";
	    $data['msg_type'] = "danger";
	} else if ($this->session->userdata("edited")) {
	    $data['msg'] = "Banner has been edited successfully.";
	    $data['msg_type'] = "success";
	} else if ($this->session->userdata("added")) {
	    $data['msg'] = "Banner has been added successfully.";
	    $data['msg_type'] = "success";
	}
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
	$this->session->unset_userdata("deleted");
	$this->session->unset_userdata("edited");
	$this->session->unset_userdata("added");
    }

    public function add() {
	$data['content'] = "banner_view";
	$data['title'] = "Banner Add :: V.Art Graphics";
	$data['head_page'] = "Banner Add";
	$data['mode'] = "add";
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function edit($banner_id = "0") {
	if ($banner_id == "0") {
	    redirect($this->config->item('base_url_admin') . "banner");
	}
	$data['content'] = "banner_view";
	$data['title'] = "Banner Edit :: V.Art Graphics";
	$data['head_page'] = "Banner Edit";
	$data['bannerDetail'] = $this->banner_model->getBannerList(array("banner_id", "name", "description", "image", "active"), $banner_id);
	$data['mode'] = "edit";
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function save() {
	$mode = $this->input->post("mode");
	$fields = array(
	    "name" => $this->input->post("name"),
	    "description" => $this->input->post('description'),
	    "active" => $this->input->post("active")
	);
	$file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	$filename = md5($file_name) . "." . $extension;

	$filepath = $this->bannerDir();
	$config = array(
	    'upload_path' => $filepath . "/",
	    'allowed_types' => "gif|jpg|png|jpeg",
	    /*'max_size' => "204800",
	    'max_width' => "1024",*/
	    'encrypt_name' => TRUE,
	    'file_name' => $filename
	);
	$this->load->library('upload', $config);
	if ($this->upload->do_upload("image")) {
	    $fileupload_arr = $this->upload->data('image');
	    $filename = $fileupload_arr['file_name'];
	    $fields["image"] = $filename;
	} else {
	    $error = array('error' => $this->upload->display_errors());
	    $this->session->set_userdata("image_err", "true");
	    $this->session->set_userdata("image_err_msg", $error);
	}


	if ($mode == "add") {
	    $fields['created_at'] = date("Y-m-d h:i:s");
	    if ($this->banner_model->insertBanner($fields)) {
		$this->session->set_userdata("added", "true");
		redirect($this->config->item('base_url_admin') . "banner");
	    }
	} else if ($mode == "edit") {
	    if ($this->banner_model->updateBanner($fields, $this->input->post("banner_id"))) {
		$this->session->set_userdata("edited", "true");
		redirect($this->config->item('base_url_admin') . "banner");
	    }
	}
    }

    public function bannerDir() {
	$bannerDir = $this->config->item('base_dir') . "images/home_banner";
	if (!is_dir($bannerDir)) {
	    mkdir($bannerDir, 0777);
	}
	return $bannerDir;
    }

    public function delete($del_id = "0") {
	if ($del_id == "0") {
	    redirect($this->config->item('base_url_admin') . "banner");
	}
	$this->session->set_userdata("deleted", "true");
	$this->banner_model->deleteBannerById($del_id);
	redirect($this->config->item('base_url_admin') . "banner");
    }

    public function active() {
	$response = array();
	$banner_id = $this->input->post("entity_id");
	$active = !$this->input->post("active");
	$response['isError'] = false;
	$response['status'] = $active;
	$this->banner_model->updateBanner(array("active" => "$active"), $banner_id);
	echo json_encode($response);
    }

}
