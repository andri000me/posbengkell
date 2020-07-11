<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class LaporanUnit  extends CI_Controller{
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
        $data['subtitle_small'] = 'Laporan Unit (Harian)';
        $data['page'] = 'laporan_unit';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->themes->Display('admin/laporan-unit/laporan-unit', $data);                                           
    }    

    public function view(){
        $idbengkel = $this->session->userdata('idbengkel'); 
        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');  

        $this->db->select("*, count(*) as unit");
               
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);

            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;

                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }

        $this->db->group_by(array("DATE(tgl_transaksi)"));        
        $perintah_kerja = $this->db->get_where('view_perintah_kerja', ['id_bengkel' => $idbengkel, 'status' => 3])->result_array();
        
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);

            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;

                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
        $perintah_kerja_2 = $this->db->get_where('view_perintah_kerja', ['id_bengkel' => $idbengkel, 'status' => 3])->result_array();

        foreach ($perintah_kerja_2 as $key => $value) {
            $this->db->select('harga_jual');
            $this->db->select('harga_beli');
            $this->db->select('qty');
            $this->db->select('harga_jual - harga_beli as laba', FALSE);            
            $data_laba_sparepart    = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja' => $value['id'] ])->result_array();
            $data_uraian_pekerjaan  = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja' => $value['id'] ])->result_array();
            
            $count_laba =0;     
            $count_cost =0;     
            $count_omzet =0;        
            $count_biaya_pekerjaan =0;      

            $revenue_sparepart =0;     
            $revenue_service = 0;
            $cost_sparepart =0;        
            $cost_service = 0; 
            
            foreach ($data_laba_sparepart as $key2 => $value2) {
                // $count_laba += $value2['laba'] * $value2['qty'];
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

            $perintah_kerja_2[$key]['cost_sparepart']       = $cost_sparepart;
            $perintah_kerja_2[$key]['cost_service']         = $cost_service;         
            $perintah_kerja_2[$key]['revenue_sparepart']    = $revenue_sparepart;
            $perintah_kerja_2[$key]['revenue_service']      = $revenue_service;         
            $perintah_kerja_2[$key]['total_revenue']        = $revenue_service + $revenue_sparepart;            

            $perintah_kerja_2[$key]['detil_sparepart']= $data_laba_sparepart;
            $perintah_kerja_2[$key]['detil_pekerjaan']= $data_uraian_pekerjaan;           
        }        


        foreach ($perintah_kerja as $key => $value) {
            $cost_sparepart =0;        
            $cost_service = 0; 
            $revenue_sparepart =0;     
            $revenue_service = 0;
            $total_revenue = 0;

            $diskon_service = 0;
            $diskon_sparepart = 0;

            foreach ($perintah_kerja_2 as $key_2 => $value_2) {            
                if (date("Y-m-d", strtotime($value_2['tgl_transaksi'])) == date("Y-m-d", strtotime($value['tgl_transaksi']))) {
                    $cost_sparepart += $perintah_kerja_2[$key_2]['cost_sparepart'];
                    $revenue_sparepart += $perintah_kerja_2[$key_2]['revenue_sparepart'];
                    $cost_service += $perintah_kerja_2[$key_2]['cost_service'];
                    $revenue_service += $perintah_kerja_2[$key_2]['revenue_service'];
                    $total_revenue += $perintah_kerja_2[$key_2]['total_revenue'];
                    $diskon_service += $perintah_kerja_2[$key_2]['diskon_service'];
                    $diskon_sparepart += $perintah_kerja_2[$key_2]['diskon_sparepart'];
                }
            }
            $perintah_kerja[$key]['cost_sparepart']     = $cost_sparepart;            
            $perintah_kerja[$key]['revenue_sparepart']  = $revenue_sparepart;            
            $perintah_kerja[$key]['revenue_service']    = $revenue_service;
            $perintah_kerja[$key]['cost_service']       = $cost_service;            
            $perintah_kerja[$key]['total_revenue']      = $total_revenue;            
            $perintah_kerja[$key]['profit_sparepart']   = $revenue_sparepart - ($revenue_sparepart * $value['diskon_sparepart'] / 100) - $cost_sparepart;            
            $perintah_kerja[$key]['profit_service']     = $revenue_service - ($revenue_service * $value['diskon_service'] / 100) -  $cost_service;            
            $perintah_kerja[$key]['total_profit']       = $perintah_kerja[$key]['profit_sparepart'] + $perintah_kerja[$key]['profit_service'];                        
            $perintah_kerja[$key]['diskon_service']     = $diskon_service;            
            $perintah_kerja[$key]['diskon_sparepart']   = $diskon_sparepart;          
        }


        $data['data'] = $perintah_kerja;        
        echo json_encode($data);       

    }
    public function export($exportTo = 'pdf'){
        $exportTo   =   strtolower($exportTo);
        $idbengkel  =   $this->session->userdata('idbengkel'); 

        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');  
    
        $this->db->select("*, count(*) as unit");
         
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);
    
            if($column === 'tgl_jam_appointment'){
                $columnTD   =   'Tanggal Jam Appointment';
            }else if($column === 'tgl_transaksi'){
                $columnTD   =   'Tanggal Transaksi';
            }else if($column === 'tgl_jam_penyerahan'){
                $columnTD   =   'Tanggal Transaksi';
            }else{
                $columnTD   =   '';
            }
    
            $startTD    =   ($column === 'tgl_jam_penyerahan' || $column === 'tgl_jam_appointment' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($start)) : $start;
            $endTD      =   ($column === 'tgl_jam_penyerahan' || $column === 'tgl_jam_appointment' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($end)) : $end;
    
            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;
    
                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
    
        $this->db->group_by(array("DATE(tgl_transaksi)"));        
        $perintah_kerja = $this->db->get_where('view_perintah_kerja', ['id_bengkel' => $idbengkel, 'status' => 3])->result_array();
        
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);
    
            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tg_jam_appointment' || $column === 'tgl_jam_penyerahan' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;
    
                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
        $perintah_kerja_2 = $this->db->get_where('view_perintah_kerja', ['id_bengkel' => $idbengkel, 'status' => 3])->result_array();
    
        foreach ($perintah_kerja_2 as $key => $value) {
            $this->db->select('harga_jual');
            $this->db->select('harga_beli');
            $this->db->select('qty');
            $this->db->select('harga_jual - harga_beli as laba', FALSE);            
            $data_laba_sparepart    = $this->db->get_where('view_transaksi_sparepart', ['id_perintah_kerja' => $value['id'] ])->result_array();
            $data_uraian_pekerjaan  = $this->db->get_where('tbl_uraian_pekerjaan', ['id_perintah_kerja' => $value['id'] ])->result_array();
            
            $count_laba =0;     
            $count_cost =0;     
            $count_omzet =0;        
            $count_biaya_pekerjaan =0;      
    
            $revenue_sparepart =0;     
            $revenue_service = 0;
            $cost_sparepart =0;        
            $cost_service = 0; 
            
            foreach ($data_laba_sparepart as $key2 => $value2) {
                // $count_laba += $value2['laba'] * $value2['qty'];
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
    
            $perintah_kerja_2[$key]['cost_sparepart']       = $cost_sparepart;
            $perintah_kerja_2[$key]['cost_service']         = $cost_service;         
            $perintah_kerja_2[$key]['revenue_sparepart']    = $revenue_sparepart;
            $perintah_kerja_2[$key]['revenue_service']      = $revenue_service;         
            $perintah_kerja_2[$key]['total_revenue']        = $revenue_service + $revenue_sparepart;            
    
            $perintah_kerja_2[$key]['detil_sparepart']= $data_laba_sparepart;
            $perintah_kerja_2[$key]['detil_pekerjaan']= $data_uraian_pekerjaan;           
        }        
    
        foreach ($perintah_kerja as $key => $value) {
            $cost_sparepart =0;        
            $cost_service = 0; 
            $revenue_sparepart =0;     
            $revenue_service = 0;
            $total_revenue = 0;
    
            $diskon_service = 0;
            $diskon_sparepart = 0;
    
            foreach ($perintah_kerja_2 as $key_2 => $value_2) {            
                if (date("Y-m-d", strtotime($value_2['tgl_transaksi'])) == date("Y-m-d", strtotime($value['tgl_transaksi']))) {
                    $cost_sparepart += $perintah_kerja_2[$key_2]['cost_sparepart'];
                    $revenue_sparepart += $perintah_kerja_2[$key_2]['revenue_sparepart'];
                    $cost_service += $perintah_kerja_2[$key_2]['cost_service'];
                    $revenue_service += $perintah_kerja_2[$key_2]['revenue_service'];
                    $total_revenue += $perintah_kerja_2[$key_2]['total_revenue'];
                    $diskon_service += $perintah_kerja_2[$key_2]['diskon_service'];
                    $diskon_sparepart += $perintah_kerja_2[$key_2]['diskon_sparepart'];
                }
            }
            $perintah_kerja[$key]['cost_sparepart']     = $cost_sparepart;            
            $perintah_kerja[$key]['revenue_sparepart']  = $revenue_sparepart;            
            $perintah_kerja[$key]['revenue_service']    = $revenue_service;
            $perintah_kerja[$key]['cost_service']       = $cost_service;            
            $perintah_kerja[$key]['total_revenue']      = $total_revenue;            
            $perintah_kerja[$key]['profit_sparepart']   = $revenue_sparepart - ($revenue_sparepart * $value['diskon_sparepart'] / 100) - $cost_sparepart;            
            $perintah_kerja[$key]['profit_service']     = $revenue_service - ($revenue_service * $value['diskon_service'] / 100) -  $cost_service;            
            $perintah_kerja[$key]['total_profit']       = $perintah_kerja[$key]['profit_sparepart'] + $perintah_kerja[$key]['profit_service'];                        
            $perintah_kerja[$key]['diskon_service']     = $diskon_service;            
            $perintah_kerja[$key]['diskon_sparepart']   = $diskon_sparepart;          
        }
    
        $data['data'] = $perintah_kerja; 

        $dataUnit   =   [
            'dataUnit'  =>  $data['data'],
            'column'    =>  $column,
            'start'     =>  $start,
            'end'       =>  $end
        ];

        if(!is_null($column) && !is_null($start) && !is_null($end)){
            $dataUnit['columnTD']   =   $columnTD;
            $dataUnit['startTD']   =   $startTD;
            $dataUnit['endTD']   =   $endTD;
        }

        if($exportTo === 'pdf'){
            $this->load->library('pdf');
            $this->pdf->setPaper('legal', 'landscape');
            $this->pdf->load_view('admin/laporan-customer/pdf/unit', $dataUnit);
        }
        if($exportTo === 'excel'){
            $this->load->model('ExcelExportData', 'export');
            $title      =   false;
            $header     =   false;
            $fileName   =   'LaporanUnit.xls';

            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $fileName   =   'LaporanUnit_Parameter_'.$columnTD.'_'.$startTD.' sd '.$endTD.'.xls';
            }                        
	                                  
            $kolom      =   ['Tanggal Transaksi', 'Unit', 'Cost Sparepart', 'Cost Service', 'Revenue Sparepart', 'Revenue Service', 'Total Revenue', 'Diskon Sparepart', 'Diskon Service', 'Profit Sparepart', 'Profit Service', 'Total Profit'];
            $dataArray  =   [];

            foreach($data['data'] as $dataUnit){
                $rowData    =   [
                    $dataUnit['tgl_transaksi'], $dataUnit['unit'], $dataUnit['cost_sparepart'], $dataUnit['revenue_sparepart'], 
                    $dataUnit['revenue_service'], $dataUnit['total_revenue'], $dataUnit['diskon_sparepart'].'%',
                    $dataUnit['diskon_service'].'%', $dataUnit['profit_sparepart'], $dataUnit['profit_service'],
                    $dataUnit['total_profit']
                ];

                array_push($dataArray, $rowData);
            }

            $this->export->exportToExcel($title, $header, $kolom, $dataArray, $fileName);
        }
    }
}