<style>
    .tabel-item-penjualan{
        padding: 15px;
        border: 1px solid;
        border-radius: 10px;
    }
</style>
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
                    </h4>
                </div>
            </div>
        </div>
    </div>          
        <div class="row">
            <div class="col-xl-12">      
                <?php 
                    if($detailPenjualan->num_rows() >= 1){ 
                        $detailPenjualan    =   $detailPenjualan->row();

                        if(strtolower($detailPenjualan->statusPenjualan) === 'selesai'){
                ?>      
                    <div class="row">                
                        <div class="col-xl-8 border-right">
                            <div class='row'>
                                <div class='col-xl-12 table-responsive'>
                                    <table class='table table-sm'>
                                        <tr class='tr-parent text-sm'>
                                            <td class='border-top-0'>ID Bengkel</td>
                                            <td class='border-top-0'>:</td>
                                            <td class='border-top-0'><?=$detailPenjualan->idBengkel?></td>
                                        </tr>
                                        <tr class='tr-parent text-sm'>
                                            <td class='border-top-0'>Nomor Transaksi</td>
                                            <td class='border-top-0'>:</td>
                                            <td class='border-top-0'><?=$detailPenjualan->nomorTransaksi?></td>
                                        </tr>
                                        <tr class='tr-parent text-sm'>
                                            <td class='border-top-0'>Waktu</td>
                                            <td class='border-top-0'>:</td>
                                            <td class='border-top-0'><?=date('D, d M Y', strtotime($detailPenjualan->waktu))?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr />  
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class='table-responsive border-success tabel-item-penjualan'>
                                        <table class="table-sm table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class='text-left'>Nama Produk</th>
                                                    <th class='text-right'>Harga</th>
                                                    <th class='text-right'>Quantity</th>
                                                    <th class='text-right'>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $grandTotal     =   0;
                                                    foreach($itemPenjualan as $indexData => $item){ 
                                                        $hargaBersih        =   $item['harga'] - $item['diskon'];
                                                        $totalHargaItem     =   $hargaBersih * $item['quantity'];

                                                        $grandTotal +=  $totalHargaItem;
                                                ?>
                                                    <tr class='tr-parent text-sm'>
                                                        <th class='text-left'><?=$item['namaProduk']?></th>
                                                        <th class='text-right'>
                                                            <p class="text-success">Rp. <?=number_format($hargaBersih)?></p>
                                                            <?php if($item['diskon'] != 0){ ?>
                                                                <span class="text-warning" style='font-size:9pt'>Diskon Rp. <?=number_format($item['diskon'])?></span>
                                                            <?php } ?>
                                                        </th>
                                                        <th class='text-right'><?=$item['quantity']?> item</th>
                                                        <th class='text-right'>Rp. <?=number_format($totalHargaItem)?></th>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="text-right p-3" style='background:#d7f3c8; border-radius:10px;'>
                                <span class="text-success" style='font-size:22pt;font-weight:bold;'>Rp. <?=number_format($grandTotal)?></span>
                            </div>
                            <hr class="my-4" />
                            <div class="form-group">
                                <label for="diskon">Diskon</label>
                                <input type="number" class='form-control form-control-sm' placeholder='Diskon' id='diskon'
                                    onKeyup='diskonHandler(this)' />
                                <p id='diskonNotification' class='my-2'></p>
                            </div>
                            <div class='form-group'>
                                <label for='bayar'>Bayar</label>
                                <input type='number' id='bayar' placeholder='Bayar / Tunai' class='form-control' 
                                    onKeyup='bayar(this)' />
                            </div>
                            <hr class='my-4' />
                            <div id='buttons'>
                                <div id="btnSelesai" class='mb-2'>
                                    <button class="btn btn-success btn-block" id='selesai' 
                                        onClick='selesaiLunas()'>Selesai (Lunas)</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>
        </div>
</div>