<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vart_home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('category_model', 'banner_model', 'testimonial_model'));
        $this->load->library('email');
    }

    public function index() {
        $data['content'] = "vart_home";
        $data['title'] = "V.Art Graphics";
        $data['introduction'] = $this->cms->getPageById(5);
        $data['passion'] = $this->cms->getPageById(6);
        $data['categoryList'] = $this->category_model->getParentCategoryList(array("cat_id", "cat_name", "cat_description", "image_home"));
        $data['bannerList'] = $this->banner_model->getBannerList(array("banner_id", "image"), 0, array("active" => "1"));
        $data['testimonialList'] = $this->testimonial_model->getTestimonialList(array("testi_id", "name", "company_name", "comment", "image"), 0, array("active" => "1"));
        $this->load->view('main_template', $data);
    }

    public function sendMail() {
        $response = "error";
        $name = $this->input->post("name");
        $company = $this->input->post("company");
        $email = $this->input->post("email");
        $message = $this->input->post("message");

        $this->email->from($this->config->item('site_email'), 'Your Name');
        $this->email->to($this->config->item('site_email'));
        $this->email->bcc('vaghela.disha88@gmail.com');

        $messageBody = <<<EOL
                <table border="0">
                <tr><td>Name</td><td>{$name}</td></tr>
                <tr><td>Company</td><td>{$company}</td></tr>
                <tr><td>Email</td><td>{$email}</td></tr>
                <tr><td>Message</td><td>{$message}</td></tr>
                </table>
EOL;
        $this->email->subject('Contact - vartgrahpcis.com');
        $this->email->message($messageBody);
        if ($this->email->send()) {
            $response = "success";
        }
        echo $response;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */