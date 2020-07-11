<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class KaTeknisi extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }

    public function loadNotify($id_user){    	
    	var_dump($id_user);
        // $data['notif'] =  $this->db->get_where('tbl_notifikasi', ['id_user' => $dataUser->id])->result_array();        
        // echo json_encode($data);
    }    
    
    public function index(){    	
        $dataUser = $this->session->userdata('userdata')[0];            	
        $authRole  = $this->session->userdata('roleuser');
        $idbengkel = $this->session->userdata('idbengkel');
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['subtitle_small'] = 'Ka Teknisi';
        $data['page'] = 'task_teknisi';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->db->where('id_bengkel', $idbengkel);                        
        $this->db->where('status', 1);                        
        $data['perintah_kerja'] = $this->db->get("view_perintah_kerja")->result_array();    
        $this->themes->Display('task-teknisi/task-teknisi', $data);                	
    }   

    public function View($id_perintah_kerja){    	

	    $data['data_uraian_pekerjaan'] 	= $this->db->get_where('tbl_uraian_pekerjaan', 
	    														['id_perintah_kerja' => $id_perintah_kerja])->result_array();

	    $data['data_trx_sparepart'] = $this->db->get_where('view_transaksi_sparepart', 
	    												   ['id_perintah_kerja' => $id_perintah_kerja])->result_array();       

	    echo json_encode($data);
    }	

    public function DoneTask($id){

	    $this->db->where('id', $id);
    	$update = $this->db->update('tbl_uraian_pekerjaan', ['status' => 1]);       
    	if ($update) {
    		$msg = array(
                'msg'=>'Tugas sudah diselesaikan',
                'icon' => 'success',
            );
    	}else{
    		$msg = array(
                'msg'=>'Status Tugas gagal diupdate, silahkan coba kembali',
                'icon' => 'error',
            );
    	}

    	echo json_encode($msg);
    }

    
}