<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Logout extends REST_Controller
{
   public function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->helper(['jwt', 'authorization']); 
   }    
  
  function index_get(){        
    $user = null;
    $payload_token = $this->verify_request();  
    if ($payload_token != null) {
      $user = $this->db->get_where('view_data_pegawai', ['id' => $payload_token->id])->row();      
    }

    $this->db->where('id', $user->id); //add this one
    $status = $this->db->update('tbl_user', ['remember_token' => ""]);          

    $this->response([
      'status' => $status,
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