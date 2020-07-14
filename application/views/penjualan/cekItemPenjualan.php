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

                        if(strtolower($detailPenjualan->statusPenjualan) === 'pending'){
                ?>      
                    <div class="row">                
                        <div class="col-xl-8 border-right">
                            <div class="row">
                                <div class="col-xl-12 table-responsive">
                                    <table class="table-sm table table-striped">
                                        <thead>
                                            <tr>
                                                <th class='text-left'>Nama Produk</th>
                                                <th class='text-right'>Harga</th>
                                                <th class='text-right'>Quantity</th>
                                                <th class='text-right'>Total</th>
                                                <th class='text-right'>Opsi</th>
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
                                                    <th class='text-right'>
                                                        <input type='checkbox' name='itemPenjualan[]' class='item' value='<?=$item['idProduk']?>' />
                                                    </th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <hr />
                                    <button class='btn btn-success mr-1' id='semuaAda'>Semua Ada</button>
                                    <button class='btn btn-danger ml-1' id='semuaTidakAda'>Semua Tidak Ada</button>
                                    <hr />
                                    <p>
                                        <span class='text-danger'>Centang Item Yang dijual jika memang item tersedia</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="text-right p-3" style='background:#d7f3c8; border-radius:10px;'>
                                <span class="text-success" style='font-size:22pt;font-weight:bold;'>Rp. <?=number_format($grandTotal)?></span>
                            </div>
                            <hr class="my-4" />
                            <div id='buttons'>
                                <div id="btnSelesai" class='mb-2'>
                                    <button class="btn btn-success btn-block" id='selesai' 
                                        onClick='cekItemPenjualanSelesai()'>Selesai</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>
        </div>
</div>