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
            $statusPenjualanSelected    =   (!is_null($statusPenjualan))? trim($statusPenjualan) : 'selesai'; 

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

            $this->db->where('statusPenjualan', $statusPenjualanSelected);
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
                $dataMasterPenjualan    =   ['statusPenjualan' =>  'pending', 'idBengkel' => $idBengkel];
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
            $diskon         =   $this->input->post('diskon');
            $tunai          =   $this->input->post('tunai');

            $statusSelesaikanPenjualan      =   false;
            $statusKurangiStokProduk        =   false;
            if(!is_null($idPenjualan) && !is_null($tunai)){
                $diskon     =   (is_null($diskon))? 0 : $diskon;

                $this->db->select('totalBelanja');
                $this->db->where('id', $idPenjualan);
                $totalBelanja    =   $this->db->get('view_penjualan')->row()->totalBelanja;

                $totalBelanja   =   $totalBelanja - $diskon;

                if($tunai >= $totalBelanja){
                    $stringID       =   str_pad($idPenjualan, 4, 0, STR_PAD_LEFT);

                    $nomorTransaksi     =   'J'.$stringID;
                    $dataPenyelesaian   =   [
                        'statusPenjualan'   =>  'selesai',
                        'diskon'            =>  $diskon,
                        'tunai'             =>  $tunai,
                        'nomorTransaksi'    =>  $nomorTransaksi
                    ];

                    $this->db->where('id', $idPenjualan);
                    $selesaikanPenjualan        =   $this->db->update('tbl_penjualan', $dataPenyelesaian);

                    $this->db->select('idProduk, quantity');
                    $this->db->where('idPenjualan', $idPenjualan);
                    $listProduk     =   $this->db->get('tbl_penjualan_item');

                    if($listProduk->num_rows() >= 1){
                        $kurangiStokBerhasil     =   0;
                        $kurangiStokDone         =   0;
                        foreach($listProduk->result_array() as $indexData => $produk){
                            $idProduk   =   $produk['idProduk'];
                            $jumlahJual =   $produk['quantity'];

                            $this->db->select('stok');
                            $this->db->where('id', $idProduk);
                            $detailProduk   =   $this->db->get('tbl_spare_part')->row();

                            $stokBaru       =   $detailProduk->stok - $jumlahJual;
                            $this->db->where('id', $idProduk);
                            $kurangiStok     =   $this->db->update('tbl_spare_part', ['stok' => $stokBaru]);

                            if($kurangiStok){
                                $kurangiStokBerhasil++;
                            }
                            $kurangiStokDone++;
                        }
                    }

                    $statusSelesaikanPenjualan  =   $kurangiStokBerhasil >= 1 && $kurangiStokDone >= 1 && $kurangiStokBerhasil === $kurangiStokDone && $selesaikanPenjualan;
                    
                    $sessionIDPenjualan =   $this->session->userdata('sessionIDPenjualan');
                    if(!is_null($sessionIDPenjualan)){
                        $this->session->unset_userdata('sessionIDPenjualan');
                    }
                }

                echo json_encode(['statusSelesaikanPenjualan' => $statusSelesaikanPenjualan]);
            }
        }
    }