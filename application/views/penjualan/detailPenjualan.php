<style type='text/css'>
    .opsi{
        font-size:12.5pt;
    }
    .no-border-top{
        border-top:0 !important;
    }
    .tr-parent > td{
        font-size:12px;
    }
    .statusPenjualan{
        opacity: .2;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(325deg);
        font-size: 25pt;
        font-weight: bold;
        z-index: -1;
    }
</style>
<?php
    if($detailPenjualan !== false){
        $idPenjualan    =   $detailPenjualan->id;

        $this->db->where('idPenjualan', $idPenjualan);
        $itemPenjualan  =   $this->db->get('view_penjualan_item');
    }
?>
<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                    <h4 class="hk-pg-title">
                        <span class="pg-title-icon">
                            <span class="feather-icon">
                                <i data-feather="external-link"></i>
                            </span>
                        </span>
                        <?=$subtitle_small?>
                        <?php if($detailPenjualan !== false){ ?>
                            <span class='ml-2 badge badge-success'><?=$detailPenjualan->nomorTransaksi?></span>
                        <?php } ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>   
    <div class="hk-sec-wrapper">         
        <div class="row">
            <div class="col-xl-12">            
                <div class="row">                
                    <div class="col-md-12">
                        <?php 
                            if($detailPenjualan !== false){ 
                                $statusPenjualan  =   $detailPenjualan->statusPenjualan;

                                if($statusPenjualan === 'batal'){
                                    $colorStatusPenjualan   =   'text-danger';
                                }else{
                                    if($statusPenjualan === 'pending'){
                                        $colorStatusPenjualan   =   'text-muted';
                                    }else{
                                        $colorStatusPenjualan   =   'text-success';
                                    }
                                }
                        ?>
                            <div class='table-responsive' style='position:relative; z-index:1;'>
                                <table class='table table-sm'>
                                    <tbody>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Bengkel</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-info'><?=$detailPenjualan->idBengkel    ?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Nomor Transaksi</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-info'><?=$detailPenjualan->nomorTransaksi?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Waktu Belanja</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left'><?=date('D, d M Y H:i:s', strtotime($detailPenjualan->waktu))?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Total Belanja</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-success'>Rp. <?=number_format($detailPenjualan->totalBelanja)?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Diskon</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-success'>Rp. <?=number_format($detailPenjualan->diskon)?></td>
                                        </tr>
                                        
                                        <span class="statusPenjualan <?=$colorStatusPenjualan?>">
                                            <?=strtoupper($statusPenjualan)?>
                                        </span>
                                    </tbody>
                                </table>
                                <hr class='pb-4' />
                                <?php 
                                    if($itemPenjualan->num_rows() >=    1){ 
                                        $itemPenjualan  =   $itemPenjualan->result_array();
                                ?>
                                    <table class='table table-sm table-striped table-bordered'>
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-left">Nama Produk</th>
                                                <th class="text-right">Harga</th>
                                                <th class="text-right">Quantity</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($itemPenjualan as $indexData => $item){ ?>
                                                <tr class='tr-parent text-sm'>
                                                    <td class="text-center"><?=$indexData+1?></td>
                                                    <td class="text-left"><?=$item['namaProduk']?></td>
                                                    <td class="text-right text-success">
                                                        <b>Rp. <?=number_format($item['harga'])?></b>
                                                    </td>
                                                    <td class="text-right text-success"><?=$item['quantity']?> item(s)</td>
                                                    <td class="text-right text-success">
                                                        <b>Rp. <?=number_format($item['totalHarga'])?></b>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                    <div class="text-center py-4">
                                        <h4 class='mb-3'>Item Penjualan</h4>
                                        <img src="<?=base_url('assets_new/img/search.png')?>" alt="Item Penjualan Tidak Ditemukan" 
                                            class='d-block m-auto' style='width:150px;' />
                                        <p class='text-danger'>Penjualan ini tidak memiliki item penjualan !</p>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <div class="text-center py-4">
                                <h4 class='mb-3'>Detail Penjualan</h4>
                                <img src="<?=base_url('assets_new/img/search.png')?>" alt="Detail Penjualan Tidak Ditemukan" 
                                    class='d-block m-auto' style='width:150px;' />
                                <p class='text-danger'>Detail Penjualan Tidak Ditemukan !</p>
                            </div>
                        <?php } ?>             
                    </div>            
                </div>
            </div>
        </div>
    </div>
</div>