<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->model('testimonial_model');
	$this->load->library('tank_auth');
	if (!$this->tank_auth->is_logged_in()) {
	    redirect($this->config->item('base_url_admin') . 'auth/login/');
	}
    }

    public function index() {
	$data['content'] = "testimoniallist_view";
	$data['title'] = "Testimonial List :: V.Art Graphics";
	$data['head_page'] = "Testimonial List";
	$data['testimonialList'] = $this->testimonial_model->getTestimonialList(array("testi_id", "name", "company_name", "image", "active"));
	if ($this->session->userdata("deleted")) {
	    $data['msg'] = "Testimonial has been deleted successfully.";
	    $data['msg_type'] = "danger";
	} else if ($this->session->userdata("edited")) {
	    $data['msg'] = "Testimonial has been edited successfully.";
	    $data['msg_type'] = "success";
	} else if ($this->session->userdata("added")) {
	    $data['msg'] = "Testimonial has been added successfully.";
	    $data['msg_type'] = "success";
	}
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
	$this->session->unset_userdata("deleted");
	$this->session->unset_userdata("edited");
	$this->session->unset_userdata("added");
    }

    public function add() {
	$data['content'] = "testimonial_view";
	$data['title'] = "Testimonial Add :: V.Art Graphics";
	$data['head_page'] = "Testimonial Add";
	$data['mode'] = "add";
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function edit($testi_id = "0") {
	if ($testi_id == "0") {
	    redirect($this->config->item('base_url_admin') . "testimonial");
	}
	$data['content'] = "testimonial_view";
	$data['title'] = "Testimonial Edit :: V.Art Graphics";
	$data['head_page'] = "Testimonial Edit";
	$data['testimonialDetail'] = $this->testimonial_model->getTestimonialList(array("testi_id", "name", "company_name", "comment", "image", "active"), $testi_id);
	$data['mode'] = "edit";
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function save() {
	$mode = $this->input->post("mode");
	$fields = array(
	    "name" => $this->input->post("name"),
	    "company_name" => $this->input->post("company_name"),
	    "comment" => $this->input->post('comment'),
	    "active" => $this->input->post("active")
	);
	$file_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	$filename = md5($file_name) . "." . $extension;

	$filepath = $this->testimonialDir();
	$config = array(
	    'upload_path' => $filepath . "/",
	    'allowed_types' => "gif|jpg|png|jpeg",
	    'max_size' => "204800",
	    'max_width' => "1024",
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
	    if ($this->testimonial_model->insertTestimonial($fields)) {
		$this->session->set_userdata("added", "true");
		redirect($this->config->item('base_url_admin') . "testimonial");
	    }
	} else if ($mode == "edit") {
	    if ($this->testimonial_model->updateTestimonial($fields, $this->input->post("testi_id"))) {
		$this->session->set_userdata("edited", "true");
		redirect($this->config->item('base_url_admin') . "testimonial");
	    }
	}
    }

    public function testimonialDir() {
	$testimonialDir = $this->config->item('base_dir') . "images/testimonial";
	if (!is_dir($testimonialDir)) {
	    mkdir($testimonialDir, 0777);
	}
	return $testimonialDir;
    }

    public function delete($del_id = "0") {
	if ($del_id == "0") {
	    redirect($this->config->item('base_url_admin') . "testimonial");
	}
	$this->session->set_userdata("deleted", "true");
	$this->testimonial_model->deleteTestimonialById($del_id);
	redirect($this->config->item('base_url_admin') . "testimonial");
    }

    public function active() {
	$response = array();
	$testimonial_id = $this->input->post("entity_id");
	$active = !$this->input->post("active");
	$response['isError'] = false;
	$response['status'] = $active;
	$this->testimonial_model->updateTestimonial(array("active" => "$active"), $testimonial_id);
	echo json_encode($response);
    }

}
