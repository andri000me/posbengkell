<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Donetask extends REST_Controller
{
   public function __construct() {
       parent::__construct();
       $this->load->model('Api_model');
       $this->load->helper(['jwt', 'authorization']); 
   }    
  
  public function index_post() {
    $id = $this->post('id');
    $type = $this->post('type');

    $table;
    if ($type == 'trx') {
      $table = 'tbl_transaksi_spare_part';
    }else{
      $table = 'tbl_uraian_pekerjaan';
    }

    $this->db->where('id', $id);
    
    
    $update = $this->db->update($table, ['status' => 1]);       
    $this->response([
        'status' => $update        
    ]); 
  }

  
}
