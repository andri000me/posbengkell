<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Kwitansi</title>
    <style>
                *{
            font-size:9pt;
        }
        .row, .table{ 
            width:100%;
            margin-top: 10px;
            margin-bottom: 10px;  
        }
        .row-footer{
            width:100%;
            margin-top: 30px;
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

        .full-right{
            float: right;
            text-align: right;
        }

    </style>
</head>
<body   >
    <div class="row">
        <div class="header">
            <h2 class="hospital-title">KITANSI PEMBAYARAN</h2>                     
            <span>Tanggal : <?=$data_penerimaan->tgl_transaksi?></span>
        </div>

    </div>

    <div class="row">
        <div class="col-6">
            <h1><?=$data_bengkel->nama_pemilik?></h1>
            <p><?=$data_bengkel->no_telepon?></p>
            <address><?=$data_bengkel->alamat?></address>
        </div>
        <div class="col-6">
            <caption>Tertagih</caption>            
            <hr>
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
    </div>
    <div class="row datas">
        <div class="col-12">
            <caption>
                Tagihan Sparepart <?=$data_penerimaan->diskon_sparepart?>% Diskon
            </caption>
            <table>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>                                                    
                    </tr>
                </thead>
                <tbody>

                <?php    
                    foreach ($data_transaksi_sparepart as $val) { ?> 
                        <tr>
                            <td><?=$val['kode_barang']?></td>
                            <td><?=$val['nama_barang']?></td>
                            <td><?=$val['qty']?></td>
                            <td style="text-align: right;"><?= "Rp.". number_format($val['harga_jual'], 0, ".", ".");?></td>
                        </tr>                    
                    <?php }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            Total
                        </td>
                        <td style="text-align: right;">                            
                            <?php if ($data_penerimaan->diskon_sparepart > 0) {
                                    echo "<s>Rp.".number_format($total_tagihan_sparepart, 0, ".", ".")."</s> ";
                                    echo  "Rp.". number_format($total_tagihan_sparepart - ($total_tagihan_sparepart * $data_penerimaan->diskon_sparepart /100 ), 0, ".", ".");
                                }else{
                                    echo  "Rp.". number_format($total_tagihan_sparepart, 0, ".", ".");
                                }
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>        
    </div>    

    <div class="row datas">
        <div class="col-12">
            <caption>
                    Tagihan Service(Jasa) <?=$data_penerimaan->diskon_service?>% Diskon
            </caption>            
            <table>
                <thead>
                    <tr>                        
                        <th>Service</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Biaya</th>                                                    
                    </tr>
                </thead>
                <tbody>
                <?php    
                    foreach ($data_uraian_pekerjaan as $val) { ?> 
                        <tr>
                            <td><?=$val['jenis_service']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td style="text-align: right;"><?= "Rp.". number_format($val['biaya'], 0, ".", ".");?></td>
                        </tr>                    
                    <?php }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            Total
                        </td>
                        <td style="text-align: right;">                            
                            <?php if ($data_penerimaan->diskon_service > 0) {
                                    echo "<s>Rp.".number_format($total_tagihan_pekerjaan, 0, ".", ".")."</s> ";
                                    echo  "Rp.". number_format($total_tagihan_pekerjaan - ($total_tagihan_pekerjaan * $data_penerimaan->diskon_service /100 ), 0, ".", ".");
                                }else{
                                    echo  "Rp.". number_format($total_tagihan_pekerjaan, 0, ".", ".");
                                }
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>        
    </div>    
    <br>     

    <div class="row">
        <div class="col-12">            
            Total Tagihan             
            <b class="full-right"><sup>*ppn</sup> <?= "Rp.". number_format($total, 0, ".", ".");?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            Bayar <b class="full-right"><?= "Rp.". number_format($data_penerimaan->bayar, 0, ".", ".");?></b>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            Kembalian <b class="full-right"><?= "Rp.". number_format($data_penerimaan->kembalian, 0, ".", ".");?></b>
        </div>
    </div>
    
    <div class="row-footer">
        <div class="col-6">
            Syarat & Ketentuan
            <hr>
            -
        </div>
        <div class="col-6" >
            <p style="text-align: right; line-height: 30px"><?= date('d, F yy'); ?></p>
        </div>
    </div>