<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Manager extends REST_Controller
{
   public function __construct() {
           parent::__construct();
           $this->load->model('Api_model');
           $this->load->helper(['jwt', 'authorization']); 
   }    
  
  function index_get() {
    $user = $this->verify_request();
    $this->db->distinct('email_pemilik');
    $total_customer = $this->db->get_where('tbl_penerimaan', [
                                            'email_pemilik !=' => "",
                                            'id_bengkel' => $user->id_bengkel])->num_rows();            

    $order_booking = $this->db->get_where('tbl_penerimaan', [
                                          'status ' => 0,
                                          'id_bengkel' => $user->id_bengkel])->num_rows();                        

    $order_service = $this->db->get_where('tbl_penerimaan', [
                                          'status ' => 1,
                                          'id_bengkel' => $user->id_bengkel])->num_rows();                        

    $in_order = $this->db->get_where('tbl_penerimaan', [
                                      'status !=' => 3,
                                      'id_bengkel' => $user->id_bengkel])->num_rows();                        

    $done_order = $this->db->get_where('tbl_penerimaan', [
                                        'status =' => 3,
                                        'id_bengkel' => $user->id_bengkel])->num_rows();                        

    $employee = $this->db->get_where('view_data_pegawai', [
                                      'role_user !=' => "Manager",
                                      'id_bengkel' => $user->id_bengkel])->num_rows();                        

    $library_service = $this->db->get_where('tbl_library_service', [
                                            'id_bengkel' => $user->id_bengkel])->num_rows();                        

    $obj = new stdClass();
    $obj->title = "Total Customer";
    $obj->value = $total_customer;
    $data[] = $obj;

    $obj = new stdClass();
    $obj->title = "Jumlah Order Booking";
    $obj->value = $order_booking;
    $data[] = $obj;

    $obj = new stdClass();
    $obj->title = "Jumlah Order Service";
    $obj->value = $order_service;
    $data[] = $obj;

    $obj = new stdClass();
    $obj->title = "Jumlah Order Belum Selesai";
    $obj->value = $in_order;
    $data[] = $obj;

    $obj = new stdClass();
    $obj->title = "Jumlah Order Sudah Selesai";
    $obj->value = $done_order;
    $data[] = $obj;

    $obj = new stdClass();
    $obj->title = "Jumlah Pegawai";
    $obj->value = $employee;
    $data[] = $obj;

    $obj = new stdClass();
    $obj->title = "Library Service";
    $obj->value = $library_service;
    $data[] = $obj;

    $this->response([
        'status' => TRUE,
        'data' => $data
    ]); 
  }

  function index_post(){    
    $post = json_decode(file_get_contents('php://input'), true);    
    $data = $this->Api_model->find_dokter($post['nama_dokter']);       
      
    $this->response([
      'status' => TRUE,
      'data' => $data
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