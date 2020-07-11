<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class KeluhanPermintaan  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();        
    }

    public function index($id){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
		$data['subtitle_small'] = 'Keluhan & Permintaan';
		$data['page'] = 'keluhan_permintaan';
        $data['data_penerimaan'] = $this->db->get_where('tbl_penerimaan',['id'=>$id])->row();
		$this->themes->Display('admin/keluhan_permintaan/keluhan_permintaan', $data);
    }

    public function ViewKeluhanPermintaan($id_penerimaan){
        $this->db->where('id_penerimaan', $id_penerimaan);
        $data['data'] = $this->db->order_by('id','asc')
                                ->get('tbl_keluhan_permintaan')
                                ->result_array();
        echo json_encode($data);
    }    
    
    public function AddKeluhanPermintaan($id_penerimaan, $id = -1){
        $authRole = $this->session->userdata('roleuser');                
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['page'] = 'add_keluhan_permintaan';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Keluhan / Permintaan';  
            $data['data_keluhan_permintaan'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Keluhan / Permintaan';
            $data['data_keluhan_permintaan'] = $this->db->get_where('tbl_keluhan_permintaan',['id'=>$id])->row();
        }
        $data['data_penerimaan'] = $this->db->get_where('tbl_penerimaan',['id'=>$id_penerimaan])->row();
        $this->themes->Display('admin/keluhan_permintaan/add_keluhan_permintaan', $data);        
    }

    public function SaveKeluhanPermintaan(){           
        $input_keluhan_permintaan = array(
           'kategori' => $this->input->post('kategori'),
           'keterangan' => $this->input->post('keterangan'),
           'id_penerimaan' => $this->input->post('id_penerimaan')
        );

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updateKeluhan = $this->db->where(['id' => $id])
                                    ->update('tbl_keluhan_permintaan', $input_keluhan_permintaan);
            if($updateKeluhan){
                $msg = array(
                    'msg'=>'Data Keluhan berhasil diubah',
                    'icon' => 'success',
                );                
            }else{
                $msg = array(
                    'msg'=>'Gagal mengubah data',
                    'icon' => 'error',
                );
            }
        }else{
            $this->db->set($input_keluhan_permintaan);
            if ($this->db->insert('tbl_keluhan_permintaan')){
                $msg = array(
                    'msg'=>'Simpan Data '.$this->input->post('kategori').' Berhasil',
                    'icon' => 'success',
                );
            }else {
                $msg = array(
                    'msg'=>'Simpan Data '.$this->input->post('kategori').' Gagal',
                    'icon' => 'error',
                );
            }                
        }        
            
        echo json_encode($msg);
    }

    public function DeleteKeluhanPermintaan(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_keluhan_permintaan',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_keluhan_permintaan',['id'=>$id]);
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

    
}