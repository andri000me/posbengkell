<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class FinalCheck  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }

    public function index($id = -1){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['subtitle_small'] = 'Final Check';          

        if ($id == -1) {
            $data['page']           = 'final_checkv2';            
            $data['perintah_kerja'] = $this->db->get_where('view_perintah_kerja', ['status' => 1])->result_array();        
            $this->themes->Display('admin/final_check/final_checkv2', $data);

        }else{
            $data['page']           = 'final_check';                        
            $data['perintah_kerja'] = $this->db->get_where('tbl_perintah_kerja', ['id' => $id])->row();        
            $data['id_penerimaan'] = $data['perintah_kerja']->id_penerimaan;
                    
            $data['final_check'] = $this->db->get_where('tbl_final_check', ['id_perintah_kerja'=> $id])->row();     

            $data['uraian_pekerjaan']    = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja'=> $id])->result_array();
            $data['transaksi_sparepart'] = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja'=> $id])->result_array();

            $data['final_check_available'] = $this->db->get_where('tbl_uraian_pekerjaan', [
                                                                    'id_perintah_kerja'=> $id,
                                                                    'status' => 1])->num_rows();

            foreach ($data['uraian_pekerjaan'] as $key => $value) {
                if ($value['tipe_keuntungan'] == 0) {
                    $data['uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + ($value['biaya'] * $value['nilai_keuntungan'] / 100);
                }else{
                    $data['uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + $value['nilai_keuntungan'];
                }    
            }   

            $this->themes->Display('admin/final_check/final_check', $data);
        }

    } 

    public function SaveFixingPrice(){
        $id = $this->input->post('id');
        $biaya = $this->input->post('biaya');        


        $this->db->where('id', $id);        

        $updateFixed = $this->db->update('tbl_uraian_pekerjaan', 
                                    ['biaya' => preg_replace("/[^0-9]/", "", $this->input->post('biaya'))]);

        if ($updateFixed) {
            $msg = array(
                'msg'=>'Simpan Ketetapan Biaya Berhasil.',
                'icon' => 'success',
            );
        }else{
            $msg = array(
                'msg'=>'Simpan Biaya Gagal, Coba Kembali!',
                'icon' => 'success',
            );
        }

        echo json_encode($msg);
    }
    
    public function SaveFinalCheck(){         
        $id_perintah_kerja = $this->input->post('id_perintah_kerja');
        $id_penerimaan = $this->input->post('id_penerimaan');        

        $dataFinalCheck = array(
           'id_perintah_kerja' => $id_perintah_kerja,
           'penemuan_saran' => $this->input->post('penemuan_saran'),
           'kebersihan_kendaraan_dalam' => $this->input->post('kebersihan_kendaraan_dalam') == 'on' ? 1 : 0,
           'kebersihan_kendaraan_luar' => $this->input->post('kebersihan_kendaraan_luar') == 'on' ? 1 : 0,
           'kelengkapan_kendaraan' => $this->input->post('kelengkapan_kendaraan') == 'on' ? 1 : 0,
           'part_bekas' => $this->input->post('part_bekas') == 'on' ? 1 : 0,
           'status' => $this->input->post('status') == 'on' ? 1 : 0,
        );

        $final_check = $this->db->get_where('tbl_final_check', ['id_perintah_kerja' => $id_perintah_kerja])->row();
        if ($final_check != null) {            
            $this->db->where('id_perintah_kerja', $id_perintah_kerja);
            $insertFinalCheck = $this->db->update('tbl_final_check', $dataFinalCheck);                     
        }else{
            $insertFinalCheck = $this->db->insert('tbl_final_check', $dataFinalCheck);
        }        
                                    
        if ($insertFinalCheck){
            if ($this->input->post('status') == 'on') {
                $this->db->where('id', $id_penerimaan);
                $updatePenerimaan   = $this->db->update('tbl_penerimaan', ['status' => 2 ]);                         

                $data_trx_sparepart = $this->db->get_where('tbl_transaksi_spare_part', 
                                                            ['id_perintah_kerja' => $id_perintah_kerja])->result_array();
                #id_spare_part
                #qty

                foreach ($data_trx_sparepart as $key => $value) {
                    $this->db->set('temp', 'temp-'.$value['qty'], FALSE);
                    $this->db->where('id', $value['id_spare_part']);
                    $this->db->update('tbl_spare_part');
                }
            }            
            
            $msg = array(
                'msg'=>'Simpan Hasil Diagnosa Berhasil',
                'icon' => 'success',
            );
        }else {
            $msg = array(
                'msg'=>'Simpan Hasil Diagnosa Gagal',
                'icon' => 'error',
            );
        }                
            
        echo json_encode($msg);
    }
}
