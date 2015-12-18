<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class testimonial_model extends CI_Model {

    private $testimonial = 'testimonial';

    function __construct() {
        parent::__construct();

        $ci = & get_instance();
    }

    function getTestimonialList($fields = "*", $testi_id = 0, $where = array()) {
        $this->db->select($fields);
        if ($testi_id > 0) {
            $this->db->where("testi_id", $testi_id);
        }
        if (count($where) > 0) {
            $this->db->where($where);
        }
        $result = $this->db->get($this->testimonial);
        if ($testi_id > 0) {
            return $result->row();
        } else {
            return $result->result();
        }
    }

    function insertTestimonial($fields) {
        if ($this->db->insert($this->testimonial, $fields)) {
            //echo $this->db->last_query();die;
            return $catId = $this->db->insert_id();
        }
        return false;
    }

    function updateTestimonial($fields, $testi_id) {
        $this->db->where("testi_id", $testi_id);
        if ($this->db->update($this->testimonial, $fields)) {
            return true;
        }
        return false;
    }

    function deleteTestimonialById($testi_id) {
        $this->db->where("testi_id", $testi_id);
        if ($this->db->delete($this->testimonial)) {
            return true;
        }
        return false;
    }

}
