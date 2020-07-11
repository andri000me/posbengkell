<?php
    class ExcelExportData extends CI_Model{
        public function __construct(){
            parent::__construct();
        }
        public function exportToExcel($title = false, $header = false, $kolom = [], $dataArray = [], $fileName){
            include     APPPATH.'libraries\ExportData.php';

            $excel  =   new ExportDataExcel('browser', $fileName);
            $excel->initialize();

            if($title !== false && is_array($title)){
                $excel->addRow($title);
                $excel->addRow();
            }

            if($header !== false && is_array($header)){
                foreach($header as $head){
                    $excel->addRow($head);
                }
                $excel->addRow();
            }

            $excel->addRow($kolom);

            if(count($dataArray) >= 1){
                foreach($dataArray as $indexData => $data){
                    $excel->addRow($data);
                }
            }

            $excel->finalize();
        }
    }
?>