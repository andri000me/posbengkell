<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
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

    $this->response([
      'status' => isset($user) ? true : false,
      'data' => $user
    ]); 
  }

  function index_post(){        
    $username = $this->post('username');
    $password = $this->post('password');
    
    if(!empty($username) && !empty($password)){
        $user = $this->Api_model->login($username);     
        if ($user != null && password_verify($password, $user->password)) {              
          $token_payload = ['time' => time(),
                            'id' => $user->id, 
                            'id_bengkel' => $user->id_bengkel, 
                            'username' => $user->username, 
                            'nama' => $user->nama, 
                            'role_user' => $user->role_user];
          
          $user->remember_token = AUTHORIZATION::generateToken($token_payload);

          $this->db->where('id', $user->id); //add this one
          $this->db->update('tbl_user', ['remember_token' => $user->remember_token]);          
          
          $this->response([
                'status' => TRUE,
                'message' => 'User login successful.',
                'data' => $user
            ], REST_Controller::HTTP_OK);

        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Wrong username or password.',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }else{
        $this->response([
            'status' => FALSE,
            'message' => 'Provide username and password.',
        ], REST_Controller::HTTP_BAD_REQUEST);
    }
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