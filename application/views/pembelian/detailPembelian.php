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
    .statusBelanja{
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
    if($detailPembelian !== false){
        $idPembelian    =   $detailPembelian->id;

        $this->db->where('idPembelian', $idPembelian);
        $itemPembelian  =   $this->db->get('view_pembelian_item');
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
                        <?php if($detailPembelian !== false){ ?>
                            <span class='ml-2 badge badge-success'><?=$detailPembelian->nomorTransaksi?></span>
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
                            if($detailPembelian !== false){ 
                                $statusBelanja  =   $detailPembelian->statusBelanja;

                                if($statusBelanja === 'batal'){
                                    $colorStatusPembelian   =   'text-danger';
                                }else{
                                    if($statusBelanja === 'pending'){
                                        $colorStatusPembelian   =   'text-muted';
                                    }else{
                                        $colorStatusPembelian   =   'text-success';
                                    }
                                }
                        ?>
                            <div class='table-responsive' style='position:relative; z-index:1;'>
                                <table class='table table-sm'>
                                    <tbody>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Nomor Transaksi</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-info'><?=$detailPembelian->nomorTransaksi?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Vendor</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left'>
                                                <?=$detailPembelian->namaVendor?>
                                                <p class="text-sm text-muted"><?=$detailPembelian->alamatVendor ?></p>
                                            </td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Waktu Belanja</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left'><?=date('D, d M Y H:i:s', strtotime($detailPembelian->waktu))?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Total Belanja</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-success'>Rp. <?=number_format($detailPembelian->totalBelanja)?></td>
                                        </tr>
                                        <tr class='text-sm'>
                                            <td class='no-border-top text-left'>Tunai</td>
                                            <td class='no-border-top text-center'>:</td>
                                            <td class='no-border-top text-left text-success'>Rp. <?=number_format($detailPembelian->tunai)?></td>
                                        </tr>
                                        
                                        <span class="statusBelanja <?=$colorStatusPembelian?>">
                                            <?=strtoupper($statusBelanja)?>
                                        </span>
                                    </tbody>
                                </table>
                                <hr class='pb-4' />
                                <?php 
                                    if($itemPembelian->num_rows() >=    1){ 
                                        $itemPembelian  =   $itemPembelian->result_array();
                                ?>
                                    <table class='table table-sm table-striped table-bordered'>
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-left">Nama Produk</th>
                                                <th class="text-right">Harga</th>
                                                <th class="text-right">Quantity</th>
                                                <th class="text-right">Total</th>
                                                <th class='text-left'>P
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($itemPembelian as $indexData => $item){ ?>
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
                                                    <td class='text-left'>
                                                        <span class='badge badge-<?=($item['produkAda'] == 1)? 'success' : 'danger'?>'>
                                                            <?=($item['produkAda'] == 1)? 'Tersedia' : 'Tidak Tersedia'?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                    <div class="text-center py-4">
                                        <h4 class='mb-3'>Item Pembelian</h4>
                                        <img src="<?=base_url('assets_new/img/search.png')?>" alt="Item Pembelian Tidak Ditemukan" 
                                            class='d-block m-auto' style='width:150px;' />
                                        <p class='text-danger'>Pembelian ini tidak memiliki item pembelian !</p>
                                    </div>
                                <?php } ?>
                                <hr />
                                <a href='<?=site_url('detail-pembelian-pdf/')?><?=$idPembelian?>'>
                                    <button class='btn btn-warning'>
                                        Download Detail Pembelian (PDF)
                                    </button>
                                </a>
                            </div>
                        <?php }else{ ?>
                            <div class="text-center py-4">
                                <h4 class='mb-3'>Detail Pembelian</h4>
                                <img src="<?=base_url('assets_new/img/search.png')?>" alt="Detail Pembelian Tidak Ditemukan" 
                                    class='d-block m-auto' style='width:150px;' />
                                <p class='text-danger'>Detail Pembelian Tidak Ditemukan !</p>
                            </div>
                        <?php } ?>             
                    </div>            
                </div>
            </div>
        </div>
    </div>
</div>