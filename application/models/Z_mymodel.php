<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Z_mymodel extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

/*
  check quota of selected appointment
*/
  public function check_appointmentquota($appointmentid = '0') {
    $sql="select count(*) c from square_fault_appointment where id=$appointmentid and quota-quotaused>0";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $row = $query->row_array();
      return $row['c'];
    } else {
      return 0;
    }
  }
}
