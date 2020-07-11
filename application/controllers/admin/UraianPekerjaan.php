<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class UraianPekerjaan  extends CI_Controller{
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

    public function ViewUraianPekerjaan($id_perintah_kerja){
        $this->db->where('id_perintah_kerja', $id_perintah_kerja);
        $data_uraian_pekerjaan = $this->db->order_by('id','asc')
                                ->get('tbl_uraian_pekerjaan')
                                ->result_array();        

        foreach ($data_uraian_pekerjaan as $key => $value) {
            if ($value['tipe_keuntungan'] == 0) {
                $val = $value['biaya'] + ($value['biaya'] * $value['nilai_keuntungan'] / 100);
                $data_uraian_pekerjaan[$key]['biaya'] = "Rp.". number_format($val, 0, ".", ".");
            }else{
                $val = $value['biaya'] + $value['nilai_keuntungan'];
                $data_uraian_pekerjaan[$key]['biaya'] = "Rp.". number_format($val, 0, ".", ".");
            }    
            $data_uraian_pekerjaan[$key]['estimasi_biaya'] = "Rp.". number_format($value['estimasi_biaya'], 0, ".", ".");
        }

        $data['data'] = $data_uraian_pekerjaan;
        echo json_encode($data);
    }

    public function AutoCompleteLibraryService(){        
        $idbengkel = $this->session->userdata('idbengkel');        
        $keyword = $this->input->post('keyword');

        $this->db->where('id_bengkel', $idbengkel);        
        $this->db->like('kode_service',$keyword);
        $this->db->or_like('service',$keyword); 
        $data = $this->db->get('tbl_library_service')->result_array();
        echo json_encode($data);
    }    

     public function GetLibraryService($id){
        $idbengkel = $this->session->userdata('idbengkel');        
        $this->db->where('id_bengkel', $idbengkel);
        $this->db->like('id', $id);
        $data = $this->db->get('tbl_library_service')->row();
        if ($data != null) {
            $reponse = array(
                'status' => true,
                'data'   => $data,
            );
        }else{
            $reponse = array(
                'status' => false,
                'msg'    => 'Gagal mengambil data',
                'icon'   => 'error',
            );
        }        
        echo json_encode($reponse);
    }
    
    public function AddUraianPekerjaan($id_perintah_kerja, $id = -1){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
        $data['page'] = 'add_uraian_pekerjaan';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Uraian Pekerjaan';  
            $data['data_uraian_pekerjaan'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Uraian Pekerjaan';
            $data['data_uraian_pekerjaan'] = $this->db->get_where('tbl_uraian_pekerjaan', ['id'=>$id])->row();
        }
        $data['data_perintah_kerja'] = $this->db->get_where('tbl_perintah_kerja',['id'=>$id_perintah_kerja])->row();
        $this->themes->Display('admin/uraian_pekerjaan/add_uraian_pekerjaan_v2', $data);        
    }

    public function SaveUraianPekerjaan(){   
        $data_library = $this->db->get_where('tbl_library_service', ['id' => $this->input->post('id_service')])->row();

        $check_is_exist = $this->db->get_where('tbl_uraian_pekerjaan', [
                                                'id_service'        => $this->input->post('id_service'),
                                                'id_perintah_kerja' => $this->input->post('id_perintah_kerja')])->num_rows();

        $input_uraian_pekerjaan = array(
            // 'estimasi_biaya' => preg_replace("/[^0-9]/", "", $this->input->post('estimasi_biaya')),            
            'id_service' => $this->input->post('id_service'),
            'keterangan' => $data_library->keterangan,
            'biaya' => $data_library->biaya,
            'tipe_keuntungan' => $data_library->tipe_keuntungan,
            'nilai_keuntungan' => $data_library->nilai_keuntungan,
            'id_perintah_kerja' => $this->input->post('id_perintah_kerja')
        );

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updateUraian = $this->db->where(['id' => $id])
                                    ->update('tbl_uraian_pekerjaan', $input_uraian_pekerjaan);
            if($updateUraian){
                $msg = array(
                    'msg'=>'Data Uraian berhasil diubah',
                    'icon' => 'success',
                );                
            }else{
                $msg = array(
                    'msg'=>'Gagal mengubah data',
                    'icon' => 'error',
                );
            }
        }else{
            if ($check_is_exist > 0) {
                $msg = array(
                    'msg'=>'Jenis Service Sudah terdapat dalam perintah kerja ini',
                    'icon' => 'error',
                );   
            }else{
                $this->db->set($input_uraian_pekerjaan);
                if ($this->db->insert('tbl_uraian_pekerjaan')){
                    $msg = array(
                        'msg'=>'Simpan Data Uraian Berhasil',
                        'icon' => 'success',
                    );
                }else {
                    $msg = array(
                        'msg'=>'Simpan Data Uraian Gagal',
                        'icon' => 'error',
                    );
                }                                
            }
        }        
            
        echo json_encode($msg);
    }

    public function DeleteUraianPekerjaan(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_uraian_pekerjaan',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_uraian_pekerjaan',['id'=>$id]);
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

    public function GetUraianPekerjaan(){
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $cekData = $this->db->get('tbl_uraian_pekerjaan');
        if($cekData->num_rows() > 0 ){
            $data = $cekData->row_array();
            echo json_encode($data);
        }else{
            $msg = array(
                'msg'=>'Data tidak ditemukan',
                'icon' => 'error',
            );
            echo json_encode($msg);
        }   
    }

    
}