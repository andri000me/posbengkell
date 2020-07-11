<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class KategoriSparePart  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->kategori_sparepart !=  'ya'){
            redirect('dashboard');
        }
    }

    public function index(){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
		$data['subtitle_small'] = 'Kategori Spare Part';
		$data['page'] = 'kategori_sparepart';
		$this->themes->Display('admin/kategori_sparepart/kategori_sparepart', $data);
    }
    
    public function ViewKategoriSparePart(){
        $idbengkel = $this->session->userdata('idbengkel');                
        $this->db->where('id_bengkel', $idbengkel);
        $data_kategori = $this->db->order_by('id','asc')
                                ->get('tbl_kategori_spare_part')
                                ->result_array();
        
        $data['data'] = $data_kategori;
        echo json_encode($data);
    }

    public function DeleteKategoriSparePart(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_kategori_spare_part',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_kategori_spare_part',['id'=>$id]);
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

    public function SaveKategoriSparePart(){  
        $idbengkel = $this->session->userdata('idbengkel');                        
        $kategori_sparepart = $_POST['kategori_sparepart'];
                
        $data_kategori = array(
            'id_bengkel' => $idbengkel,
            'kategori' => $kategori_sparepart,
        );
        
        $this->db->set($data_kategori);
        if ($this->db->insert('tbl_kategori_spare_part')){
            $msg = array(
                'msg'=>'Simpan Data Kategori Spare Part Berhasil',
                'icon' => 'success',
            );
        }else {
            $msg = array(
                'msg'=>'Simpan Data Kategori Spare Part Gagal',
                'icon' => 'error',
            );
        }                
            
        echo json_encode($msg);
    }
}