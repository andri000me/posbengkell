<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Perintah Kerja Bengkel</title>
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
        table{
            margin: 10px
        }
        td{
            padding:5px;
        }
        caption { 
          display: table-caption;
          text-align: left;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="header">
            <h2 class="hospital-title">PERINTAH KERJA</h2>                     
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <table width="100%">
                <tr>
                    <td width="100px">
                        Nama
                    </td>
                    <td width="10px">:</td>
                    <td>
                       <?=$data_bengkel->nama_pemilik?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        Alamat
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_bengkel->alamat?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Telepon
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_bengkel->no_telepon?>
                    </td>
                </tr>
                <tr>
                    <td>
                        No. NPWP
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_bengkel->no_npwp?>
                    </td>
                </tr>
            </table>
            <table width="100%">                
                <tr>
                    <td width="100px">
                        Pekerjaan
                    </td>
                    <td width="10px">:</td>
                    <td>
                       <?=$data_perintah_kerja->pekerjaan?>                         
                    </td>
                </tr>
                <tr>
                    <td>
                        Pelanggan
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_perintah_kerja->pelanggan?>                                                 
                    </td>
                </tr>     
                <tr>
                    <td>
                        T/J Appointment
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_perintah_kerja->tgl_jam_appointment?>                                                 
                    </td>
                </tr>                
                <tr>
                    <td>
                        T/J Penerimaan
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->tgl_penerimaan?>                                                 
                    </td>
                </tr>   
                <tr>
                    <td>
                        T/J Penyerahan
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_perintah_kerja->tgl_jam_penyerahan?>                                                 
                    </td>
                </tr>                
            </table>
        </div>
        <div class="col-6">
            <table width="100%">                
                <tr>
                    <td width="100px">
                        No. PKB
                    </td>
                    <td width="10px">:</td>
                    <td>
                       <?=$data_penerimaan->no_pkb?>                         
                    </td>
                </tr>
                <tr>
                    <td>
                        Tgl Penerimaan
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->tgl_penerimaan?>                                                 
                    </td>
                </tr>                
            </table>            
            <table width="100%">                
                <tr>
                    <td width="100px">
                        Model
                    </td>
                    <td width="10px">:</td>
                    <td>
                       <?=$data_penerimaan->tipe_warna?>                         
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
                        Tahun
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_penerimaan->tahun_produksi?>                                                 
                    </td>
                </tr>                
                <tr>
                    <td>
                        NIP Teknisi
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_teknisi->nip?>                                                 
                    </td>
                </tr>    
                <tr>
                    <td>
                        Nama Teknisi
                    </td>
                    <td>:</td>
                    <td>
                       <?=$data_teknisi->nama?>                                                 
                    </td>
                </tr>                
            </table>
        </div>
    </div>
    <div class="row datas">
        <div class="col-6">
            <table>
                <caption>Permintaan dan Keluhan</caption>                
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    foreach ($data_permintaan_keluhan as $val) { ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['kategori']?></td>
                            <td><?=$val['keterangan']?></td>                
                        </tr>                    
                    <?php }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Kilometer <br> <h3 style="text-align: center;"><?= $data_penerimaan->kilometer ?></h3> </td>
                        <td colspan="2">Bahan Bakar <br> <h3 style="text-align: center;"><?= $data_penerimaan->bahan_bakar?>/5</h3></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-6">
            <table>
                <caption>Uraian Pekerjaan</caption>                                
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>                            
                        <th>Biaya</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    foreach ($data_uraian_pekerjaan as $val) { ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td style="text-align: right;"><?= "Rp.". number_format($val['biaya'], 0, ".", ".")?></td>            
                        </tr>                    
                    <?php }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total</td>
                        <td style="text-align: right;"><?= "Rp.". number_format($biaya, 0, ".", ".") ?></td>
                    </tr>
                </tfoot>
            </table>
            <!-- <p style="font-size: 9px; margin-left: 10px; margin-right: 10px">Semua Estimasi Biaya yang dihasilkan berkenaan dengan Waktu Penyelesaian maupun biaya yang diperlukan hanya merupakan suatu taksiran dan tidak mengikat. Seluruh isi Order dan Ketentuannya sudah dijelaskan oleh Service Advisor (SA).</p> -->
        </div>

        
    </div>    
    <div class="row datas">
        <div class="col-12">
            <table>
                <caption>Spare-Part</caption>                                                
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>                            
                        <th>Keterangan</th>                            
                        <th>Kuantitas</th>                            
                        <th>Harga</th>                            
                        <th>Total Harga</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    $harga_jual = 0;
                    foreach ($data_transaksi_sparepart as $val) { 
                        $harga_jual += $val['harga_jual'] * $val['qty'];
                        ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['nama_barang']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td style="text-align: center;"><?=$val['qty']?></td>            
                            <td style="text-align: right;"><?= "Rp.". number_format($val['harga_jual'], 0, ".", ".") ?></td>     
                            <td style="text-align: right;"><?= "Rp.". number_format($val['harga_jual'] * $val['qty'], 0, ".", ".") ?></td>     
                        </tr>                    
                    <?php }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total</td>
                        <td style="text-align: right;"><?= "Rp.". number_format($harga_jual, 0, ".", ".") ?></td>
                    </tr>
                </tfoot>
            </table>            
        </div>
    </div>
    <div class="row">
        <p style="font-size: 9px; margin-left: 10px; margin-right: 10px">Semua Estimasi Biaya yang dihasilkan berkenaan dengan Waktu Penyelesaian maupun biaya yang diperlukan hanya merupakan suatu taksiran dan tidak mengikat. Seluruh isi Order dan Ketentuannya sudah dijelaskan oleh Service Advisor (SA).</p>
    </div>
    <div class="row">
        <div class="col-6">            
            <table>
                <tbody>
                    <tr>
                        <td>STNK</td>
                        <td>:</td>
                        <td><?= ($data_perintah_kerja->stnk == 1 ? 'Ada' : 'Tidak Ada') ?></td>
                    </tr>
                    <tr>
                        <td>Buku Service</td>
                        <td>:</td>
                        <td><?= ($data_perintah_kerja->buku_service == 1 ? 'Ada' : 'Tidak Ada') ?></td>                        
                    </tr>
                </tbody>                
            </table>            
        </div>
        <div class="col-6 datas">
            <table>
                <thead>
                    <tr>
                        <th>Pemilik Kendaraan</th>
                        <th>Service Advisor</th>                            
                    </tr>
                </thead>
                <tbody>            
                    <tr>
                        <td>                        
                            <br>
                            &nbsp;
                            <br>
                            &nbsp;
                            <br>
                            &nbsp;
                            <br>
                            <center><?= ucwords($data_penerimaan->nama_pemilik) ?></center>  
                            <!-- <center>............................</center> -->
                        </td>
                        <td>
                            <br>
                            &nbsp;
                            <br>
                            &nbsp;
                            <br>
                            &nbsp;
                            <br>
                            <center><?= ucwords($service_advisor->nama) ?></center>                          
                            <!-- <center>............................</center> -->
                        </td>                
                    </tr>
                </tbody>
            </table>
        </div>
    </div>     
    <div class="row datas">        
        <div class="col-12">
            <table border="1">   
                <caption>Syarat & Ketentuan:</caption>                                                
                <tr>                    
                    <td style="width: 400px; margin:0px !important; padding: 0px !important">
                    </td>
                    <td>
                        <ul>
                            <li>
                                Mohon Disimpan, lembar ini dipakai untuk pengambilan
                            </li>
                            <li>
                                Mohon untuk tidak Meninggalkan Barang-barang Berharga didalam Kendaraan
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>