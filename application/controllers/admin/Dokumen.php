<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class Dokumen  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }
    
    public function SerahTerima($id){
        $idbengkel = $this->session->userdata('idbengkel');            
        
        $this->load->library('pdf');    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "serah-terima-kendaraan-".$idbengkel.".pdf";                


        $this->db->where('id_penerimaan', $id);
        $data['data_detail_penerimaan'] = $this->db->order_by('id','asc')
                                ->get('tbl_detail_penerimaan')
                                ->result_array();

		$this->db->where('id', $id);
        $data['data_penerimaan'] = $this->db->get('tbl_penerimaan')
                                ->row();
        
        $data['detail_penerimaan_1'] = [];
        $data['detail_penerimaan_2'] = [];
        $data['detail_penerimaan_3'] = [];
        $numOfCols = 3;
        $i = 0;
        $bootstrapColWidth = count($data['data_detail_penerimaan']) / $numOfCols;
        for ($i; $i < $bootstrapColWidth; $i++) {
            $data['detail_penerimaan_1'][] = $data['data_detail_penerimaan'][$i];
        }

        for ($i; $i < $bootstrapColWidth*2; $i++) {
            $data['detail_penerimaan_2'][] = $data['data_detail_penerimaan'][$i];
        }

        for ($i; $i < $bootstrapColWidth*3; $i++) {
            $data['detail_penerimaan_3'][] = $data['data_detail_penerimaan'][$i];
        }
        $this->pdf->load_view('pdf/serah_terima', $data);
    }   

    public function PerintahKerja($id){
        $idbengkel = $this->session->userdata('idbengkel');            

        $this->load->library('pdf');    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "perintah-kerja-".$idbengkel.".pdf";                

        $this->db->where('id', $id);
        $data['data_perintah_kerja'] = $this->db->get('tbl_perintah_kerja')
                                                ->row();

        $this->db->where('id', $data['data_perintah_kerja']->id_penerimaan);
        $data['data_penerimaan'] = $this->db->get('tbl_penerimaan')
                                            ->row();

        $this->db->where('id', $idbengkel);
        $data['data_bengkel'] = $this->db->get('tbl_info_bengkel')
                                        ->row();

        $this->db->where('id_penerimaan', $data['data_perintah_kerja']->id_penerimaan);
        $data['data_permintaan_keluhan'] = $this->db->get('tbl_keluhan_permintaan')
                                ->result_array();

        $this->db->where('id_perintah_kerja', $data['data_perintah_kerja']->id);
        $data['data_uraian_pekerjaan'] = $this->db->get('tbl_uraian_pekerjaan')
                                                ->result_array();      

        $this->db->where('id_perintah_kerja', $data['data_perintah_kerja']->id);
        $data['data_transaksi_sparepart'] = $this->db->get('view_transaksi_sparepart')
                                                ->result_array();                                                      

        $this->db->where('id', $data['data_perintah_kerja']->id_teknisi);
        $data['data_teknisi'] = $this->db->get('view_data_pegawai')
                                                ->row();      
        
        $this->db->select('username as nama');
        $this->db->select('role_user');
        $this->db->where('id', $data['data_penerimaan']->id_admin);
        $data_sa = $this->db->get('tbl_user')->row();   

        if ($data_sa != null) {            
            if ($data_sa->role_user == "ADMIN") {
                $this->db->where('id', $data['data_penerimaan']->id_admin);
                $data_sa = $this->db->get('view_data_pegawai')->row();                           
            }
        }

        $biaya = 0;

        foreach ($data['data_uraian_pekerjaan'] as $key => $value) {
            if ($value['tipe_keuntungan'] == 0) {
                $data['data_uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + ($value['biaya'] * $value['nilai_keuntungan'] / 100);
            }else{
                $data['data_uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + $value['nilai_keuntungan'];                                
            }    
            $biaya += $data['data_uraian_pekerjaan'][$key]['biaya'];
        }                                                              

        $data['service_advisor'] = $data_sa;
        $data['biaya'] = $biaya;

        // echo  json_encode($data);
        $this->pdf->load_view('pdf/perintah_kerja', $data);
    } 

    public function Invoice($id){
        $idbengkel = $this->session->userdata('idbengkel');            
        
        $this->load->library('pdf');    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "invoice-".$idbengkel.".pdf";                
                

        $this->db->where('id', $idbengkel);
        $data['data_bengkel'] = $this->db->get('tbl_info_bengkel')->row();

        $this->db->where('id', $id);
        $data['data_penerimaan'] = $this->db->get('tbl_penerimaan')->row();

        $this->db->where('id_penerimaan', $id);
        $data['data_perintah_kerja'] = $this->db->get('tbl_perintah_kerja')->row();

        $this->db->where('id_perintah_kerja', $data['data_perintah_kerja']->id);
        $data['data_transaksi_sparepart'] = $this->db->get('view_transaksi_sparepart')->result_array();

        $this->db->where('id_perintah_kerja', $data['data_perintah_kerja']->id);
        $data['data_uraian_pekerjaan'] = $this->db->get('view_data_service')->result_array();

        $data['total'] = 0;

        foreach ($data['data_uraian_pekerjaan'] as $key => $value) {
            $data['data_uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + ($value['biaya'] * $value['persen'] / 100);
            $data['total'] += $data['data_uraian_pekerjaan'][$key]['biaya'];
        }

        foreach ($data['data_transaksi_sparepart'] as $key => $value) {
            $data['total'] += $value['harga_jual'] * $value['qty'];
        }
        
        // $this->load->view('pdf/invoice', $data);
        $this->pdf->load_view('pdf/invoice', $data);
    }   

    public function Kwitansi($id){
        $idbengkel = $this->session->userdata('idbengkel');            
        
        $this->load->library('pdf');    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "kwitansi-".$idbengkel.".pdf";                
                

        $this->db->where('id', $idbengkel);
        $data['data_bengkel'] = $this->db->get('tbl_info_bengkel')->row();

        $this->db->where('id', $id);
        $data['data_penerimaan'] = $this->db->get('tbl_penerimaan')->row();

        $this->db->where('id_penerimaan', $id);
        $data['data_perintah_kerja'] = $this->db->get('tbl_perintah_kerja')->row();

        $this->db->where('id_perintah_kerja', $data['data_perintah_kerja']->id);
        $data['data_transaksi_sparepart'] = $this->db->get('view_transaksi_sparepart')->result_array();

        $this->db->where('id_perintah_kerja', $data['data_perintah_kerja']->id);
        $data['data_uraian_pekerjaan'] = $this->db->get('view_data_service')->result_array();

        $data['total'] = 0;
        $data['total_tagihan_sparepart'] = 0;
        $data['total_tagihan_pekerjaan'] = 0;

        foreach ($data['data_uraian_pekerjaan'] as $key => $value) {                        
            $data['data_uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + ($value['biaya'] * $value['persen'] / 100);
            $data['total_tagihan_pekerjaan'] += $data['data_uraian_pekerjaan'][$key]['biaya'];
        }


        foreach ($data['data_transaksi_sparepart'] as $key => $value) {
            $detail['qty']  = $value['qty'];
            $detail['item'] = $value['nama_barang'];
            $detail['biaya'] = $value['harga_jual'] * $value['qty'];
            $data['total_tagihan_sparepart'] += $detail['biaya'];
        }

        if ($data['data_penerimaan']->diskon_service > 0) {
            $total_tagihan_pekerjaan = $data['total_tagihan_pekerjaan'] - ($data['total_tagihan_pekerjaan'] * $data['data_penerimaan']->diskon_service / 100);                
        }else{
            $total_tagihan_pekerjaan = $data['total_tagihan_pekerjaan'];
        }
        if ($data['data_penerimaan']->diskon_sparepart > 0) {
            $total_tagihan_sparepart = $data['total_tagihan_sparepart'] - ($data['total_tagihan_sparepart'] * $data['data_penerimaan']->diskon_sparepart / 100);             
        }else{
            $total_tagihan_sparepart = $data['total_tagihan_sparepart'];            
        }

        $data['total'] = ($total_tagihan_sparepart + $total_tagihan_pekerjaan) + (($total_tagihan_sparepart + $total_tagihan_pekerjaan) * 0.10) ; // 0.10 adalah ppn 10%
        // echo json_encode($data);
        
        // $this->load->view('pdf/invoice', $data);
        $this->pdf->load_view('pdf/kwitansi', $data);
    }       

    

    public function HasilDiagnosa($id){
        
    }
}