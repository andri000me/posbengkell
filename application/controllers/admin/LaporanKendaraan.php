<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class LaporanKendaraan  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		// isAuth();
    }
    
    public function index(){
        $authRole = $this->session->userdata('roleuser');
        $idbengkel = $this->session->userdata('idbengkel');        
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
        $data['subtitle_small'] = 'Laporan Kendaraan';
        $data['page'] = 'laporan_kendaraan';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->themes->Display('admin/laporan-kendaraan/laporan-kendaraan', $data);                                           
    }    

    public function view(){
        $idbengkel = $this->session->userdata('idbengkel'); 
        
        $column =   $this->input->get('column');
        $start  =   $this->input->get('start');
        $end    =   $this->input->get('end');

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

        $this->db->group_by('no_polisi');        
        $data['data'] = $this->db->get_where('tbl_penerimaan', [
                                            'no_polisi !=' => "",
                                            'id_bengkel' => $idbengkel])->result_array();
        echo json_encode($data);        

    }

    public function viewHistoryTransaction(){
        $no_polisi = $this->input->post('no_polisi');

        // $tanggalAwal    =   $this->input->get('tanggalAwal');
        // $tanggalAkhir   =   $this->input->get('tanggalAkhir');

        $whereRentangTanggal    =   '';
        // if(!is_null($tanggalAwal) && !is_null($tanggalAkhir)){
        //     $tanggalAwal    =   trim($tanggalAwal);
        //     $tanggalAkhir   =   trim($tanggalAkhir);

        //     if(strlen($tanggalAwal) >= 1 && strlen($tanggalAkhir) >= 1){
        //         $whereRentangTanggal    =   ' and (tgl_transaksi >= "'.$tanggalAwal.' 00:00:00" and tgl_transaksi <= "'.$tanggalAkhir.' 23:59:59")';
        //     }
        // }

        //dikomentari karena belum berfungsi, belum ada uinya
        
        $perintah_kerja = $this->db->query("SELECT * FROM view_perintah_kerja WHERE replace(no_polisi , ' ','')= '$no_polisi' ".$whereRentangTanggal)->result_array();
        $result = [];
        foreach ($perintah_kerja as $key => $value) {
            $trx_sparepart      = $this->db->get_where('view_transaksi_sparepart', [
                                                        'id_perintah_kerja' => $value['id']])->result_array();    
            
            $uraian_pekerjaan   = $this->db->get_where('view_data_service', [
                                                        'id_perintah_kerja' => $value['id']])->result_array();

            $jenis_services     = [];
            $revenue_service    = 0;
            foreach ($uraian_pekerjaan as $key2 => $value2) {
                $jenis_services[]   = $value2['jenis_service'];                
                if ($value2['tipe_keuntungan'] == 0) {
                    $revenue_service += $value2['biaya'] + ($value2['biaya'] * $value2['nilai_keuntungan'] / 100);
                }else{
                    $revenue_service += $value2['biaya'] + $value2['nilai_keuntungan'];                                
                }    
            }
            // if ($value['diskon_service'] > 0) {
            //     $revenue_service    = $revenue_service * $value['diskon_service'] / 100;    
            // }

            $jenis_sparepart    = [];
            $revenue_sparepart  = 0;
            foreach ($trx_sparepart as $key2 => $value2) {
                $jenis_sparepart[] = $value2['nama_barang'];
                $revenue_sparepart += $value2['harga_jual'];
            }                        
            // if ($value['diskon_service'] > 0) {
            //     $revenue_sparepart = $revenue_sparepart * $value['diskon_sparepart'] / 100;
            // }

            $x['jenis_service']     = implode(", ", $jenis_services);
            $x['nama_sparepart']    = implode(", ", $jenis_sparepart);
            $x['total_revenue']     = $revenue_service + $revenue_sparepart;
            $x['service_advisor']   = $value['admin'];
            $x['teknisi']           = $value['teknisi'];
            $x['tanggal_service']   = $value['tgl_transaksi'];            
            
            $x['uraian_pekerjaan'] = $uraian_pekerjaan;
            $x['trx'] = $trx_sparepart;
            $result[] = $x;
        }        
    
        $data['data'] = $result;
        echo json_encode($data);        

    }
    public function export($exportTo = 'pdf'){
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
                'column'     =>  $column,
                'start'     =>  $start,
                'end'       =>  $end
            ];
    
            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $dataPDF['columnTD']   =   $columnTD;
                $dataPDF['startTD']   =   $startTD;
                $dataPDF['endTD']   =   $endTD;
            }
            $this->pdf->load_view('admin/laporan-customer/pdf/kendaraan', $dataPDF);
        }
        
        if($exportTo === 'excel'){
            $this->load->model('ExcelExportData', 'export');
            $title      =   false;
            $header     =   false;
            $fileName   =   'LaporanKendaraan.xls';

            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $fileName   =   'LaporanKendaraan_Parameter_'.$columnTD.'_'.$startTD.' sd '.$endTD.'.xls';
            }                        

            $kolom      =   ['No.', 'Nama', 'Telepon', 'Email', 'Admin'];
            if(!is_null($column)){
                array_push($kolom, $column);
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

