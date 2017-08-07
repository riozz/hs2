<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Z_staffinfo extends CI_Model {
  public function __construct() {
    parent::__construct();
    //$this->load->database();
    //$this->hktp_db=$this->CI->load->database('HKTP', TRUE);
    $this->hktp_db=$this->load->database('HKTP', TRUE);
  }

/*
  check quota of selected appointment
*/
  public function getStaffInfoById($staff_id) {
    $sql="select id,name,staffid,ccc,location,teamcode,channel,telno from staff where staffid=?";
    $results = $this->hktp_db->query($sql, array($staff_id));
    $staffMetadata = $results -> row();
    if (isset($staffMetadata)) {
      //$data['staff_id'] = $staffMetadata->id;
      $data['staff_name'] = $staffMetadata->name;
      $data['staff_ccc'] = $staffMetadata->ccc;
      $data['staff_location'] = $staffMetadata->location;
      $data['staff_id'] = $staffMetadata->staffid;
      $data['staff_teamcode'] = $staffMetadata->teamcode;
      $data['staff_channel'] = $staffMetadata->channel;
      $data['staff_telno'] = $staffMetadata->telno;
    } else {
      //$data['staff_id'] = 0;
      $data['staff_name'] = '';
      $data['staff_ccc'] = '';
      $data['staff_location'] = '';
      $data['staff_id'] = $staff_id;
      $data['staff_teamcode'] = '';
      $data['staff_channel'] = '';
      $data['staff_telno'] = '';
    }
    return $data;
  }
}
