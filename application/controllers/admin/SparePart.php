<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class SparePart  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();        
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->data_sparepart !=  'ya'){
            redirect('dashboard');
        }
    }

    public function index(){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                
		$data['subtitle_small'] = 'Stok Spare Part';
		$data['page'] = 'sparepart';
		$this->themes->Display('admin/sparepart/sparepart', $data);
    }
    
    public function ViewSparePart(){
        $idbengkel = $this->session->userdata('idbengkel');

        $this->db->where('id_bengkel', $idbengkel);        
        $data_sparepart = $this->db->order_by('id','asc')
                                ->get('tbl_spare_part')
                                ->result_array();

        foreach ($data_sparepart as $key => $value) {
            $data_sparepart[$key]['harga_beli'] = "Rp.". number_format($value['harga_beli'], 0, ".", ".");
            $data_sparepart[$key]['harga_jual'] = "Rp.". number_format($value['harga_jual'], 0, ".", ".");
        }                                
        
        $data['data'] = $data_sparepart;
        echo json_encode($data);
    }

    public function DeleteSparePart(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_spare_part',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_spare_part',['id'=>$id]);
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

    public function AddSparePart($id = -1){
        $idbengkel = $this->session->userdata('idbengkel');        
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
        $data['page'] = 'add_sparepart';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Spare-Part';  
            $data['data_sparepart'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Spare-Part';            
            $data['data_sparepart'] = $this->db->get_where('tbl_spare_part',['id'=>$id])->row();
        }
        $data['data_kategori_sparepart'] = $this->db->get_where('tbl_kategori_spare_part', ['id_bengkel'=>$idbengkel])->result_array();
        $this->themes->Display('admin/sparepart/add_sparepart', $data);        
    }

    public function SaveSparePart(){  
        $idbengkel = $this->session->userdata('idbengkel');        
        
        $data_kategori = array(
            'id_bengkel' => $idbengkel,
            'kode_barang' => time(),
            'kategori' =>  $this->input->post('kategori'),
            'nama' =>  $this->input->post('nama_sparepart'),
            'harga_beli' =>  preg_replace("/[^0-9]/", "", $this->input->post('harga_beli')),
            'harga_jual' =>  preg_replace("/[^0-9]/", "", $this->input->post('harga_jual')),
            'stok' =>  $this->input->post('stok'),
        );

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updateSparePart = $this->db->where(['id' => $id])
                                    ->update('tbl_spare_part', $data_kategori);
            if($updateSparePart){
                $msg = array(
                    'msg'=>'Ubah Data Spare-Part Berhasil',
                    'icon' => 'success',
                );
            }else{
                $msg = array(
                    'msg'=>'Ubah Data Spare-Part Gagal',
                    'icon' => 'error',
                );
            }
        }else{
            $this->db->set($data_kategori);
            if ($this->db->insert('tbl_spare_part')){
                $msg = array(
                    'msg'=>'Simpan Data Spare-Part Berhasil',
                    'icon' => 'success',
                );
            }else {
                $msg = array(
                    'msg'=>'Simpan Data Spare-Part Gagal',
                    'icon' => 'error',
                );
            }                
        }            
            
        echo json_encode($msg);
    }
}