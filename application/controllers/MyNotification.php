<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class MyNotification extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }
    
    public function index(){
        $authRole  = $this->session->userdata('roleuser');
        $dataUser  = $this->session->userdata('userdata')[0];

        $data['data_notif'] =  $this->db->get_where('tbl_notifikasi', ['id_user' => $dataUser->id, 'is_read' => 0])->result_array();
        $data['count_notif'] = count($data['data_notif']);
        echo json_encode($data);
    }    

    public function updateNotif($id){
    	$this->db->where('id', $id);
    	$data['status'] = $this->db->update('tbl_notifikasi', array('is_read' => 1));

    	echo json_encode($data);
    }
}