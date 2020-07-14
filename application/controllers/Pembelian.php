<?php  
    if(!defined('BASEPATH')) exit ('no file allowed');
    class Pembelian extends CI_Controller{
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
            $data['subtitle_small'] = 'Pembelian';
            $data['page'] = 'pembelian';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
 
            $this->themes->Display('pembelian/index', $data);                	
        }   
        public function dataPembelian(){    
            $statusPembelian    =   $this->input->get('statusPembelian');

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
             
            if(!is_null($statusPembelian)){
                $this->db->where('statusBelanja', $statusPembelianSelected);
            }else{
                $this->db->where_in('statusBelanja', ['selesai', 'batal']);
            }

            $this->db->order_by('id', 'desc');
            $listDataPembelian   =   $this->db->get('view_pembelian');

            echo json_encode(['data' => $listDataPembelian->result_array()]);
        }
        public function detailPembelian($idPembelian = false){         	
            $authRole  = $this->session->userdata('roleuser');
            
            $detailPembelian    =   false;

            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'Detail Pembelian';
            $data['page'] = 'detail-pembelian';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
            
            if($idPembelian !== false){
                $this->db->where('id', $idPembelian);
                $getDetailPembelian    =   $this->db->get('view_pembelian');

                if($getDetailPembelian->num_rows() >= 1){
                    $detailPembelian    =   $getDetailPembelian->row();
                }
            }

            $data['detailPembelian']    =   $detailPembelian;

            $this->themes->Display('pembelian/detailPembelian', $data);
        } 
        public function createPembelianBaru(){            	
            $authRole  = $this->session->userdata('roleuser');

            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'Buat Pembelian Baru';
            $data['page'] = 'create-pembelian-baru';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
 
            $this->themes->Display('pembelian/createPembelianBaru', $data); 
        }
        public function pembelianPending(){            	
            $authRole  = $this->session->userdata('roleuser');

            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = 'List Pembelian Pending';
            $data['page'] = 'pembelian-pending';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
 
            $this->themes->Display('pembelian/pembelianPending', $data); 
        }
        public function lanjutkanPembelianPending($idPembelian = false){
            $authRole  = $this->session->userdata('roleuser');
    
            $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] = ($idPembelian === false)? 'Pembelian Baru' : 'Lanjutkan Pembelian Pending';
            $data['page'] = ($idPembelian === false)? 'pembelian-baru' : 'lanjutkan-pembelian-pending';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();  

            $sessionIDPembelian     =   $this->session->userdata('sessionIDPembelian');
            if($idPembelian === false && is_null($sessionIDPembelian)){
                $idBengkel  =   $this->session->userdata('idbengkel');
                $dataMasterPembelian    =   ['statusBelanja' =>  'start', 'idBengkel' => $idBengkel];
                $insertMasterPembelian  =   $this->db->insert('tbl_pembelian', $dataMasterPembelian);

                $idPembelian    =   $this->db->insert_id();
                $this->session->set_userdata('sessionIDPembelian', $idPembelian);
            }

            if($idPembelian === false && !is_null($sessionIDPembelian)){
                $idPembelian    =   $sessionIDPembelian;
            }

            $this->db->select('sum(totalHarga) as grandTotal');
            $this->db->where('idPembelian', $idPembelian);
            $grandTotal  =   $this->db->get('view_pembelian_item')->row()->grandTotal;
            $data['grandTotal'] =   $grandTotal;    
        
            $this->db->where('idPembelian', $idPembelian);
            $itemPembelian  =   $this->db->get('view_pembelian_item')->result_array();
            $data['itemPembelian']  =   $itemPembelian;

            $this->db->select('statusBelanja');
            $this->db->where('id', $idPembelian);
            $detailPembelian    =   $this->db->get('view_pembelian');
            $data['detailPembelian']    =   $detailPembelian;
            
            $data['idPembelian'] =   $idPembelian;

            $this->themes->Display('pembelian/pilihProduk', $data); 
        }
        public function tambahItemPembelian(){
            $idPembelian    =   $this->input->post('idPembelian');
            $idProduk       =   $this->input->post('idProduk');

            $statusTambahItem   =   false;
            if(!is_null($idPembelian) && !is_null($idProduk)){
                $jumlahTambah   =   $this->input->post('jumlahTambah');
                $jumlahTambah   =   (is_null($jumlahTambah))? 1 : trim($jumlahTambah);

                $this->db->where('idPembelian', $idPembelian);
                $this->db->where('idProduk', $idProduk);
                $isProductExist     =   $this->db->get('view_pembelian_item');

                if($isProductExist->num_rows() >= 1){
                    $detailItem   =   $isProductExist->row();

                    $quantity   =   $detailItem->quantity;
                    $quantityBaru   =   $quantity + $jumlahTambah;

                    $this->db->where('idPembelian', $idPembelian);
                    $this->db->where('idProduk', $idProduk);
                    $tambahItemPembelian     =   $this->db->update('tbl_pembelian_item', ['quantity' => $quantityBaru]);
                }else{
                    $this->db->select('harga_beli as hargaBeli');
                    $this->db->where('id', $idProduk);
                    $detailProduk   =   $this->db->get('tbl_spare_part')->row();

                    $dataItemBaru   =   [
                        'idPembelian'   =>  $idPembelian,
                        'idProduk'      =>  $idProduk,
                        'harga'         =>  $detailProduk->hargaBeli,
                        'diskon'        =>  0,
                        'quantity'      =>  $jumlahTambah
                    ];
                    $tambahItemPembelian    =   $this->db->insert('tbl_pembelian_item', $dataItemBaru);
                }

                $statusTambahItem   =   ($tambahItemPembelian)? true : false;

                echo json_encode(['statusTambahItem' => $statusTambahItem]);
            }
        }
        public function hapusItemPembelian(){
            $idPembelian    =   $this->input->post('idPembelian');
            $idProduk       =   $this->input->post('idProduk');

            $statusHapusItem   =   false;
            if(!is_null($idPembelian) && !is_null($idProduk)){
                $this->db->where('idPembelian', $idPembelian);
                $this->db->where('idProduk', $idProduk);
                $hapusItem     =   $this->db->delete('tbl_pembelian_item');

                $statusHapusItem    =   ($hapusItem)? true : false;

                echo json_encode(['statusHapusItem' => $statusHapusItem]);
            }
        }
        public function batalkanPembelian(){
            $idPembelian    =   $this->input->post('idPembelian');

            $statusBatalkanPembelian   =   false;
            if(!is_null($idPembelian)){
                $this->db->where('id', $idPembelian);
                $batalkanPembelian     =   $this->db->update('tbl_pembelian', ['statusBelanja' => 'batal']);

                $statusBatalkanPembelian    =   ($batalkanPembelian)? true : false;

                $sessionIDPembelian =   $this->session->userdata('sessionIDPembelian');
                if(!is_null($sessionIDPembelian)){
                    $this->session->unset_userdata('sessionIDPembelian');
                }
                
                echo json_encode(['statusBatalkanPembelian' => $statusBatalkanPembelian]);
            }
        }
        public function selesaikanPembelian(){
            $idPembelian    =   $this->input->post('idPembelian');
            $idVendor       =   $this->input->post('idVendor');
            $tunai          =   $this->input->post('tunai');

            $statusSelesaikanPembelian  =   false;
            $statusTambahStokProduk     =   false;
            if(!is_null($idPembelian) && !is_null($idVendor) && !is_null($tunai)){
                
                $this->db->select('totalBelanja');
                $this->db->where('id', $idPembelian);
                $totalBelanja    =   $this->db->get('view_pembelian')->row()->totalBelanja;

                if($tunai >= $totalBelanja){
                    $stringVendor   =   str_pad($idVendor, 5, 0, STR_PAD_LEFT);
                    $stringID       =   str_pad($idPembelian, 4, 0, STR_PAD_LEFT);

                    $nomorTransaksi     =   'B'.$stringVendor.$stringID;
                    $dataPenyelesaian   =   [
                        'statusBelanja'     =>  'pending',
                        'idVendor'          =>  $idVendor,
                        'tunai'             =>  $tunai,
                        'nomorTransaksi'    =>  $nomorTransaksi
                    ];

                    $this->db->where('id', $idPembelian);
                    $selesaikanPembelian        =   $this->db->update('tbl_pembelian', $dataPenyelesaian);

                    $statusSelesaikanPembelian  =   ($selesaikanPembelian)? true : false;
                    
                    $sessionIDPembelian =   $this->session->userdata('sessionIDPembelian');
                    if(!is_null($sessionIDPembelian)){
                        $this->session->unset_userdata('sessionIDPembelian');
                    }
                }

                echo json_encode(['statusSelesaikanPembelian' => $statusSelesaikanPembelian]);
            }
        }
        function cekItem($idPembelian = false){
            if($idPembelian !== false){         	
                $authRole   =   $this->session->userdata('roleuser');

                $idbengkel  =   $this->session->userdata('idbengkel');
                $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
                $data['subtitle_small'] = 'Cek Item Pembelian';
                $data['page'] = 'cek-item-pembelian';            
                $data['allow'] = $this->db->get_where('tbl_batasan_akses', ['role' => $authRole])->row();
                $data['idPembelian']    =   $idPembelian;
    
                $this->themes->Display('pembelian/cekItemPembelian', $data);    
            }
        }
        public function pengecekanSelesai($idPembelian = false){
            if($idPembelian !== false){
                $statusPenyelesaian =   false;

                if(isset($_POST['item'])){
                    $itemChecked    =   $_POST['item'];

                    foreach($itemChecked as $itemBelanja){
                        $this->db->select('idProduk, quantity');
                        $this->db->where('idPembelian', $idPembelian);
                        $this->db->where('idProduk', $itemBelanja);
                        $isProductExist     =   $this->db->get('tbl_pembelian_item');

                        if($isProductExist->num_rows() >= 1){
                            $produk     =   $isProductExist->row_array();

                            $idProduk   =   $produk['idProduk'];
                            $jumlahBeli =   $produk['quantity'];

                            $this->db->select('stok');
                            $this->db->where('id', $idProduk);
                            $detailProduk   =   $this->db->get('tbl_spare_part')->row();

                            $stokBaru       =   $detailProduk->stok + $jumlahBeli;
                            $this->db->where('id', $idProduk);
                            $tambahStok     =   $this->db->update('tbl_spare_part', ['stok' => $stokBaru]);

                            $this->db->where('idPembelian', $idPembelian);
                            $this->db->where('idProduk', $itemBelanja);
                            $updateProdukAda     =   $this->db->update('tbl_pembelian_item', ['produkAda' => 1]);
                        }
                    }
                }

                $this->db->where('id', $idPembelian);
                $pengecekanSelesai  =   $this->db->update('tbl_pembelian', ['statusBelanja' => 'selesai']);
                
                $statusPenyelesaian =   ($pengecekanSelesai)? true : false;

                echo json_encode(['statusPenyelesaian' => $statusPenyelesaian]);
            }
        }
        public function cetakSuratJalan($idPembelian){
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'landscape');

            $dataPDF    =   ['idPembelian' => $idPembelian];

            $this->pdf->load_view('pembelian/suratJalan', $dataPDF);
        }
        public function exportDetailPembelian($exportTo = 'pdf', $idPembelian = false){
            $exportTo   =   trim(strtolower($exportTo));
            
            $detailPembelian    =   false;
            
            if($idPembelian !== false){
                $this->db->where('id', $idPembelian);
                $getDetailPembelian    =   $this->db->get('view_pembelian');

                if($getDetailPembelian->num_rows() >= 1){
                    $detailPembelian    =   $getDetailPembelian->row();
                }
            }

            $dataPDF['detailPembelian']    =   $detailPembelian;

            if($exportTo === 'pdf'){
                $this->load->library('pdf');
                $this->pdf->setPaper('A4', 'landscape');

                $this->pdf->load_view('pembelian/exportDetailPembelian', $dataPDF);
            }
        }
    }