<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class LaporanSparepart  extends CI_Controller{
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
        $data['subtitle_small'] = 'Laporan Sparepart (Harian)';
        $data['page'] = 'laporan_sparepart';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();

        $this->themes->Display('admin/laporan-sparepart/laporan-sparepart', $data);                                           
    }    

    public function view(){
        $idBengkel           = $this->session->userdata('idbengkel');   

        $this->db->group_by(array("DATE(tgl_transaksi)", "kode_barang"));
        $this->db->select('*');
        $this->db->select_sum('qty');
        $this->db->select_sum('harga_jual');

        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');  
               
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);

            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tgl_input' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tgl_input' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;

                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }

        $this->db->where(['status_penerimaan' => 3, 'id_bengkel' => $idBengkel]);
        $transaksi_sparepart = $this->db->get('view_transaksi_sparepart')->result_array();

        $data['data'] = $transaksi_sparepart;
        echo json_encode($data);        

    }
    public function export($exportTo = 'pdf'){
        $exportTo   =   strtolower($exportTo);

        $idBengkel           = $this->session->userdata('idbengkel');   

        $column     =   $this->input->get('column');
        $start      =   $this->input->get('start');
        $end        =   $this->input->get('end');  
               
        $this->db->group_by(array("DATE(tgl_transaksi)", "kode_barang"));
        $this->db->select('*');
        $this->db->select_sum('qty');
        $this->db->select_sum('harga_jual');
    
        if(!is_null($start) && !is_null($end) && !is_null($column)){
            $column =   trim($column);
            $start  =   trim($start);
            $end    =   trim($end);
    
            if($column === 'tgl_input'){
                $columnTD   =   'Tanggal Input';
            }else if($column === 'tgl_transaksi'){
                $columnTD   =   'Tanggal Transaksi';
            }else{
                $columnTD   =   '';
            }
    
            $startTD    =   ($column === 'tgl_input' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($start)) : $start;
            $endTD      =   ($column === 'tgl_input' || $column === 'tgl_transaksi')? date('D, d M Y', strtotime($end)) : $end;
    
            if(strlen($start) >= 1 && strlen($end) >= 1 && strlen($column) >= 1){
                $start  =   ($column === 'tgl_input' || $column === 'tgl_transaksi')? $start.' 00:00:00' : $start;
                $end    =   ($column === 'tgl_input' || $column === 'tgl_transaksi')? $end.' 23:59:59' : $end;
    
                $this->db->where($column.' >=', $start);
                $this->db->where($column.' <=', $end);
            }
        }
    
        $this->db->where(['status_penerimaan' => 3, 'id_bengkel' => $idBengkel]);
        $transaksi_sparepart = $this->db->get('view_transaksi_sparepart')->result_array();

        if($exportTo === 'pdf'){
            $dataPDF   =   [
                'transaksi_sparepart'  =>  $transaksi_sparepart,
                'column'    =>  $column,
                'start'     =>  $start,
                'end'       =>  $end
            ];
    
            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $dataPDF['columnTD']   =   $columnTD;
                $dataPDF['startTD']   =   $startTD;
                $dataPDF['endTD']   =   $endTD;
            }

            $this->load->library('pdf');
            $this->pdf->setPaper('legal', 'landscape');
            $this->pdf->load_view('admin/laporan-customer/pdf/sparepart', $dataPDF);
        }

        if($exportTo === 'excel'){
            $this->load->model('ExcelExportData', 'export');
            $title      =   false;
            $header     =   false;
            $fileName   =   'LaporanSparepart.xls';

            if(!is_null($column) && !is_null($start) && !is_null($end)){
                $fileName   =   'LaporanSparepart_Parameter_'.$columnTD.'_'.$startTD.' sd '.$endTD.'.xls';
            }                        
               

            $kolom      =   ['Tanggal Transaksi', 'Kode Barang', 'Nama Barang', 'Tanggal Input', 'Sisa Stok', 'Barang Terjual', 'Nilai Barang Terjual'];
            $dataArray  =   [];

            foreach($transaksi_sparepart as $row){
                $rowData    =   [
                    date('D, d M Y H:i:s', strtotime($row['tgl_transaksi'])),	     
                    $row['kode_barang'],	     
                    $row['nama_barang'],	     
                    $row['tgl_input'],	     
                    $row['stok'],	     
                    $row['qty'],	     
                    $row['harga_jual']
                ];

                array_push($dataArray, $rowData);
            }

            $this->export->exportToExcel($title, $header, $kolom, $dataArray, $fileName);
        }
    }
}