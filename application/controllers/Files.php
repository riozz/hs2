<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Files management class created by CodexWorld
 */
class Files extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('file');
    }
    
    public function index(){
        $data = array();
        //get files from database
        $data['files'] = $this->file->getRows();
        //load the view
        $this->load->view('files/index', $data);
    }
    
    public function download($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');
            //get file info from database
            $fileInfo = $this->file->getRows(array('id' => $id));
            //file path
            $file = 'uploads/files/'.$fileInfo['file_name'];
            
            //download file from directory
            force_download($file, NULL);
        }
    }
}
