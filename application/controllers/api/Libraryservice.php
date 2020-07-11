<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Libraryservice extends REST_Controller
{
    public function __construct() {
       parent::__construct();
       $this->load->model('Api_model');
       $this->load->helper(['jwt', 'authorization']); 
    }    

    public function index_get(){
        $user           = $this->verify_request();  
        $id             = $this->get('id');
        $kode_service   = $this->get('kode_service');
        if (!empty($id)) {
          $data = $this->db->get_where('tbl_library_service',[
                                      'id_bengkel' => $user->id_bengkel,
                                      'id'         => $id])->row();
        }else{
          if (!empty($kode_service)) {
            $this->db->like('kode_service', $kode_service);
            $data = $this->db->get_where('tbl_library_service', [
                                          'id_bengkel'    => $user->id_bengkel])->result_array();
          }else{
            $data = $this->db->get_where('tbl_library_service', [
                                          'id_bengkel'    => $user->id_bengkel])->result_array();
          }          
          
        }   

        $this->response([
            'status' => TRUE,
            'data'   => $data        
        ]);   

    }
  
    public function index_post() {
        $user   = $this->verify_request();      
        $input_lib = array('kode_service'       => "SERVICE-".time(),
                            'id_bengkel'        => $user->id_bengkel,
                            'service'           => $this->post('service'),
                            'keterangan'        => $this->post('keterangan'),
                            'tipe_keuntungan'   => $this->post('tipe_keuntungan'),
                            'nilai_keuntungan'  => $this->post('nilai_keuntungan'),
                            'biaya'             => $this->post('biaya'));

        $insert = $this->db->insert('tbl_library_service', $input_lib);       
        
        $this->response([
            'status' => $insert        
        ]); 
    }

    public function index_put() {
        $user   = $this->verify_request();      
        
        $input_lib = array('service'            => $this->put('service'),
                            'keterangan'        => $this->put('keterangan'),
                            'tipe_keuntungan'   => $this->put('tipe_keuntungan'),
                            'nilai_keuntungan'  => $this->put('nilai_keuntungan'),
                            'biaya'             => $this->put('biaya'));

        $this->db->where('id', $this->put('id'));
        $insert = $this->db->update('tbl_library_service', $input_lib);       
        
        $this->response([
            'status' => $insert        
        ]); 
    }

    function index_delete(){
        $id = $this->delete('id');;
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_library_service');
        
        $this->response([
          'status' => $delete
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
