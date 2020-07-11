<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class Penerimaan  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->data_penerimaan !=  'ya'){
            redirect('dashboard');
        }
    }
    
    public function index(){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
		$data['subtitle_small'] = 'Penerimaan';
		$data['page'] = 'penerimaan';            
		$this->themes->Display('admin/penerimaan/penerimaan', $data);
    }
    
    public function ViewPenerimaan($id = -1){
        $idbengkel = $this->session->userdata('idbengkel');                
        if ($id == -1) {
            $this->db->where('id_bengkel', $idbengkel);            
            $data['data'] = $this->db->order_by('id','asc')
                                ->get('tbl_penerimaan')
                                ->result_array();   
        }else if($id == 0){
            $this->db->where('id_bengkel', $idbengkel);            
            $this->db->where('status', 0);            
            $data['data'] = $this->db->order_by('id','asc')
                                ->get('tbl_penerimaan')
                                ->row();   
        }
        else{
            $this->db->where('id_bengkel', $idbengkel);            
            $this->db->where('id', $id);            
            $data['data'] = $this->db->order_by('id','asc')
                                ->get('tbl_penerimaan')
                                ->row();   

            $this->db->where('id_penerimaan', $id);
            $data['data_keluhan'] = $this->db->order_by('id','asc')
                                    ->get('tbl_keluhan_permintaan')
                                    ->result_array();

            if (count($data['data_keluhan']) > 0 && $data['data'] != null) {
                $data['ready'] = true;
            }else{
                $data['ready'] = false;                
            }
        }
        echo json_encode($data);
    }

    public function ViewDetailPenerimaan($id_penerimaan){
        $this->db->where('id_penerimaan', $id_penerimaan);
        $data['data'] = $this->db->order_by('id','asc')
                                ->get('tbl_detail_penerimaan')
                                ->result_array();
        echo json_encode($data);
    }

    public function AddPenerimaan($id = -1){
        $idbengkel  = $this->session->userdata('idbengkel');                        
        $authRole   = $this->session->userdata('roleuser');        
        $data['id_bengkel'] = $idbengkel;
        $data['allow']      = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle']   = ucwords(str_replace('_', ' ', $authRole));                
        $data['page']       = 'add_penerimaan';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Penerimaan';  
            $data['data_penerimaan'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Penerimaan';
            $data['data_penerimaan'] = $this->db->get_where('tbl_penerimaan',['id'=>$id])->row();
        }
        $data['data_kondisi_kendaraan'] = $this->db->order_by('id','asc')
                                                    ->get('tbl_kondisi_kendaraan')
                                                    ->result_array();

        $this->themes->Display('admin/penerimaan/add_penerimaan', $data);        
    }

    
    public function DeletePenerimaan(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_penerimaan',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_penerimaan',['id'=>$id]);
            if($deleteData){        
                $this->db->delete('tbl_detail_penerimaan',['id_penerimaan'=>$id]);
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

    public function DeleteDetailPenerimaan(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_detail_penerimaan',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_detail_penerimaan',['id'=>$id]);
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



    public function SaveDetailPenerimaan(){  
        $kondisi_kendaraan = $_POST['kondisi_kendaraan'];
        $id_penerimaan = $_POST['id_penerimaan'];
                
        $data_kondisi_kendaraan = array(
           'keterangan' => $kondisi_kendaraan,
           'id_penerimaan' => $id_penerimaan
        );
        
        $this->db->set($data_kondisi_kendaraan);
        if ($this->db->insert('tbl_detail_penerimaan')){
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

    public function SetDetailPenerimaan()
    {
        $id = $this->input->post('id');
        $updateKondisi = $this->db->where(['id' => $id])->update('tbl_detail_penerimaan',
            [
                'status' => $this->input->post('status'),           
            ]
        );

        if($updateKondisi){                    
            $msg = array(
                'status'=> true,
            );                
        }else{
            $msg = array(
                'status'=> false
            );
        }
        echo json_encode($msg);
    }

    public function SavePenerimaan(){

        $userdata = $this->session->userdata('userdata')[0];
        $idbengkel = $this->session->userdata('idbengkel');

        $input_post = ['id_bengkel' => $idbengkel,
                        'id_admin' => $userdata->id,
                        'nama_pemilik' => $this->input->post('nama_pemilik'),
                        'telepon_pemilik' => $this->input->post('no_telepon'),            
                        'alamat_pemilik' => $this->input->post('alamat'),
                        'no_pkb' =>  $this->input->post('no_pkb'),                    
                        'tahun_produksi' => $this->input->post('tahun_produksi'),
                        'no_rangka' => $this->input->post('no_rangka'),
                        'no_mesin' => $this->input->post('no_mesin'),
                        'tipe_warna' => $this->input->post('tipe_warna'),
                        'no_polisi' => $this->input->post('no_polisi'),    
                        'bahan_bakar' => $this->input->post('bahan_bakar'),    
                        'kilometer' => $this->input->post('kilometer'),
                        'email_pemilik' => $this->input->post('email_pemilik')];

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updatePenerimaan = $this->db->where(['id' => $id])->update('tbl_penerimaan', $input_post);

            if($updatePenerimaan){                    
                $msg = array(
                    'msg'   =>  'Data Penerimaan Berhasil diubah',
                    'icon'  =>  'success',
                    'id'    =>  $id                    
                );                
            }else{
                $msg = array(
                    'msg'   =>'Gagal mengubah data',
                    'icon'  => 'error',
                );
            }
        }else{        
            $savePenerimaan = $this->db->insert('tbl_penerimaan', $input_post);
            if($savePenerimaan){
                $id = $this->db->insert_id();

                $data_kondisi_kendaraan = $this->db->get('tbl_kondisi_kendaraan')->result_array();
                foreach ($data_kondisi_kendaraan as $key => $value) {
                    $this->db->insert('tbl_detail_penerimaan', ['id_penerimaan' => $id,
                                                                'keterangan' => $value['keterangan']]);
                }

                $msg = array(
                    'msg'   =>  'Penerimaan Kendaraan Berhasil disimpan',
                    'icon'  =>  'success',
                    'id'    =>  $id                    

                );
            }else{
                $msg = array(
                    'msg'   =>  'Gagal menyimpan data',
                    'icon'  =>  'error',
                    'id'    =>  $id                                        
                );
            } 
        }        
        echo json_encode($msg);
    }
}