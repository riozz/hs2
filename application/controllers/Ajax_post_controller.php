<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Ajax_Post_Controller extends CI_Controller {


    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->library('session');
    }

// Show view Page

public function index(){

$this->load->view("ajax_post_view");

}



// This function call from AJAX

public function user_data_submit() {

$data = array(

'username' => $this->input->post('name'),

'pwd'=>$this->input->post('pwd')

);



//Either you can print value or you can send value to database

echo json_encode($data);

}

}
