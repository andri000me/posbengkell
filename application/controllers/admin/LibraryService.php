<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class LibraryService  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();        
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->library_service !=  'ya'){
            redirect('dashboard');
        }
    }

    public function index(){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                
		$data['subtitle_small'] = 'Library Service';
		$data['page'] = 'library_service';
		$this->themes->Display('admin/data-library-service/data-library-service', $data);
    }
    
    public function View(){
        $idbengkel = $this->session->userdata('idbengkel');
        
        $data_library = $this->db->get_where('tbl_library_service', [
                                    'id_bengkel' => $idbengkel])->result_array();         
        
        $data['data'] = $data_library;
        echo json_encode($data);
    }

    public function Delete(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_library_service',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_library_service',['id'=>$id]);
            if($deleteData){
                $msg = array(
                    'msg'=>'Berhasil menghapus data',
                    'icon' => 'success',
                );                                
            }else{
                $msg = array(
                    'msg'=>'Gagal menghapus data',
                    'icon' => 'error',
                );
            }
        }else{
            $msg = array(
                'msg'=>'Data tidak ditemukan',
                'icon' => 'error',
            );
        }
        
        echo json_encode($msg);
    }

    public function Add($id = -1){
        $idbengkel = $this->session->userdata('idbengkel');        
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
        $data['page'] = 'add_library_service';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Library Service';  
            $data['data_library_service'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Library Service';            
            $data['data_library_service'] = $this->db->get_where('tbl_library_service',['id'=>$id])->row();
        }
        $this->themes->Display('admin/data-library-service/add-library-service', $data);        
    }

    public function Save(){  
        $idbengkel = $this->session->userdata('idbengkel');  
        
        $data_library = array(
            'id_bengkel'        => $idbengkel,
            'kode_service'      => "SERVICE-".time(),
            'service'           => $this->input->post('service'),
            'keterangan'        => $this->input->post('keterangan'),
            'biaya'             => preg_replace("/[^0-9]/", "", $this->input->post('biaya')),
            'tipe_keuntungan'   => $this->input->post('tipe_keuntungan'),
            'nilai_keuntungan'  => $this->input->post('nilai_keuntungan'),            
        );

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updateSparePart = $this->db->where(['id' => $id])
                                            ->update('tbl_library_service', $data_library);
            if($updateSparePart){
                $msg = array(
                    'msg'=>'Ubah Data Library Service Berhasil',
                    'icon' => 'success',
                );
            }else{
                $msg = array(
                    'msg'=>'Ubah Data Library Service Gagal',
                    'icon' => 'error',
                );
            }
        }else{
            $this->db->set($data_library);
            if ($this->db->insert('tbl_library_service')){
                $msg = array(
                    'msg'=>'Simpan Data Library Service Berhasil',
                    'icon' => 'success',
                );
            }else {
                $msg = array(
                    'msg'=>'Simpan Data Library Service Gagal',
                    'icon' => 'error',
                );
            }                
        }            
            
        echo json_encode($msg);
    }
}