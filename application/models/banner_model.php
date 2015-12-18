<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class banner_model extends CI_Model {

    private $banner = 'banner';

    function __construct() {
	parent::__construct();

	$ci = & get_instance();
    }

    function getBannerList($fields = "*", $banner_id = 0,$where=array()) {
	$this->db->select($fields);
	if ($banner_id > 0) {
	    $this->db->where("banner_id", $banner_id);
	}
	if(count($where)>0){
		$this->db->where($where);
	}
	$result = $this->db->get($this->banner);
	if ($banner_id > 0) {
	    return $result->row();
	} else {
	    return $result->result();
	}
    }

    function insertBanner($fields) {
	if ($this->db->insert($this->banner, $fields)) {
	    //echo $this->db->last_query();die;
	    return $catId = $this->db->insert_id();
	}
	return false;
    }

    function updateBanner($fields, $banner_id) {
	$this->db->where("banner_id", $banner_id);
	if ($this->db->update($this->banner, $fields)) {
	    return true;
	}
	return false;
    }

    function deleteBannerById($banner_id) {
	$this->db->where("banner_id", $banner_id);
	if ($this->db->delete($this->banner)) {
	    return true;
	}
	return false;
    }
}