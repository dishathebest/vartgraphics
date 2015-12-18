<?php 
$this->load->view($this->config->item('admin_folder')."includes/header");
$this->load->view($this->config->item('admin_folder').$content);
$this->load->view($this->config->item('admin_folder')."includes/footer");