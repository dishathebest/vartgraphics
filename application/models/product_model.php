<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class product_model extends CI_Model {

    private $category = 'category_tbl';
    private $products = 'products';
    private $product_images = 'product_images';

    function __construct() {
        parent::__construct();

        $ci = & get_instance();
    }

    function getProductList($fields = "*", $proId = 0) {
        $this->db->select($fields);
        if ($proId > 0) {
            $this->db->where("pro_id", $proId);
        }
        $result = $this->db->get($this->products);
        if ($proId > 0) {
            return $result->row();
        } else {
            return $result->result();
        }
    }

    function getProductListAdvanced($fields = "*") {
        $this->db->select($fields)->from($this->products);
        $this->db->join($this->category, "category_tbl.cat_id=products.cat_id", "LEFT");
        $result = $this->db->get();
        return $result->result();
    }

    function insertProduct($fields) {
        if ($this->db->insert($this->products, $fields)) {
            //echo $this->db->last_query();die;
            return $proId = $this->db->insert_id();
        }
        return false;
    }

    function updateProduct($fields, $pro_id) {
        $this->db->where("pro_id", $pro_id);
        if ($this->db->update($this->products, $fields)) {
            return true;
        }
        return false;
    }

    function deleteProductById($pro_id) {
        $this->db->where("pro_id", $pro_id);
        if ($this->db->delete($this->products)) {
            return true;
        }
        return false;
    }

    function getProductListWithImageCount($fields = "*", $proId = 0) {
        $this->db->select($fields)->from("$this->products as pro");
        $this->db->join("$this->product_images as img", "pro.pro_id=img.pro_id AND img.is_deleted='0'", "LEFT");
        if ($proId > 0) {
            $this->db->where("pro.pro_id", $proId);
        }
        $this->db->group_by("pro.pro_id");
        $result = $this->db->get();
        /* echo $this->db->last_query();
          die; */
        if ($proId > 0) {
            return $result->row();
        } else {
            return $result->result();
        }
    }

    function uploadImageProduct($fields) {
        if ($this->db->insert($this->product_images, $fields)) {
            //echo $this->db->last_query();die;
            return $this->db->insert_id();
        }
        return false;
    }

    function deleteProductImageByProId($pro_id) {
        $this->db->where("pro_id", $pro_id);
        if ($this->db->update($this->product_images, array("is_deleted" => "1"))) {
            return true;
        }
        return false;
    }

    function getProductImagesByProId($pro_id) {
        $this->db->where("pro_id", $pro_id);
        $this->db->order_by("sort_order", "ASC");
        $result = $this->db->get($this->product_images);
        return $result->result();
    }

    function updateImageProduct($fields, $img_id) {
        $this->db->where("pro_img_id", $img_id);
        if ($this->db->update($this->product_images, $fields)) {
            return true;
        }
        return false;
    }

    function getProductImageByImageId($pro_img_id) {
        $this->db->where("pro_img_id", $pro_img_id);
        $this->db->order_by("sort_order", "ASC");
        $result = $this->db->get($this->product_images);
        return $result->row();
    }

    function deleteProductImageByImageId($pro_img_id, $delete = "1") {
        $this->db->where("pro_img_id", $pro_img_id);
        if ($this->db->update($this->product_images, array("is_deleted" => $delete))) {
            return true;
        }
        return false;
    }

    function getProductImagesByCatId($cat_id) {
        $query = 'SELECT `cat`.`cat_id`, `cat`.`cat_name`, `pro`.`pro_id`,pro.pro_name,proimg.image,proimg.caption,proimg.short_description,proimg.long_description FROM category_tbl as cat, `products` as pro,`product_images` as proimg WHERE proimg.pro_id=pro.pro_id AND `cat`.`cat_id` = ' . $cat_id . ' AND FIND_IN_SET(`cat`.`cat_id`,pro.cat_ids)>0';
        $result = $this->db->query($query);
        //echo $this->db->last_query();
        return $result->result();
    }

    function getProductListByCategories() {
        $query = "SELECT cat_id, pro_id, pro_name FROM (`products` as pro) LEFT OUTER JOIN `category_tbl` as cat ON FIND_IN_SET(`cat`.`cat_id`,pro.cat_ids)>0 WHERE `pro`.`active` = '1'";
        $result = $this->db->query($query);
        $select = array();
        foreach ($result->result() as $item) {
            $select[$item->cat_id][] = $item;
        }
        return $select;
    }

}
