<?php 
    if(!defined('BASEPATH')) exit ('no file allowed');

    class Supplier extends CI_Controller{
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
            $data['subtitle_small'] = 'Data Supplier';
            $data['page'] = 'supplier';            
            $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
 
            $this->themes->Display('supplier/index', $data); 
        }
        public function listDataSupplier(){
            $select         =   '*';
            $selectParams   =   $this->input->get('select');

            if(!is_null($selectParams)){
                $select     =   trim($selectParams);
            }

            $this->db->select($select);
            $this->db->order_by('id', 'desc');
            $listDataSupplier   =   $this->db->get('tbl_vendor');

            echo json_encode(['data' => $listDataSupplier->result_array()]);
        }
        public function autocompleteSupplier(){
            $select         =   '*';
            $selectParams   =   $this->input->get('select');
            $termParams     =   $this->input->get('term');

            if(!is_null($selectParams)){
                $select     =   trim($selectParams);
            }

            $this->db->select($select);
            $this->db->like('nama', $termParams);
            $this->db->or_like('lamanWeb', $termParams);
            $this->db->or_like('email', $termParams);
            $this->db->or_like('telepon', $termParams);
            $this->db->order_by('id', 'desc');
            $listDataSupplier   =   $this->db->get('tbl_vendor');
            
            echo json_encode($listDataSupplier->result_array());
        }
        public function addSupplier($idSupplier = false){
            $dataUser = $this->session->userdata('userdata')[0];            	
            $authRole  = $this->session->userdata('roleuser');

            $data['subtitle']       =   ucwords(str_replace('_', ' ', $authRole));                 
            $data['subtitle_small'] =   ($idSupplier === false)? 'Add New Supplier' : 'Edit Data Supplier';
            $data['page']   =   ($idSupplier === false)? 'add-supplier' : 'edit-supplier';            
            $data['allow']  =   $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
            $data['detailSupplier'] =   false;

            if($idSupplier !== false){
                $detailSupplier     =   $this->db->get_where('tbl_vendor', ['id' => $idSupplier]);
                if($detailSupplier->num_rows() >= 1){
                    $detailSupplier     =   $detailSupplier->row();
                    $data['detailSupplier'] =   $detailSupplier;
                }
            }
 
            $this->themes->Display('supplier/add-supplier', $data);
        }
        public function saveSupplier($idSupplier = false){
            $nama       =   $this->input->post('nama');
            $alamat     =   $this->input->post('alamat');
            $telepon    =   $this->input->post('telepon');
            $email      =   $this->input->post('email');
            $lamanWeb   =   $this->input->post('lamanWeb');

            $dataSupplier   =   [
                'nama'      =>  $nama,
                'alamat'    =>  $alamat,
                'telepon'   =>  $telepon,
                'email'     =>  $email,
                'lamanWeb'  =>  $lamanWeb
            ];

            if($idSupplier === false){
                $saveSupplier   =   $this->db->insert('tbl_vendor', $dataSupplier);
            }else{
                $this->db->where('id', $idSupplier);
                $saveSupplier   =   $this->db->update('tbl_vendor', $dataSupplier);
            }

            echo json_encode(['saveSupplier' => $saveSupplier]);
        }
        public function deleteSupplier(){
            $idSupplier         =   $this->input->post('idSupplier');
            $deleteSupplier     =   false;

            if($idSupplier !== null){
                $this->db->where('id', $idSupplier);
                $deleteSupplier   =   $this->db->delete('tbl_vendor');
                
                $deleteSupplier =   ($deleteSupplier)? true : false;
            }

            echo json_encode(['deleteSupplier' => $deleteSupplier]);
        }
    }