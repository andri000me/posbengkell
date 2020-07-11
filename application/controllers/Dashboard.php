<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class Dashboard  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }
    
    public function index(){
        $authRole = $this->session->userdata('roleuser');
        $idbengkel = $this->session->userdata('idbengkel');        
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['subtitle_small'] = 'Dashboard';
        $data['page'] = 'dashboard';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        if ($authRole == "SUPERADMIN") {
        	$this->themes->Display('superadmin/dashboard', $data);                	
        }else if ($authRole == "ADMIN") {
            $this->db->distinct('email_pemilik');
            $data['jumlah_customer'] = $this->db->get_where('tbl_penerimaan', [
                                                            'email_pemilik !=' => "",
                                                            'id_bengkel' => $idbengkel])->num_rows();            

            $this->db->distinct('no_polisi');
            $data['jumlah_kendaraan'] = $this->db->get_where('tbl_penerimaan', [
                                                            'no_polisi !=' => "",
                                                            'id_bengkel' => $idbengkel])->num_rows();

            $data['jumlah_order_service'] = $this->db->get_where('tbl_penerimaan', [
                                                                'status ' => 1,
                                                                'id_bengkel' => $idbengkel])->num_rows();                        
            
            $data['jumlah_order_booking'] = $this->db->get_where('tbl_penerimaan', [
                                                                'status ' => 0,
                                                                'id_bengkel' => $idbengkel])->num_rows();                        

            
            $this->db->where("(role_user<>'ADMIN' AND role_user<>'MANAGER')", NULL, FALSE);        
            $this->db->where('id_bengkel', $idbengkel);
            $data['jumlah_pegawai'] = $this->db->order_by('id','asc')->get('view_data_pegawai')
                                                                    ->num_rows();

            $this->themes->Display('admin/dashboard/dashboard', $data);                                           
        }else{
            $this->themes->Display('gudang/dashboard', $data);                                           
        }
    }    
}