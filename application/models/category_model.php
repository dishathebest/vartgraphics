<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class category_model extends CI_Model {

    private $category = 'category_tbl';

    function __construct() {
	parent::__construct();

	$ci = & get_instance();
    }

    function getCategoryList($fields = "*", $catId = 0) {
	$this->db->select($fields);
	if ($catId > 0) {
	    $this->db->where("cat_id", $catId);
	}
	$result = $this->db->get($this->category);
	if ($catId > 0) {
	    return $result->row();
	} else {
	    return $result->result();
	}
    }

    function getCategoryListAdvanced($fields = "*") {
	$this->db->select($fields)->from("$this->category as cat1");
	$this->db->join("$this->category as cat2", "cat2.cat_id=cat1.cat_parent_id", "LEFT");
	$result = $this->db->get();
	return $result->result();
    }

    function getParentCategoryList($fields = "*", $catid = 0) {
	$this->db->select($fields);
	$this->db->where("cat_parent_id =", "0");
	if ($catid > 0) {
	    $this->db->where("cat_id !=", $catid);
	}
	$result = $this->db->get($this->category);
	return $result->result();
    }

    function insertCategory($fields) {
	if ($this->db->insert($this->category, $fields)) {
	    //echo $this->db->last_query();die;
	    return $catId = $this->db->insert_id();
	}
	return false;
    }

    function updateCategory($fields, $cat_id) {
	$this->db->where("cat_id", $cat_id);
	if ($this->db->update($this->category, $fields)) {
	    return true;
	}
	return false;
    }

    function deleteCategoryById($cat_id) {
	$this->db->where("cat_id", $cat_id);
	if ($this->db->delete($this->category)) {
	    return true;
	}
	return false;
    }
    
    function getChildCategoryByCatId($cat_id,$fields="*"){
	$this->db->select($fields);
	$this->db->where("cat_parent_id", $cat_id);
	$result = $this->db->get($this->category);
	return $result->result();
    }

}
