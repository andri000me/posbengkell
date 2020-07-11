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
                <div class="row">                
                    <?php 
                        $this->db->where('statusBelanja', 'pending');
                        $listPembelianPending   =   $this->db->get('view_pembelian');

                        if($listPembelianPending->num_rows() >= 1){
                            foreach($listPembelianPending->result_array() as $pembelianPending){
                                ?>
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="card">
                                            <div class="card-box p-3">
                                                <h6>Pembelian dari Vendor <span class="text-info"><?=$pembelianPending['namaVendor']?></span></h6>
                                                <span class="text-muted">
                                                    Nomor Transaksi <span class="badge badge-success"><?=$pembelianPending['nomorTransaksi']?></span>
                                                </span>

                                                <p class="text-success mt-3" style='font-size:15pt'>Rp. <?=number_format($pembelianPending['totalBelanja'])?></p>
                                                <hr />
                                                <a href='<?=site_url("lanjutkan-pembelian-pending/")?><?=$pembelianPending['id']?>'>
                                                    <button class="btn btn-success btn-sm mr-1">
                                                        <span class="fa fa-shopping-cart mr-2"></span>
                                                        Lanjutkan
                                                    </button>
                                                </a>
                                                <button class="btn btn-danger btn-sm ml-1">
                                                    <span class="fa fa-trash mr-2"></span>
                                                    Batalkan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }else{
                    ?>
                        <div class="col-xl-12 text-center">
                            <h4 class="text-danger mb-3">Pembelian Pending</h4>
                            <img src="<?=base_url('assets_new/img/search.png')?>" alt="Search" 
                                class='m-auto d-block' style='width:150px;' />
                            <p class="text-danger mt-3">
                                Tidak ada pembelian yang berstatus pending
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
</div>