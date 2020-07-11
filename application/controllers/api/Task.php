<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Task extends REST_Controller
{
   public function __construct() {
           parent::__construct();
           $this->load->model('Api_model');
           $this->load->helper(['jwt', 'authorization']); 
   }    
  
  function index_get() {
    $user   = $this->verify_request();
    $status = $this->get('status');
    $data   = $this->Api_model->task_get($user, $user->role_user, $status);       
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



   // public function user_get(){
   //     $r = $this->Api_model->user_get();
   //     $this->response($r); 
   // }

   // public function user_put(){
   //     $id = $this->uri->segment(3);

   //     $data = array('name' => $this->input->get('name'),
   //     'pass' => $this->input->get('pass'),
   //     'type' => $this->input->get('type')
   //     );

   //      $r = $this->user_model->update($id,$data);
   //         $this->response($r); 
   // }

   // public function user_post(){
   //     $data = array('name' => $this->input->post('name'),
   //     'pass' => $this->input->post('pass'),
   //     'type' => $this->input->post('type')
   //     );
   //     $r = $this->user_model->insert($data);
   //     $this->response($r); 
   // }
   // public function user_delete(){
   //     $id = $this->uri->segment(3);
   //     $r = $this->user_model->delete($id);
   //     $this->response($r); 
   // }
}