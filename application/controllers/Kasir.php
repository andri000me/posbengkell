<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class Kasir extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }
    
    public function index(){
        $authRole  = $this->session->userdata('roleuser');
        $idbengkel = $this->session->userdata('idbengkel');
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['subtitle_small'] = 'Kasir';
        $data['page'] = 'kasir';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $data['data_bengkel'] = $this->db->get_where('tbl_info_bengkel', ['id' => $idbengkel])->row();

        $this->db->where('id_bengkel', $idbengkel);                            
        $this->db->where('status', 2);                
        $data['data_penerimaan'] = $this->db->order_by('id','asc')
                                ->get('tbl_penerimaan')
                                ->result_array();
        $this->themes->Display('kasir/kasir', $data);                	
    }    

    public function Bayar(){
        $total = preg_replace("/[^0-9]/", "", $this->input->post('total'));
        $bayar = preg_replace("/[^0-9]/", "", $this->input->post('bayar'));
        $kembalian = preg_replace("/[^0-9]/", "", $this->input->post('kembalian'));
        $diskon_service = $this->input->post('diskon_service');
        $diskon_sparepart = $this->input->post('diskon_sparepart');
        $id_perintah_kerja = $this->input->post('id_perintah_kerja');
        
        if ($bayar >= $total ) {
            $this->db->where('id', $this->input->post('id_penerimaan'));
            $isPaid = $this->db->update('tbl_penerimaan', ['status' => 3, 
                                                            'bayar' => $bayar,
                                                            'diskon'=> $this->input->post('diskon'), 
                                                            'diskon_sparepart'=> $diskon_sparepart, 
                                                            'diskon_service'=> $diskon_service, 
                                                            'ppn'   => $this->input->post('ppn'), 
                                                            'kembalian'     => $kembalian, 
                                                            'tgl_transaksi' => date("Y-m-d H:i:s")]);
            if ($isPaid) {
                // $trx_sparepart = $this->db->get_where('tbl_transaksi_spare_part')->result_array();

                // foreach ($trx_sparepart as $key => $value) {
                //     $this->db->set('temp', 'temp-'.$value['qty'], FALSE);
                //     $this->db->where('id', $value['id_spare_part']);
                //     $this->db->update('tbl_spare_part');
                // }
            // tmp - qty              
                $msg = array(
                    'msg'=>'Pembayaran Berhasil disimpan',
                    'icon' => 'success',
                );    
            }else{
                $msg = array(
                    'msg'=>'Pembayaran Gagal disimpan',
                    'icon' => 'error',
                );    
            }   
        }else{
            $msg = array(
                'msg'=>'Maaf, Uang yang dibayarkan tidak cukup.',
                'icon' => 'error',
            );    
        }        

        echo json_encode($msg);
    }

    public function tagihan($id_penerimaan){
        $idbengkel = $this->session->userdata('idbengkel');
        
        $this->db->where('id_bengkel', $idbengkel);            
        $this->db->where('id', $id_penerimaan);            
        $data['data'] = $this->db->order_by('id','asc')
                            ->get('tbl_penerimaan')
                            ->row();   


        $perintah_kerja = $this->db->get_where('tbl_perintah_kerja', ['id_penerimaan' => $id_penerimaan])->row();                             
        $this->db->where('id_penerimaan', $id_penerimaan);
        $data['data_keluhan'] = $this->db->order_by('id','asc')
                                ->get('tbl_keluhan_permintaan')
                                ->result_array();

        $this->db->where('id_perintah_kerja', $perintah_kerja->id);            
        $data['data_uraian_pekerjaan'] = $this->db->get('tbl_uraian_pekerjaan')
                                                    ->result_array();       

        $this->db->where('id_perintah_kerja', $perintah_kerja->id);            
        $data['data_trx_sparepart'] = $this->db->get('view_transaksi_sparepart')
                                                    ->result_array();           


        $data['perintah_kerja'] = $this->db->get_where('tbl_perintah_kerja', ['id_penerimaan' => $id_penerimaan])->row();                            
        $data['total'] = 0;
        $data['total_tagihan_sparepart'] = 0;
        $data['total_tagihan_pekerjaan'] = 0;

        foreach ($data['data_uraian_pekerjaan'] as $key => $value) {
            if ($value['tipe_keuntungan'] == 0) {
                $data['data_uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + ($value['biaya'] * $value['nilai_keuntungan'] / 100);
            }else{
                $data['data_uraian_pekerjaan'][$key]['biaya'] = $value['biaya'] + $value['nilai_keuntungan'];                                
            }    

            $data['total_tagihan_pekerjaan'] += $data['data_uraian_pekerjaan'][$key]['biaya'];
        }                                                              

        foreach ($data['data_trx_sparepart'] as $key => $value) {
            $data['total_tagihan_sparepart'] += $value['harga_jual'] * $value['qty'];            
        }

        $data['total'] = $data['total_tagihan_sparepart'] + $data['total_tagihan_pekerjaan'];            

        echo json_encode($data);   

    }

}