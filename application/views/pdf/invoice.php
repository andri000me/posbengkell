<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
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
<body>
    <div class="row">
        <div class="header">
            <h2 class="hospital-title">INVOICE</h2>                     
            <span>Tanggal : <?=$data_penerimaan->tgl_penerimaan?></span>
        </div>

    </div>

    <div class="row">
        <div class="col-6">
            <h1><?=$data_bengkel->nama_pemilik?></h1>
            <p><?=$data_bengkel->no_telepon?></p>
            <address><?=$data_bengkel->alamat?></address>
        </div>
        <div class="col-6">
            <caption>Tagihan Dari</caption>            
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
            <caption>Spare-Part</caption>
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Barang</th>
                        <th>Kuantitas</th>                            
                        <th>Harga</th>                            
                        <th>Total</th>                            
                    </tr>
                </thead>
                <tbody>
                <?php    
                    foreach ($data_transaksi_sparepart as $val) { ?> 
                        <tr>
                            <td><?=$val['kode_barang']?></td>
                            <td><?=$val['nama_barang']?></td>
                            <td><?=$val['qty']?></td>
                            <td class="full-right"><?= "Rp.". number_format($val['harga_jual'], 0, ".", ".");?></td>
                            <td class="full-right"><?= "Rp.". number_format($val['harga_jual'] * $val['qty'], 0, ".", ".");?></td>
                        </tr>                    
                    <?php }
                ?>
                </tbody>
            </table>
        </div>        
    </div>    
    <br>     
    <div class="row datas">
        <div class="col-12">
            <caption>Uraian Pekerjaan</caption>            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Service</th>
                        <th>Keterangan</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                <?php                   
                    foreach ($data_uraian_pekerjaan as $val) { ?> 
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['jenis_service']?></td>
                            <td><?=$val['keterangan']?></td>
                            <td class="full-right"><?= "Rp.". number_format($val['biaya'], 0, ".", ".");?></td>
                        </tr>                    
                    <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            <b class="full-right"> 
                <?= $data_penerimaan->diskon > 0 ? '<s>'."Rp.". number_format($total + $data_penerimaan->ppn, 0, ".", ".").'</s> (Diskon '.$data_penerimaan->diskon.'%)'  : "" ?>
                <?= "Rp.". number_format($total* (100 - $data_penerimaan->diskon)/100 + $data_penerimaan->ppn, 0, ".", ".");?>
            </b>
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