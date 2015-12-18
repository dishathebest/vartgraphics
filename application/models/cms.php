<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cms extends CI_Model {

    private $pages = 'cms_pages';

    function __construct() {
	parent::__construct();

	$ci = & get_instance();
    }

    function getPageList($fields = "*", $page_id = 0) {
	$this->db->select($fields);
	if ($page_id > 0) {
	    $this->db->where("page_id", $page_id);
	}
	$result = $this->db->get($this->pages);
	if ($page_id > 0) {
	    return $result->row();
	} else {
	    return $result->result();
	}
    }

    function insertPage($fields) {
	if ($this->db->insert($this->pages, $fields)) {
	    //echo $this->db->last_query();die;
	    return $proId = $this->db->insert_id();
	}
	return false;
    }

    function updatePage($fields, $page_id) {
	$this->db->where("page_id", $page_id);
	if ($this->db->update($this->pages, $fields)) {
	    return true;
	}
	return false;
    }

    function deletePageById($page_id) {
	$this->db->where("page_id", $page_id);
	if ($this->db->delete($this->pages)) {
	    return true;
	}
	return false;
    }

    function getPageById($page_id = 0, $fields = "*") {
	$this->db->select($fields);
	if ($page_id > 0) {
	    $this->db->where("page_id", $page_id);
	}
	$result = $this->db->get($this->pages);
	return $result->row();
    }

}
