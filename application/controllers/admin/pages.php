<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->model(array('cms'));
	$this->load->library('tank_auth');
	$this->load->library('ckeditor');

	if (!$this->tank_auth->is_logged_in()) {
	    redirect($this->config->item('base_url_admin') . 'auth/login/');
	}
    }

    public function index() {
	$data['content'] = "pagelist_view";
	$data['title'] = "Page List :: V.Art Graphics";
	$data['head_page'] = "Page List";
	$data['pageList'] = $this->cms->getPageList(array("page_id", "page_name", "active"));
	if ($this->session->userdata("deleted")) {
	    $data['msg'] = "Page has been deleted successfully.";
	    $data['msg_type'] = "danger";
	} else if ($this->session->userdata("edited")) {
	    $data['msg'] = "Page has been edited successfully.";
	    $data['msg_type'] = "success";
	} else if ($this->session->userdata("added")) {
	    $data['msg'] = "Page has been added successfully.";
	    $data['msg_type'] = "success";
	}
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
	$this->session->unset_userdata("deleted");
	$this->session->unset_userdata("edited");
	$this->session->unset_userdata("added");
    }

    public function add() {
	$data['content'] = "page_view";
	$data['title'] = "Page Add :: V.Art Graphics";
	$data['head_page'] = "Page Add";
	$data['mode'] = "add";

	$this->ckeditor->basePath = base_url() . 'asset/ckeditor/';
	/* $this->ckeditor->config['toolbar'] = array(
	  array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
	  ); */
	$this->ckeditor->config['language'] = 'en';
	$this->ckeditor->config['width'] = '730px';
	$this->ckeditor->config['height'] = '300px';
	//echo $this->ckeditor->editor("textarea name","default textarea value");die;
	//$data['ckeditor']=$this->ckeditor;
	//print_r($this->ckeditor);die;
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function save() {
	$mode = $this->input->post("mode");
	$fields = array(
	    "page_name" => $this->input->post("page_name"),
	    "page_title" => $this->input->post('page_title'),
	    "page_url" => $this->input->post("page_url"),
	    "content" => $this->input->post("content"),
	    "meta_keyword" => $this->input->post("meta_keyword"),
	    "meta_description" => $this->input->post("meta_description"),
	    'updated_at' => date("Y-m-d h:i:s"),
	    "active" => $this->input->post("active")
	);

	if ($mode == "add") {
	    $fields['created_at'] = date("Y-m-d h:i:s");
	    if ($this->cms->insertPage($fields)) {
		$this->session->set_userdata("added", "true");
		redirect($this->config->item('base_url_admin') . "pages");
	    }
	} else if ($mode == "edit") {
	    if ($this->cms->updatePage($fields, $this->input->post("page_id"))) {
		$this->session->set_userdata("edited", "true");
		redirect($this->config->item('base_url_admin') . "pages");
	    }
	}
    }

    public function edit($page_id = "0") {
	if ($page_id == "0") {
	    redirect($this->config->item('base_url_admin') . "pages");
	}
	$data['content'] = "page_view";
	$data['title'] = "Page Edit :: V.Art Graphics";
	$data['head_page'] = "Page Edit";
	$data['pageDetail'] = $this->cms->getPageList(array("page_id", "page_name", "page_title", "content", "page_url", "meta_keyword", "meta_description", "active"), $page_id);
	$data['mode'] = "edit";
	$this->ckeditor->basePath = base_url() . 'asset/ckeditor/';
	/* $this->ckeditor->config['toolbar'] = array(
	  array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList')
	  ); */
	$this->ckeditor->config['language'] = 'en';
	$this->ckeditor->config['width'] = '730px';
	$this->ckeditor->config['height'] = '300px';
	//echo $this->ckeditor->editor("textarea name","default textarea value");die;
	//$data['ckeditor']=$this->ckeditor;
	//print_r($this->ckeditor);die;
	$this->load->view($this->config->item('admin_folder') . 'main_template', $data);
    }

    public function delete($del_id = "0") {
	if ($del_id == "0") {
	    redirect($this->config->item('base_url_admin') . "pages");
	}
	$this->session->set_userdata("deleted", "true");
	$this->cms->deletePageById($del_id);
	redirect($this->config->item('base_url_admin') . "pages");
    }

    public function active() {
	$response = array();
	$page_id = $this->input->post("entity_id");
	$active = !$this->input->post("active");
	$response['isError'] = false;
	$response['status'] = $active;
	$this->cms->updatePage(array("active" => "$active"), $page_id);
	echo json_encode($response);
    }

}
