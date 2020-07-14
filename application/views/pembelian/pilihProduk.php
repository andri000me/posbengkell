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
                    if($detailPembelian->num_rows() >= 1){ 
                        $detailPembelian    =   $detailPembelian->row();

                        if(strtolower($detailPembelian->statusBelanja) === 'start'){
                ?>      
                    <div class="row">                
                        <div class="col-xl-8 border-right">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="cariProduk">Cari Sparepart</label>
                                        <input type="text" class='form-control form-control-sm' placeholder='Cari Sparepart dengan Nama atau Kode' id='cariProduk' />
                                    </div>
                                </div>
                            </div>
                            <hr class='my-2' />
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
                                                foreach($itemPembelian as $indexData => $item){ 
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
                                                        <span class="fa fa-trash text-danger cp"
                                                            onClick='hapusItem(this, "<?=$item['idProduk']?>")'></span>
                                                    </th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="text-right p-3" style='background:#d7f3c8; border-radius:10px;'>
                                <span class="text-success" style='font-size:22pt;font-weight:bold;'>Rp. <?=number_format($grandTotal)?></span>
                            </div>
                            <hr class="my-4" />
                            <div class="form-group">
                                <label for="supplier">Supplier <span id='showNamaVendor'></span></label>
                                <input type="text" class='form-control form-control-sm' placeholder='Cari Supplier dengan Nama atau Kode' id='supplier' />
                            </div>
                            <div class="form-group">
                                <label for="tunai">Tunai</label>
                                <input type="number" class='form-control form-control-sm' placeholder='Nominal Pembayaran Tunai' id='tunai' 
                                    onKeyup='tunaiChanged(this)' />
                            </div>
                            <hr class="my-4" />
                            <div id='buttons'>
                                <div id="btnSelesai" class='mb-2'>
                                    <button class="btn btn-success btn-block" id='selesai' onClick='selesai()'>Selesai</button>
                                </div>
                                <button class="btn btn-danger btn-block" id='batal' onClick='batal()'>Batalkan Transaksi Ini</button>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>
        </div>
</div>