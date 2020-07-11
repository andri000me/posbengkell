<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class PerintahKerja  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();        
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->data_perintah_kerja !=  'ya'){
            redirect('dashboard');
        }
    }

    public function index(){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
		$data['subtitle_small'] = 'Perintah Kerja';
		$data['page'] = 'perintah_kerja';            
		$this->themes->Display('admin/perintah_kerja/perintah_kerja', $data);
    }

    public function ViewPerintahKerja($id = -1){
        $idbengkel = $this->session->userdata('idbengkel');   
        if ($id == -1) {
            $this->db->where('id_bengkel', $idbengkel);            
            $this->db->where('status', 1);            
            $data_penerimaan = $this->db->get('tbl_penerimaan')->result_array();   
                    
            $this->db->where('status', 1);                        
            $data['data'] = $this->db->get("view_perintah_kerja")->result_array();    

            echo json_encode($data);
        }else{                                   
            $data['data']                = $this->db->get_where("view_perintah_kerja", ['id'=> $id])->row();    

            $data['uraian_pekerjaan']    = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja'=> $id])->result_array();

            $data['transaksi_sparepart'] = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja'=> $id])->result_array();

            $final_check_available = true;
            foreach ($data['uraian_pekerjaan'] as $key => $value) {
                if ($value['tipe_keuntungan'] == 0) {
                    $data['uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + ($value['biaya'] * $value['nilai_keuntungan'] / 100);
                }else{
                    $data['uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + $value['nilai_keuntungan'];
                }    

                if ($data['uraian_pekerjaan'][$key]['biaya'] == 0 || $value['status'] == 0) {
                    $final_check_available = false;
                }
            }

            foreach ($data['transaksi_sparepart'] as $key => $value) {
                if ($value['status'] == 0) {
                    $final_check_available = false;
                }
            }

            if ($final_check_available) {
                $data['ready'] = true;
            }else{
                $data['ready'] = false;                
            }
            echo json_encode($data);
        }
    }
    
    public function AddPerintahKerja($id = -1){
        $authRole = $this->session->userdata('roleuser');        
        $idbengkel = $this->session->userdata('idbengkel');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
        $data['page'] = 'add_perintah_kerja';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Perintah Kerja';  
            $data['data_perintah_kerja'] = null;

            $this->db->where('id_bengkel', $idbengkel);                            
            $this->db->where('status', 0);                
            $data['data_penerimaan'] = $this->db->order_by('id','asc')
                                    ->get('tbl_penerimaan')
                                    ->result_array();
        }else{
            $data['subtitle_small'] = 'Edit Perintah Kerja';
            $data['data_perintah_kerja'] = $this->db->get_where('tbl_perintah_kerja',['id'=>$id])->row();

            $this->db->where('id', $data['data_perintah_kerja']->id_penerimaan);                
            $data['data_penerimaan'] = $this->db->order_by('id','asc')
                                    ->get('tbl_penerimaan')
                                    ->result_array();

            $this->db->where('id_perintah_kerja', $id);
            $data['final_check'] = $this->db->get('tbl_final_check')->row();                        
        }        

        $this->db->where('id_bengkel', $idbengkel);
        $this->db->where('role_user', 'TEKNISI');
        $data['teknisi'] = $this->db->get('view_data_pegawai')->result_array();

        $this->db->where('id_bengkel', $idbengkel);
        $this->db->where('role_user', 'GUDANG');
        $data['gudang'] = $this->db->get('view_data_pegawai')->result_array();

        $this->themes->Display('admin/perintah_kerja/add_perintah_kerja', $data);        
    }

    public function DeletePerintahKerja(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_perintah_kerja',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $data = $cekData->row();
            $deleteData = $this->db->delete('tbl_perintah_kerja',['id'=>$id]);
            if($deleteData){        
                $this->db->where(['id' => $data->id_penerimaan])->update('tbl_penerimaan', ['status' => 1]);                
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
    
    public function SavePerintahKerja(){       
        $userdata = $this->session->userdata('userdata')[0];       

        $id_penerimaan = $this->input->post('id_penerimaan');
        $data_perintah_kerja = array(
            'id_penerimaan' => $id_penerimaan,
            'id_admin' => $userdata->id,                                                            
            'pekerjaan' => $this->input->post('pekerjaan'),
            'pelanggan' => $this->input->post('pelanggan'),
            'id_teknisi' => $this->input->post('id_teknisi'),
            'id_gudang' => $this->input->post('id_gudang'),
            'tgl_jam_appointment' => $this->input->post('tgl_jam_appointment'),
            'tgl_jam_penyerahan' => $this->input->post('tgl_jam_penyerahan'),
            'stnk' => $this->input->post('stnk') == 'on' ? 1 : 0,
            'buku_service' => $this->input->post('buku_service') == 'on' ? 1 : 0,                    
        );

         if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
            
                $updatePerintahKerja = $this->db->where(['id' => $id])->update('tbl_perintah_kerja', $data_perintah_kerja);

            if($updatePerintahKerja){     
                $this->db->where(['id' => $id_penerimaan])->update('tbl_penerimaan', ['status' => 1]);
                $msg = array(
                    'msg'=>'Data Perintah Kerja Berhasil diubah',
                    'icon' => 'success',
                );                
            }else{
                $msg = array(
                    'msg'=>'Gagal mengubah data',
                    'icon' => 'error',
                );
            }
        }else{
            $id_penerimaan = $this->input->post('id_penerimaan');                        
            $this->db->set($data_perintah_kerja);            
            if ($this->db->insert('tbl_perintah_kerja')){
                $id = $this->db->insert_id();

                $this->db->where(['id' => $id_penerimaan])->update('tbl_penerimaan', ['status' => 1]);

                $pegawai_teknisi = $this->db->get_where('view_data_pegawai', [ 'id' => $data_perintah_kerja['id_teknisi'] ])->row();
                $pegawai_gudang  = $this->db->get_where('view_data_pegawai', [ 'id' => $data_perintah_kerja['id_gudang'] ])->row();

                $fb_token_teknisi   = $pegawai_teknisi->firebase_token;
                $title_teknisi      = "Hai, " . $pegawai_teknisi->nama;
                $message_teknisi    = "Ada Tugas yang harus kamu kerjakan loh ni.. :)";
                $type_teknisi       = "TEKNISI";
                $data_teknisi       = array("id_perintah_kerja" => $id);

                $fb_token_gudang    = $pegawai_gudang->firebase_token;
                $title_gudang       = "Hai, " . $pegawai_gudang->nama;
                $message_gudang     = "Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)";
                $type_gudang        = "GUDANG";
                $data_gudang        = array("id_perintah_kerja" => $id);
                

                $this->notification->Push(array($fb_token_teknisi), 
                                                $title_teknisi, 
                                                $message_teknisi, 
                                                $type_teknisi, 
                                                $data_teknisi);

                $gudang_notif = array('judul' => $title_gudang, 'deskripsi' => $message_gudang, 'id_user' => $data_perintah_kerja['id_gudang']);
                $this->db->insert('tbl_notifikasi', $gudang_notif);

                //DEPRECATE ON ANDROID
                $this->notification->Push(array($fb_token_gudang), 
                                                $title_gudang, 
                                                $message_gudang, 
                                                $type_gudang, 
                                                $data_gudang);

                $msg = array(                    
                    'msg'   =>  'Simpan Data Perintah Kerja Berhasil',
                    'icon'  =>  'success',
                    'id'    =>  $id
                );
            }else {
                $msg = array(
                    'msg'   =>'Simpan Data Perintah Kerja Gagal',
                    'icon'  => 'error',
                    'id'    =>  $id
                );
            }                                
        }

            echo json_encode($msg);
    }
}