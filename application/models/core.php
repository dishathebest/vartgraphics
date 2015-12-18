<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class core extends CI_Model {

    public function getFieldNameById($fieldname, $tablename, $condition) {
	$this->db->select($fieldname);
	$this->db->where($condition);
	$result = $this->db->get($tablename);
	return $result->row();
    }

}
