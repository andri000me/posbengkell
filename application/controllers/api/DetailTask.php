<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class DetailTask extends REST_Controller
{
   public function __construct() {
       parent::__construct();
       $this->load->model('Api_model');
       $this->load->helper(['jwt', 'authorization']); 
   }    
  
  public function index_post() {
    $id_perintah_kerja = $this->post('id');
    $data = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja' => $id_perintah_kerja])->result_array();       
    $data_sparepart = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja' => $id_perintah_kerja])->result_array();       
    $this->response([
        'status' => TRUE,
        'data_pekerjaan' => $data,
        'data_sparepart' => $data_sparepart
    ]); 
  }


}
