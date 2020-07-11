<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class TokenFirebase extends REST_Controller
{
   public function __construct() {
       parent::__construct();
       $this->load->model('Api_model');
   }    
  
  public function index_post() {
    $id_user        = $this->post('id');
    $firebase_token = $this->post('firebase_token');
    
    $this->db->where('id', $id_user);
    $update = $this->db->update('tbl_user', ['firebase_token' => $firebase_token]);           
    
    $this->response([
        'status' => $update        
    ]); 
  }
}
