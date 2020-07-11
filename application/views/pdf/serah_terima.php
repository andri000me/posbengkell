<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Serah Terima Kendaraan</title>
    <style>
        *{
            font-size:9pt;
        }
        .row, .table{ 
            width:100%;
            margin-top: 10px;
            margin-bottom: 10px  
        }
        .row::after{
            clear: both;
        }
        .header { 
            text-align: right; 
            width: 100%;
        }
        .col{width:50%;float:left;}
        .col-4{width:33.333333334%;float:left;}
        .col-6{width:50%;float:left;}
        .col-12{width:100%;float:left;}

        .datas{
            font-size: 9px
        }
        
        .datas table {
            border-collapse: separate;
            border :  0px solid #000000;
            border-spacing: 0;
            font-size: 11pt;
            width: 100%;
            border-color:  #000000 ;
            border-right: 1px solid;
            margin: 5px
        }
        .datas tr {
            border-color:  #000000 ;
            border-style: none ;
            border-width: 0 ;
        }
        .datas td {
            border-color:  #000000 ;
            border-left: 1px solid;
            border-bottom:1px solid ;
        }

        .datas th {
            border-color:  #000000 ;
            border-left: 1px solid;
            border-top:1px solid ;
            border-bottom:1px solid ;
        }
        td{
            padding:5px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="header">
            <h2 class="hospital-title">BUKTI SERAH TERIMA KENDARAAN</h2>                     
            <span>Tanggal : <?=$data_penerimaan->tgl_penerimaan?></span>
        </div>

    </div>

    <div class="row">
        <div class="col-6">
            <table width="100%">
                <tr>
                    <td width="200px">
                        Nama
                    </td>
                    <td width="10px">:</td>
                    <td>
                       <?=$data_penerimaan->nama_pemilik?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        Alamat
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->alamat_pemilik?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Telepon
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->telepon_pemilik?>
                    </td>
                </tr>
                <tr>
                    <td>
                        No. PKB
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->no_pkb?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <table width="100%" style="padding-left:20px;">                
                <tr>
                    <td width="200px">
                        No. Polisi
                    </td>
                    <td width="10px">:</td>
                    <td>
                       <?=$data_penerimaan->no_polisi?>                         
                    </td>
                </tr>
                <tr>
                    <td>
                        No. Rangka
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->no_rangka?>                                                 
                    </td>
                </tr>
                <tr>
                    <td>
                        No. Mesin
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->no_mesin?>                                                                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Tipe / Warna
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->tipe_warna?>                       
                    </td>
                </tr>
                <tr>
                    <td>
                        Tahun Produksi
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->tahun_produksi?>                        
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <b style="text-align: left">Kendaraan diatas diserahkan dengan Perlengkapan dan Keadaan Seperti dibawah ini:</b>
    <div class="row datas">
        <div class="col-4">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perlengkapan</th>
                        <th>Status</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    foreach ($detail_penerimaan_1 as $val) { ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td><?=$val['status'] == 1 ? 'BAIK' 
                            : ($val['status'] == 2 ? 'RUSAK' 
                            : 'TIDAK ADA') ?></td>                
                        </tr>                    
                    <?php }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perlengkapan</th>
                        <th>Status</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    foreach ($detail_penerimaan_2 as $val) { ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td><?=$val['status'] == 1 ? 'BAIK' 
                            : ($val['status'] == 2 ? 'RUSAK' 
                            : 'TIDAK ADA') ?></td>                 
                        </tr>                    
                    <?php }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perlengkapan</th>
                        <th>Status</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    foreach ($detail_penerimaan_3 as $val) { ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td><?=$val['status'] == 1 ? 'BAIK' 
                            : ($val['status'] == 2 ? 'RUSAK' 
                            : 'TIDAK ADA') ?></td>                   
                        </tr>                    
                    <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>         
    <div class="row">
        <b><u>Catatan:</u> Kerusakan Kendaraan pada body dan kaca, baru dapat dinilai setelah kendaraan dibersihkan.</b>    
    </div>
    <div class="row datas">
        <table>
        <thead>
            <tr>
                <th>TANGGAL</th>
                <th>Pemilik / PEMBAWA KENDARAAN</th>
                <th>PETUGAS BENGKEL</th>                            
            </tr>
        </thead>
        <tbody>            
            <tr>
                <td>
                    <center>Kendaraahn yang diserahkan Pelanggan</center>
                    <br>
                    &nbsp;
                    <br>
                    &nbsp;
                    <br>
                    &nbsp;
                    <br>
                    <center>............................</center>
                </td>
                <td>
                    <center>Yang Menyerahkan</center>  
                    <br>
                    &nbsp;
                    <br>
                    &nbsp;
                    <br>
                    &nbsp;
                    <br>
                    <center>............................</center>
                </td>
                <td>
                    <center>
                        Yang Menerima
                    </center>
                    <br>
                    &nbsp;
                    <br>
                    &nbsp;
                    <br>
                    &nbsp;
                    <br>
                    <center>............................</center>
                </td>                
            </tr>
        </tbody>
    </table>
    </div>