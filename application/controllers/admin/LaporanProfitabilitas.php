<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class LaporanProfitabilitas  extends CI_Controller{
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
        $data['subtitle_small'] = 'Laporan Profitabilitas';
        $data['page'] = 'laporan_profitabilitas';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->themes->Display('admin/laporan-profitabilitas/laporan-profitabilitas', $data);                                           
    }    

    public function view(){
        $idbengkel      = $this->session->userdata('idbengkel'); 

        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');       

        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);

            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tgl_jam_appointment' || $column === 'tgl_transaksi' || $column === 'tgl_jam_penyerahan')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tgl_jam_appointment' || $column === 'tgl_transaksi' || $column === 'tgl_jam_penyerahan')? $end.' 23:59:59' : $end;

                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
        $this->db->where(['id_bengkel' => $idbengkel, 'status' => 3]);
        $perintah_kerja = $this->db->get('view_perintah_kerja')->result_array();

        $data['data'] = [];

        foreach ($perintah_kerja as $key => $value){
            $this->db->select('harga_jual');
            $this->db->select('harga_beli');
            $this->db->select('qty');
            $this->db->select('harga_jual - harga_beli as laba', FALSE);            
            $data_laba_sparepart    = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja' => $value['id']])->result_array();

            $data_uraian_pekerjaan  = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja' => $value['id']])->result_array();
            
            $revenue_sparepart  =   0;      
            $cost_sparepart     =   0;     
            $cost_service       =   0;
            $revenue_service    =   0;
            
            foreach ($data_laba_sparepart as $key2 => $value2) {
                $cost_sparepart += $value2['harga_beli'] * $value2['qty'];
                $revenue_sparepart += $value2['harga_jual'] * $value2['qty'];               
            }

            foreach ($data_uraian_pekerjaan as $key2 => $value2) {
                $cost_service += $value2['biaya'];              
                if ($value2['tipe_keuntungan'] == 0) {
                    $revenue_service += $value2['biaya'] + ($value2['biaya'] * $value2['nilai_keuntungan'] / 100);
                }else{
                    $revenue_service += $value2['biaya'] + $value2['nilai_keuntungan'];                                
                }    
            }
            
            $perintah_kerja[$key]['revenue_service']    = $revenue_service;         
            $perintah_kerja[$key]['revenue_sparepart']  = $revenue_sparepart;
            $perintah_kerja[$key]['total_revenue']      = $revenue_service + $revenue_sparepart;

            $perintah_kerja[$key]['cost_service']       = $cost_service;
            $perintah_kerja[$key]['cost_sparepart']     = $cost_sparepart;
            $perintah_kerja[$key]['total_cost']         = $cost_service + $cost_sparepart;            

            $perintah_kerja[$key]['diskon_service']     = $value['diskon_service'];
            $perintah_kerja[$key]['diskon_sparepart']   = $value['diskon_sparepart'];

            $perintah_kerja[$key]['profit_service']     = $revenue_service - ($revenue_service * $value['diskon_service'] / 100) - $cost_service;
            $perintah_kerja[$key]['profit_sparepart']   = $revenue_sparepart - ($revenue_sparepart * $value['diskon_sparepart'] / 100) - $cost_sparepart;
            $perintah_kerja[$key]['total_profit']       = $perintah_kerja[$key]['profit_service'] + $perintah_kerja[$key]['profit_sparepart'];
            $perintah_kerja[$key]['detil']              = $data_laba_sparepart;
            
            $data['data'] = $perintah_kerja;
        }        

        echo json_encode($data);        

    }
    public function export($exportTo = 'pdf'){
        $exportTo   =   strtolower($exportTo);

        $idBengkel  = $this->session->userdata('idbengkel'); 

        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');       

        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);

            if($column === 'tgl_jam_appointment'){
                $columnTD   =   'Tanggal Jam Appointment';
            }else if($column === 'tgl_transaksi'){
                $columnTD   =   'Tanggal Transaksi';
            }else if($column === 'tgl_jam_penyerahan'){
                $columnTD   =   'Tanggal Jam Penyerahan';
            }else{
                $columnTD   =   '';
            }

            $startTD    =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($start)) : $start;
            $endTD      =   ($column === 'tgl_penerimaan' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($end)) : $end;

            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tgl_jam_appointment' || $column === 'tgl_transaksi' || $column === 'tgl_jam_penyerahan')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tgl_jam_appointment' || $column === 'tgl_transaksi' || $column === 'tgl_jam_penyerahan')? $end.' 23:59:59' : $end;

                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
        $this->db->where(['id_bengkel' => $idBengkel, 'status' => 3]);
        $perintah_kerja = $this->db->get('view_perintah_kerja')->result_array();

        $dataLengkap['data']    =   [];
                            
        foreach ($perintah_kerja as $key => $value){
            $this->db->select('harga_jual');
            $this->db->select('harga_beli');
            $this->db->select('qty');
            $this->db->select('harga_jual - harga_beli as laba', FALSE);            
            $data_laba_sparepart    = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja' => $value['id']])->result_array();

            $data_uraian_pekerjaan  = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja' => $value['id']])->result_array();
            
            $revenue_sparepart  =   0;      
            $cost_sparepart     =   0;     
            $cost_service       =   0;
            $revenue_service    =   0;
            
            foreach ($data_laba_sparepart as $key2 => $value2) {
                $cost_sparepart += $value2['harga_beli'] * $value2['qty'];
                $revenue_sparepart += $value2['harga_jual'] * $value2['qty'];               
            }

            foreach ($data_uraian_pekerjaan as $key2 => $value2) {
                $cost_service += $value2['biaya'];              
                if ($value2['tipe_keuntungan'] == 0) {
                    $revenue_service += $value2['biaya'] + ($value2['biaya'] * $value2['nilai_keuntungan'] / 100);
                }else{
                    $revenue_service += $value2['biaya'] + $value2['nilai_keuntungan'];                                
                }    
            }
            
            $perintah_kerja[$key]['revenue_service']    = $revenue_service;         
            $perintah_kerja[$key]['revenue_sparepart']  = $revenue_sparepart;
            $perintah_kerja[$key]['total_revenue']      = $revenue_service + $revenue_sparepart;

            $perintah_kerja[$key]['cost_service']       = $cost_service;
            $perintah_kerja[$key]['cost_sparepart']     = $cost_sparepart;
            $perintah_kerja[$key]['total_cost']         = $cost_service + $cost_sparepart;            

            $perintah_kerja[$key]['diskon_service']     = $value['diskon_service'];
            $perintah_kerja[$key]['diskon_sparepart']   = $value['diskon_sparepart'];

            $perintah_kerja[$key]['profit_service']     = $revenue_service - ($revenue_service * $value['diskon_service'] / 100) - $cost_service;
            $perintah_kerja[$key]['profit_sparepart']   = $revenue_sparepart - ($revenue_sparepart * $value['diskon_sparepart'] / 100) - $cost_sparepart;
            $perintah_kerja[$key]['total_profit']       = $perintah_kerja[$key]['profit_service'] + $perintah_kerja[$key]['profit_sparepart'];
            $perintah_kerja[$key]['detil']              = $data_laba_sparepart;

            $dataLengkap['data']    =   $perintah_kerja;
        }

        if($exportTo === 'pdf'){
            $this->load->library('pdf');
            $this->pdf->setPaper('legal', 'landscape');

            $dataPDF   =   [
                'dataLengkap'  =>  $dataLengkap['data'],
                'column'    =>  $column,
                'start'     =>  $start,
                'end'       =>  $end
            ];
    
            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $dataPDF['columnTD']   =   $columnTD;
                $dataPDF['startTD']   =   $startTD;
                $dataPDF['endTD']   =   $endTD;
            }

            $this->pdf->load_view('admin/laporan-customer/pdf/profitabilitas', $dataPDF);
        }

        if($exportTo === 'excel'){
            $this->load->model('ExcelExportData', 'export');
            $title      =   false;
            $header     =   false;
            $fileName   =   'LaporanProfitabilitas.xls';

            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $fileName   =   'LaporanProfitabilitas_Parameter_'.$columnTD.'_'.$startTD.' sd '.$endTD.'.xls';
            }                        

            $kolom      =   ["Id", "No. PKB", "No. Polisi", "Revenue Service", "Revenue Sparepart", "Total Revenue", "Cost Service", "Cost Sparepart", "Total Cost", "Discount Service", "Discount Sparepart", "Profit Service", "Profit Sparepart", "Total Profit"];
            $dataArray  =   [];

            foreach($dataLengkap['data'] as $row){
                $rowData    =   [
                    $row['id'],
                    $row['no_pkb'],
                    $row['no_polisi'],
                    $row['revenue_service'],
                    $row['revenue_sparepart'],   
                    $row['total_revenue'],      
                    $row['cost_service'],      
                    $row['cost_sparepart'],    
                    $row['total_cost'],       
                    $row['diskon_service'],    
                    $row['diskon_sparepart'],
                    $row['profit_service'],
                    $row['profit_sparepart'],
                    $row['total_profit'],
                ];

                array_push($dataArray, $rowData);
            }

            $this->export->exportToExcel($title, $header, $kolom, $dataArray, $fileName);
        }
    }
}