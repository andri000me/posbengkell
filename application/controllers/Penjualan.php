<?php  
    if(!defined('BASEPATH')) exit ('no file allowed');
    class Penjualan extends CI_Controller{
        public function __construct(){
            parent::__construct();	
            date_default_timezone_set("Asia/Jakarta");
            isAuth();
        }

        public function index(){    	
            $dataUser = $this->session->userdata('userdata')[0];            	
            $authRole  = $this->session->userdata('roleuser');
            $idbengkel = $this->session->userdata('idbengkel');
            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'Penjualan';
            $data['page'] = 'penjualan';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
 
            $this->themes->Display('penjualan/index', $data);                	
        } 
        public function dataPenjualan(){    
            $statusPenjualan    =   $this->input->get('statusPenjualan');

            $column     =   $this->input->get('column');
            $start      =   $this->input->get('start');
            $end        =   $this->input->get('end');       

            if(!is_null($start) && !is_null($end) && !is_null($column)){
                $column =   trim($column);
                $start  =   trim($start);
                $end    =   trim($end);

                if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                    $start  =   ($column === 'waktu')? $start.' 00:00:00' : $start;
                    $end    =   ($column === 'waktu')? $end.' 23:59:59' : $end;

                    $this->db->where($column.' >=', $start);
                    $this->db->where($column.' <=', $end);
                }
            }

            if(!is_null($statusPenjualan)){
                $this->db->where('statusPenjualan', $statusPenjualanSelected);
            }else{
                $this->db->where_in('statusPenjualan', ['selesai', 'batal']);
            }
            $this->db->order_by('id', 'desc');
            $listDataPenjualan   =   $this->db->get('view_penjualan');

            echo json_encode(['data' => $listDataPenjualan->result_array()]);
        }
        public function detailPenjualan($idPenjualan = false){
            $authRole  = $this->session->userdata('roleuser');
            
            $detailPenjualan    =   false;

            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'Detail Penjualan';
            $data['page'] = 'detail-penjualan';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
            
            if($idPenjualan !== false){
                $this->db->where('id', $idPenjualan);
                $getDetailPenjualan    =   $this->db->get('view_penjualan');

                if($getDetailPenjualan->num_rows() >= 1){
                    $detailPenjualan    =   $getDetailPenjualan->row();
                }
            }

            $data['detailPenjualan']    =   $detailPenjualan;

            $this->themes->Display('penjualan/detailPenjualan', $data);
        }
        public function createPenjualanBaru(){            	
            $authRole  = $this->session->userdata('roleuser');

            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'Buat Penjualan Baru';
            $data['page'] = 'create-penjualan-baru';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
 
            $this->themes->Display('penjualan/createPenjualanBaru', $data); 
        }
        public function penjualanPending(){            	
            $authRole  = $this->session->userdata('roleuser');

            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'List Penjualan Pending';
            $data['page'] = 'penjualan-pending';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
 
            $this->themes->Display('penjualan/penjualanPending', $data); 
        }
        public function lanjutkanPenjualanPending($idPenjualan = false){
            $authRole  = $this->session->userdata('roleuser');
    
            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = ($idPenjualan === false)? 'Penjualan Baru' : 'Lanjutkan Penjualan Pending';
            $data['page'] = ($idPenjualan === false)? 'penjualan-baru' : 'lanjutkan-penjualan-pending';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();  

            $sessionIDPenjualan     =   $this->session->userdata('sessionIDPenjualan');
            if($idPenjualan === false && is_null($sessionIDPenjualan)){
                $idBengkel  =   $this->session->userdata('idbengkel');
                $dataMasterPenjualan    =   ['statusPenjualan' =>  'start', 'idBengkel' => $idBengkel];
                $insertMasterPenjualan  =   $this->db->insert('tbl_penjualan', $dataMasterPenjualan);

                $idPenjualan    =   $this->db->insert_id();
                $this->session->set_userdata('sessionIDPenjualan', $idPenjualan);
            }

            if($idPenjualan === false && !is_null($sessionIDPenjualan)){
                $idPenjualan    =   $sessionIDPenjualan;
            }

            $this->db->select('sum(totalHarga) as grandTotal');
            $this->db->where('idPenjualan', $idPenjualan);
            $grandTotal  =   $this->db->get('view_penjualan_item')->row()->grandTotal;
            $data['grandTotal'] =   $grandTotal;    
        
            $this->db->where('idPenjualan', $idPenjualan);
            $itemPenjualan  =   $this->db->get('view_penjualan_item')->result_array();
            $data['itemPenjualan']  =   $itemPenjualan;

            $this->db->select('statusPenjualan');
            $this->db->where('id', $idPenjualan);
            $detailPenjualan    =   $this->db->get('view_penjualan');
            $data['detailPenjualan']    =   $detailPenjualan;
            
            $data['idPenjualan'] =   $idPenjualan;

            $this->themes->Display('penjualan/pilihProduk', $data); 
        }
        public function tambahItemPenjualan(){
            $idPenjualan    =   $this->input->post('idPenjualan');
            $idProduk       =   $this->input->post('idProduk');

            $statusTambahItem   =   false;
            if(!is_null($idPenjualan) && !is_null($idProduk)){
                $jumlahTambah   =   $this->input->post('jumlahTambah');
                $jumlahTambah   =   (is_null($jumlahTambah))? 1 : trim($jumlahTambah);

                $this->db->where('idPenjualan', $idPenjualan);
                $this->db->where('idProduk', $idProduk);
                $isProductExist     =   $this->db->get('view_penjualan_item');

                if($isProductExist->num_rows() >= 1){
                    $detailItem   =   $isProductExist->row();

                    $quantity   =   $detailItem->quantity;
                    $quantityBaru   =   $quantity + $jumlahTambah;

                    $this->db->where('idPenjualan', $idPenjualan);
                    $this->db->where('idProduk', $idProduk);
                    $tambahItemPenjualan     =   $this->db->update('tbl_penjualan_item', ['quantity' => $quantityBaru]);
                }else{
                    $this->db->select('harga_jual as hargaJual');
                    $this->db->where('id', $idProduk);
                    $detailProduk   =   $this->db->get('tbl_spare_part')->row();

                    $dataItemBaru   =   [
                        'idPenjualan'   =>  $idPenjualan,
                        'idProduk'      =>  $idProduk,
                        'harga'         =>  $detailProduk->hargaJual,
                        'diskon'        =>  0,
                        'quantity'      =>  $jumlahTambah
                    ];
                    $tambahItemPenjualan    =   $this->db->insert('tbl_penjualan_item', $dataItemBaru);
                }

                $statusTambahItem   =   ($tambahItemPenjualan)? true : false;

                echo json_encode(['statusTambahItem' => $statusTambahItem]);
            }
        }
        public function hapusItemPenjualan(){
            $idPenjualan    =   $this->input->post('idPenjualan');
            $idProduk       =   $this->input->post('idProduk');

            $statusHapusItem   =   false;
            if(!is_null($idPenjualan) && !is_null($idProduk)){
                $this->db->where('idPenjualan', $idPenjualan);
                $this->db->where('idProduk', $idProduk);
                $hapusItem     =   $this->db->delete('tbl_penjualan_item');

                $statusHapusItem    =   ($hapusItem)? true : false;

                echo json_encode(['statusHapusItem' => $statusHapusItem]);
            }
        }
        public function batalkanPenjualan(){
            $idPenjualan    =   $this->input->post('idPenjualan');

            $statusBatalkanPenjualan   =   false;
            if(!is_null($idPenjualan)){
                $this->db->where('id', $idPenjualan);
                $batalkanPenjualan     =   $this->db->update('tbl_penjualan', ['statusPenjualan' => 'batal']);

                $statusBatalkanPenjualan    =   ($batalkanPenjualan)? true : false;

                $sessionIDPenjualan =   $this->session->userdata('sessionIDPenjualan');
                if(!is_null($sessionIDPenjualan)){
                    $this->session->unset_userdata('sessionIDPenjualan');
                }
                
                echo json_encode(['statusBatalkanPenjualan' => $statusBatalkanPenjualan]);
            }
        }
        public function selesaikanPenjualan(){
            $idPenjualan    =   $this->input->post('idPenjualan');

            $statusSelesaikanPenjualan      =   false;
            if(!is_null($idPenjualan)){
                $stringID       =   str_pad($idPenjualan, 4, 0, STR_PAD_LEFT);

                $nomorTransaksi     =   'J'.$stringID;
                $dataPenyelesaian   =   [
                    'statusPenjualan'   =>  'pending',
                    'nomorTransaksi'    =>  $nomorTransaksi
                ];

                $this->db->where('id', $idPenjualan);
                $selesaikanPenjualan        =   $this->db->update('tbl_penjualan', $dataPenyelesaian);

                $sessionIDPenjualan =   $this->session->userdata('sessionIDPenjualan');
                if(!is_null($sessionIDPenjualan)){
                    $this->session->unset_userdata('sessionIDPenjualan');
                }

                $statusSelesaikanPenjualan  =   ($selesaikanPenjualan)? true : false;

                echo json_encode(['statusSelesaikanPenjualan' => $statusSelesaikanPenjualan]);
            }
        }
        public function cekItemPenjualan($idPenjualan = false){
            $authRole  = $this->session->userdata('roleuser');

            $data['idPenjualan']    =   $idPenjualan;

            if($idPenjualan === false){
                $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
                $data['subtitle_small'] = 'List Penjualan Pending';
                $data['page'] = 'penjualan-pending';            
                $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
     
                $this->themes->Display('penjualan/penjualanPending', $data);
            }else{
                $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
                $data['subtitle_small'] = 'Cek Item Penjualan Pending';
                $data['page'] = 'cek-item-penjualan';            
                $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
                
                $this->db->where('idPenjualan', $idPenjualan);
                $itemPenjualan  =   $this->db->get('view_penjualan_item')->result_array();
                $data['itemPenjualan']  =   $itemPenjualan;

                $this->db->select('statusPenjualan');
                $this->db->where('id', $idPenjualan);
                $detailPenjualan    =   $this->db->get('view_penjualan');
                $data['detailPenjualan']    =   $detailPenjualan;
     
                $this->themes->Display('penjualan/cekItemPenjualan', $data);
            }
        }
        public function pengecekanSelesai($idPenjualan = false){
            if($idPenjualan !== false){
                $statusPenyelesaian =   false;

                if(isset($_POST['itemPenjualan'])){
                    $itemChecked    =   $_POST['itemPenjualan'];

                    foreach($itemChecked as $itemPenjualan){
                        $this->db->select('idProduk, quantity');
                        $this->db->where('idPenjualan', $idPenjualan);
                        $this->db->where('idProduk', $itemPenjualan);
                        $isProductExist     =   $this->db->get('tbl_penjualan_item');

                        if($isProductExist->num_rows() >= 1){
                            $produk     =   $isProductExist->row_array();

                            $idProduk   =   $produk['idProduk'];
                            $jumlahJual =   $produk['quantity'];

                            $this->db->select('stok');
                            $this->db->where('id', $idProduk);
                            $detailProduk   =   $this->db->get('tbl_spare_part')->row();

                            $stokBaru       =   $detailProduk->stok - $jumlahJual;
                            $this->db->where('id', $idProduk);
                            $tambahStok     =   $this->db->update('tbl_spare_part', ['stok' => $stokBaru]);

                            $this->db->where('idPenjualan', $idPenjualan);
                            $this->db->where('idProduk', $itemPenjualan);
                            $updateProdukAda     =   $this->db->update('tbl_penjualan_item', ['produkAda' => 1]);
                        }
                    }
                }

                $this->db->where('id', $idPenjualan);
                $pengecekanSelesai  =   $this->db->update('tbl_penjualan', ['statusPenjualan' => 'selesai']);
                
                $statusPenyelesaian =   ($pengecekanSelesai)? true : false;

                echo json_encode(['statusPenyelesaian' => $statusPenyelesaian]);
            }
        }
        public function cetakSuratJalan($idPenjualan){
            $this->load->library('pdf');
            $this->pdf->setPaper('a4', 'landscape');

            $dataPDF    =   ['idPenjualan' => $idPenjualan];

            $this->pdf->load_view('penjualan/suratJalan', $dataPDF);
        }
        public function exportDetailPenjualan($exportTo = 'pdf', $idPenjualan = false){
            $exportTo   =   trim(strtolower($exportTo));
            
            $detailPenjualan    =   false;
            
            if($idPenjualan !== false){
                $this->db->where('id', $idPenjualan);
                $getDetailPenjualan    =   $this->db->get('view_penjualan');

                if($getDetailPenjualan->num_rows() >= 1){
                    $detailPenjualan    =   $getDetailPenjualan->row();
                }
            }

            $dataPDF['detailPenjualan']    =   $detailPenjualan;

            if($exportTo === 'pdf'){
                $this->load->library('pdf');
                $this->pdf->setPaper('A4', 'landscape');

                $this->pdf->load_view('penjualan/exportDetailPenjualan', $dataPDF);
            }
        }
        public function pembayaran($idPenjualan = false){
            $authRole  = $this->session->userdata('roleuser');

            $data['idPenjualan']    =   $idPenjualan;

            if($idPenjualan === false){
                $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
                $data['subtitle_small'] = 'List Penjualan Selesai';
                $data['page'] = 'penjualan-selesai';            
                $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
     
                $this->themes->Display('penjualan/penjualanSelesai', $data);
            }else{
                $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
                $data['subtitle_small'] = 'Pembayaran Penjualan Selesai';
                $data['page'] = 'pembayaran-penjualan-selesai';            
                $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
                
                $this->db->where('idPenjualan', $idPenjualan);
                $itemPenjualan  =   $this->db->get('view_penjualan_item')->result_array();
                $data['itemPenjualan']  =   $itemPenjualan;

                $this->db->where('id', $idPenjualan);
                $detailPenjualan    =   $this->db->get('view_penjualan');
                $data['detailPenjualan']    =   $detailPenjualan;
     
                $this->db->select('sum(totalHarga) as grandTotal');
                $this->db->where('idPenjualan', $idPenjualan);
                $grandTotal  =   $this->db->get('view_penjualan_item')->row()->grandTotal;
                $data['grandTotal'] =   $grandTotal;   

                $this->themes->Display('penjualan/pembayaranPenjualanSelesai', $data);
            }
        }
        public function lunas($idPenjualan = false){
            if($idPenjualan !== false){
                $statusPelunasan    =   false;

                $diskon         =   $this->input->post('diskon');
                $tunai          =   $this->input->post('bayar');

                $this->db->select('totalBelanja');
                $this->db->where('id', $idPenjualan);
                $totalBelanja    =   $this->db->get('view_penjualan')->row()->totalBelanja;

                $totalBelanjaBersih     =   $totalBelanja - $diskon;
                if($tunai >= $totalBelanjaBersih){
                    $dataPelunasan  =   [
                        'diskon'    =>  $diskon,
                        'tunai'     =>  $tunai,
                        'statusPenjualan'   =>  'lunas'
                    ];

                    $this->db->where('id', $idPenjualan);
                    $pelunasanPenjualan =   $this->db->update('tbl_penjualan', $dataPelunasan);

                    if($pelunasanPenjualan){
                        $statusPelunasan    =   true;
                    }
                }

                echo json_encode(['statusPelunasan' => $statusPelunasan]);
            }
        }
    }