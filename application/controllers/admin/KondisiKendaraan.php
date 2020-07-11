<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class KondisiKendaraan  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->kondisi_kendaraan !=  'ya'){
            redirect('dashboard');
        }
    }

    public function index(){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                                    
		$data['subtitle_small'] = 'Kondisi Kendaraan';
		$data['page'] = 'kondisi_kendaraan';
    	$this->themes->Display('admin/kondisi_kendaraan/kondisi_kendaraan', $data);
    }
    
    public function ViewKondisiKendaraan(){
        $idbengkel = $this->session->userdata('idbengkel');                

        $data_kondisi = $this->db->order_by('id','asc')
                                ->get_where('tbl_kondisi_kendaraan', ['id_bengkel' => $idbengkel])
                                ->result_array();
        
        $data['data'] = $data_kondisi;
        echo json_encode($data);
    }

    public function DeleteKondisiKendaraan(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_kondisi_kendaraan',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_kondisi_kendaraan',['id'=>$id]);
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

    public function SaveKondisiKendaraan(){  
        $idbengkel = $this->session->userdata('idbengkel');                
        $kondisi_kendaraan = $_POST['kondisi_kendaraan'];
                
        $data_kondisi_kendaraan = array(
            'id_bengkel' => $idbengkel,
            'keterangan' => $kondisi_kendaraan,
        );
        
        $this->db->set($data_kondisi_kendaraan);
        if ($this->db->insert('tbl_kondisi_kendaraan')){
            $msg = array(
                'msg'=>'Simpan Data Kondisi Kendaraan Berhasil',
                'icon' => 'success',
            );
        }else {
            $msg = array(
                'msg'=>'Simpan Data Kondisi Kendaraan Gagal',
                'icon' => 'error',
            );
        }                
            
        echo json_encode($msg);
    }
}