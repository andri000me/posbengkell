<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laporan Sparepart</title>
        <link rel="stylesheet" href="<?=base_url('assets_new/css/bootstrap.min.css')?>">
        <style>
            tr.text-sm > td{
                font-size:10pt;
            }
        </style>
    </head>
    <body>
        <h4 class='text-center'>Laporan Sparepart</h4>
        <br class='mb-5' />
        <?php 
            if(!is_null($column) && !is_null($start) && !is_null($end)){
        ?>
        <div class="row mb-3">
            <div class="col-xl-6">
                <div class="table-reponsive">
                    <table class="table-sm">
                        <tr>
                            <td class="text-left">Parameter</td>
                            <td class="text-center">:</td>
                            <td class="text-left"><?=$columnTD?></td>
                        </tr>
                        <tr>
                            <td class="text-left">Rentang Nilai</td>
                            <td class="text-center">:</td>
                            <td class="text-left"><?=$startTD?> s/d <?=$endTD?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-xl-12 table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Transaksi</th>	     
                            <th scope="col">Kode Barang</th>	     
                            <th scope="col">Nama Barang</th>	     
                            <th scope="col">Tanggal Input</th>	     
                            <th scope="col">Sisa Stok</th>	     
                            <th scope="col">Barang Terjual</th>	     
                            <th scope="col">Nilai Barang Terjual</th>	                                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($transaksi_sparepart as $transaksi){ ?>    
                            <tr class='tr-parent text-sm'>
                                <th scope="col"><?=date('D, d M Y H:i:s', strtotime($transaksi['tgl_transaksi']))?></th>	     
                                <th scope="col"><?=$transaksi['kode_barang']?></th>	     
                                <th scope="col"><?=$transaksi['nama_barang']?></th>	     
                                <th scope="col"><?=$transaksi['tgl_input']?></th>	     
                                <th scope="col"><?=$transaksi['stok']?></th>	     
                                <th scope="col"><?=$transaksi['qty']?></th>	     
                                <th scope="col"><?=$transaksi['harga_jual']?></th>	 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>