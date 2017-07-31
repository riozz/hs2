<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Z_staffinfo extends CI_Model {
  public function __construct() {
    parent::__construct();
    //$this->load->database();
    $this->hktp_db=$this->CI->load->database('HKTP', TRUE);
  }

/*
  check quota of selected appointment
*/
  public function getStaffInfoById($staff_id) {
    $sql="select id,name,staffid,ccc,location,teamcode,channel,telno from staff where staffid=?";
    $results = $this->hktp_db->query($sql, array($staffid));
    $staffMetadata = $results -> row();
    $data['id'] = $staffMetadata->id;
    $data['staff_name'] = $staffMetadata->name;
    $data['staff_ccc'] = $staffMetadata->ccc;
    $data['staff_location'] = $staffMetadata->location;
    $data['staff_id'] = $staffMetadata->staffid;
    $data['staff_teamcode'] = $staffMetadata->teamcode;
    $data['staff_channel'] = $staffMetadata->channel;
    $data['staff_telno'] = $telno;

  }
}
