<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class BatasanAkses  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();		
    	$authRole = $this->session->userdata('roleuser');        	
    	$allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();    	
        if($allow->batasan_akses !=  'ya'){
            redirect('dashboard');
        }
    }
    
    public function index(){
        $authRole = $this->session->userdata('roleuser');
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
		$data['subtitle_small'] = 'Batasan Akses';
		$data['page'] = 'batasan_akses';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
		$this->themes->Display('superadmin/batasan_akses/batasan_akses', $data);
    }   

    public function ViewBatasanAkses(){
        $data['data'] = $this->db->get('tbl_batasan_akses')
                                ->result_array();
        echo json_encode($data);
    }     
}