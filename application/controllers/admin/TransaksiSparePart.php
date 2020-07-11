<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class TransaksiSparePart  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }

    public function ViewTransaksiSparePart($id_perintah_kerja){
        $this->db->where('id_perintah_kerja', $id_perintah_kerja);
        $data_transaksi_spare_part = $this->db->order_by('id','asc')
                                ->get('view_transaksi_sparepart')
                                ->result_array();

        foreach ($data_transaksi_spare_part as $key => $value) {
            $data_transaksi_spare_part[$key]['harga_jual'] = "Rp.". number_format($value['harga_jual'], 0, ".", ".");
        }                                

        // foreach ($data_uraian_pekerjaan as $key => $value) {
        //     $data_uraian_pekerjaan[$key]['estimasi_biaya'] = "Rp.". number_format($value['estimasi_biaya'], 0, ".", ".");
        // }

        $data['data'] = $data_transaksi_spare_part;
        echo json_encode($data);
    }    

    public function AutoCompleteSparePart(){        
        $idbengkel = $this->session->userdata('idbengkel');        
        $keyword = $this->input->post('keyword');
        $term   =   $this->input->get('term'); //pencarian autocomplete plugin jqueryui

        if(!is_null($keyword)){       
            $this->db->like('kode_barang',$keyword);
            $this->db->or_like('nama',$keyword); 
        }
        
        if(!is_null($term)){
            $select     =   'nama, kode_barang, harga_beli';
            $selectParams   =   $this->input->get('select');

            if(!is_null($selectParams)){
                $select     =   trim($selectParams);
            }

            $this->db->select($select);
            $this->db->like('kode_barang', $term);
            $this->db->or_like('nama', $term);
        }

        $this->db->where('id_bengkel', $idbengkel); 
        $data = $this->db->get('tbl_spare_part')->result_array();
        echo json_encode($data);
    }

    public function GetSparePart($id){
        $idbengkel = $this->session->userdata('idbengkel');        
        $this->db->where('id_bengkel', $idbengkel);
        $this->db->like('id', $id);
        $data = $this->db->get('tbl_spare_part')->row();
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
    
    public function AddTransaksiSparePart($id_perintah_kerja, $id = -1){
        $idbengkel = $this->session->userdata('idbengkel');                
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
        $data['page'] = 'add_transaksi_sparepart';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Transaksi Spare-Part';  
            $data['data_transaksi_spare_part'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Transaksi Spare-Part';
            $data['data_transaksi_spare_part'] = $this->db->get_where('tbl_transaksi_spare_part', ['id'=>$id])->row();
        }
        $data['data_perintah_kerja'] = $this->db->get_where('tbl_perintah_kerja',['id'=>$id_perintah_kerja])->row();
        $data['data_spare_part'] = $this->db->get_where('tbl_spare_part',['id_bengkel' => $idbengkel, 'stok > ' => 0])->result_array();
        $this->themes->Display('admin/transaksi_sparepart/add_transaksi_sparepart', $data);        
    }

    public function SaveTransaksiSparePart(){         
                
        $input_trx = array(
            'id_spare_part' => $this->input->post('id_barang'),                        
            'qty'           => $this->input->post('qty'),
            'keterangan'    => $this->input->post('keterangan'),
            'id_perintah_kerja' => $this->input->post('id_perintah_kerja')
        );

        $data_spare_part = $this->db->get_where('tbl_spare_part', ['id'=> $this->input->post('id_barang') ])->row();
        if (empty($data_spare_part)) {
            $msg = array(
                'msg'=>'Maaf, Data Tidak ditemukan',
                'icon' => 'error',
            );
        }else{
            if ($data_spare_part->stok >= $this->input->post('qty')) {
                if(!empty($this->input->post('id'))){
                    $id = $this->input->post('id');
                        $updateTrx = $this->db->where(['id' => $id])
                                            ->update('tbl_transaksi_spare_part', $updateTrx);
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
                    $this->db->set($input_trx);
                    if ($this->db->insert('tbl_transaksi_spare_part')){

                        //UPDATE SPAREPART
                        $temp = $data_spare_part->temp + $this->input->post('qty'); 
                        $stok = $data_spare_part->stok - $this->input->post('qty'); 
                        $this->db->where('id', $this->input->post('id_barang'));
                        $this->db->update('tbl_spare_part', ['temp' => $temp, 'stok' => $stok]);

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
            }else{
                $msg = array(
                    'msg'=>'Maaf, Kuantitas Tidak Ckup',
                    'icon' => 'error',
                );  
            }
        }                
            
        echo json_encode($msg);
    }

    public function DeleteTransaksiSparePart(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_transaksi_spare_part',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_transaksi_spare_part',['id'=>$id]);
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