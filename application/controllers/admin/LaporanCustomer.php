<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class LaporanCustomer  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
    }
    
    public function index(){
        $authRole = $this->session->userdata('roleuser');
        $idbengkel = $this->session->userdata('idbengkel');        
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['subtitle_small'] = 'Laporan Pelanggan';
        $data['page'] = 'laporan_customer';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->themes->Display('admin/laporan-customer/laporan-customer', $data);                                           
    }    

    public function view(){
        $idbengkel  = $this->session->userdata('idbengkel'); 

        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');  

        $this->db->distinct('email_pemilik');
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);

            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;

                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
        $this->db->where([
            'email_pemilik !='  =>  "",
            'id_bengkel'        =>  $idbengkel
        ]);

        $data['data'] = $this->db->get('tbl_penerimaan')->result_array();                    
        echo json_encode($data);        
    }
    public function customerExport($exportTo = 'pdf'){
        $exportTo   =   strtolower($exportTo);

        $idBengkel  = $this->session->userdata('idbengkel'); 
        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');
        
        if(!is_null($column) && !is_null($start) && !is_null($end)){
            $start  =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
            $end  =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;

            if($column === 'tgl_penerimaan'){
                $columnTD   =   'Tanggal Penerimaan';
            }else if($column === 'tgl_transaksi'){
                $columnTD   =   'Tanggal Transaksi';
            }else if($column === 'kilometer'){
                $columnTD   =   'Kilo Meter';
            }else if($column === 'tahun_produksi'){
                $columnTD   = 'Tahun Produksi';
            }else{
                $columnTD   =   '';
            }

            $startTD    =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($start)) : $start;
            $endTD      =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($end)) : $end;

            $this->db->where($column.' >=', $start);
            $this->db->where($column.' <=', $end);
        }
        
        $this->db->where([
            'email_pemilik !='  =>  "",
            'id_bengkel'        =>  $idBengkel
        ]);

        $listCustomer   =   $this->db->get('view_data_penerimaan')->result_array();

        if($exportTo === 'pdf'){
            $this->load->library('pdf');

            $dataPDF   =   [
                'listCustomer'  =>  $listCustomer,
                'column'    =>  $column,
                'start'     =>  $start,
                'end'       =>  $end
            ];
    
            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $dataPDF['columnTD']   =   $columnTD;
                $dataPDF['startTD']   =   $startTD;
                $dataPDF['endTD']   =   $endTD;
            }

            $this->pdf->load_view('admin/laporan-customer/pdf/customer', $dataPDF);
        }

        if($exportTo === 'excel'){
            $this->load->model('ExcelExportData', 'export');
            $title      =   false;
            $header     =   false;
            $fileName   =   'LaporanCustomer.xls';

            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $fileName   =   'LaporanCustomer_Parameter_'.$columnTD.'_'.$startTD.' sd '.$endTD.'.xls';
            }                        

            $kolom      =   ['No.', 'Nama', 'Telepon', 'Email', 'Admin'];
            if(!is_null($column)){
                array_push($kolom, $columnTD);
            }
            $dataArray  =   [];

            foreach($listCustomer as $indexData => $customer){
                $rowData    =   [
                    $indexData+1,
                    $customer['nama_pemilik'],
                    $customer['telepon_pemilik'],
                    $customer['email_pemilik'],
                    strtoupper($customer['admin'])
                ];

                if(!is_null($column)){ 
                    array_push($rowData, $customer[$column]);
                }

                array_push($dataArray, $rowData);
            }

            $this->export->exportToExcel($title, $header, $kolom, $dataArray, $fileName);
        }
    }
}

