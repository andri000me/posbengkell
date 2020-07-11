<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class Gudang extends CI_Controller{
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
        $data['subtitle_small'] = 'Gudang';
        $data['page'] = 'gudang';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->db->where('id_gudang', $dataUser->id);                        
        $this->db->where('status', 1);                        
        $data['perintah_kerja'] = $this->db->get("view_perintah_kerja")->result_array();    
        $this->themes->Display('gudang/gudang', $data);                	
    }   

    public function viewTugasGudang($id_perintah_kerja){    	

	    $data['data_uraian_pekerjaan'] 	= $this->db->get_where('tbl_uraian_pekerjaan', 
	    														['id_perintah_kerja' => $id_perintah_kerja])->result_array();

	    $data['data_trx_sparepart'] = $this->db->get_where('view_transaksi_sparepart', 
	    												   ['id_perintah_kerja' => $id_perintah_kerja])->result_array();       

	    echo json_encode($data);
    }	

    public function giveIt($id_trx){

	    $this->db->where('id', $id_trx);
    	$update = $this->db->update('tbl_transaksi_spare_part', ['status' => 1]);       
    	if ($update) {
    		$msg = array(
                'msg'=>'Sparepart sudah diberikan',
                'icon' => 'success',
            );
    	}else{
    		$msg = array(
                'msg'=>'Status Sparepart gagal diupdate, silahkan coba kembali',
                'icon' => 'error',
            );
    	}

    	echo json_encode($msg);
    }

    
}