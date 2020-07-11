<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Report extends REST_Controller
{
  public function __construct() {
    parent::__construct();
    $this->load->model('Api_model');
    $this->load->helper(['jwt', 'authorization']); 
  }    
  
  function index_get() {
    $this->response([
        'status' => TRUE
    ]);     
  }

  function index_post(){    
    $type = $this->post('type');    
    $user = $this->verify_request();

    $date_arr = explode(",", $this->post('tanggal'));    

    $report_date_start  = "";
    $report_date_end    = "";
    if (count($date_arr) > 1) {
      foreach ($date_arr as $key => $value) {
        if ($key == 0) {
          $report_date_start = $value;
        }else if ($key == count($date_arr)-1) {
          $report_date_end = $value;
        }
      }      
    }else{
      $report_date_start = $this->post('tanggal');
    }
    
    if ($type == "profitabilitas") {
      if (count($date_arr) > 1) {
        $this->db->where('DATE(tgl_transaksi) >=', date('Y-m-d',strtotime($report_date_start)));
        $this->db->where('DATE(tgl_transaksi) <=', date('Y-m-d',strtotime($report_date_end)));        
      }else{
        $this->db->where('DATE(tgl_transaksi) =', date('Y-m-d',strtotime($report_date_start)));        
      }
      $perintah_kerja = $this->db->get_where('view_perintah_kerja', ['id_bengkel' => $user->id_bengkel, 'status' => 3])->result_array();

      $total_all_laba = 0;
      $data = [];

      foreach ($perintah_kerja as $key => $value) {
        $this->db->select('harga_jual');
        $this->db->select('harga_beli');
        $this->db->select('harga_jual - harga_beli as laba', FALSE);      
        $data_laba_sparepart  = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja' => $value['id'] ])->result_array();
        $data_uraian_pekerjaan  = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja' => $value['id'] ])->result_array();
      
        $count_laba =0;   
        $count_cost =0;   
        $count_omzet =0;    
        $count_biaya_pekerjaan =0;    
      
        foreach ($data_laba_sparepart as $key2 => $value2) {
          $count_laba += $value2['laba'];
          $count_cost += $value2['harga_beli'];
          $count_omzet += $value2['harga_jual'];            
        }

        foreach ($data_uraian_pekerjaan as $key2 => $value2) {
          $count_biaya_pekerjaan += $value2['biaya'];           
        }

        $perintah_kerja[$key]['laba']           = "Rp.". number_format( floatval($count_laba), 0, ".", ".");
        $perintah_kerja[$key]['cost']           = "Rp.". number_format( floatval($count_cost), 0, ".", ".");
        $perintah_kerja[$key]['omzet']          = "Rp.". number_format( floatval($count_omzet), 0, ".", ".");
        $perintah_kerja[$key]['biaya_pekerjaan']= "Rp.". number_format( floatval($count_biaya_pekerjaan), 0, ".", ".");          
        $perintah_kerja[$key]['total_laba']     = "Rp.". number_format( floatval($count_biaya_pekerjaan + $count_laba), 0, ".", ".");           
        $perintah_kerja[$key]['detil']          = $data_laba_sparepart;
      
        $data = $perintah_kerja;

        $total_all_laba += floatval($count_biaya_pekerjaan + $count_laba);
      }        
    }    

    $this->response([
        'status'  => TRUE,
        'data'    => $data,
        'total'   => "Rp.". number_format(floatval($total_all_laba), 0, ".", ".")           
    ]); 
  }

  private function verify_request()
  {
      // Get all the headers
      $headers = $this->input->request_headers();

      // Extract the token
      $token = $headers['Authorization'];

      // Use try-catch
      // JWT library throws exception if the token is not valid
      try {
          // Validate the token
          // Successfull validation will return the decoded user data else returns false
          $data = AUTHORIZATION::validateToken($token);
          if ($data === false) {
              $status = parent::HTTP_UNAUTHORIZED;
              $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
              $this->response($response, $status);

              exit();
          } else {
              return $data;
          }
      } catch (Exception $e) {
          // Token is invalid
          // Send the unathorized access message
          $status = parent::HTTP_UNAUTHORIZED;
          $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
          $this->response($response, $status);
      }
  }
}