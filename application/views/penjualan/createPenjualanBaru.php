    <style>
    .img-pilihan-belanja{
        width:210px;
        display:block;
        margin:auto;
        cursor:pointer;             
    }
</style>
<?php 
    $this->db->select('id');
    $this->db->where('statusPenjualan', 'pending');
    $penjualanPending   =   $this->db->get('view_penjualan');
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
                    </h4>
                </div>
            </div>
        </div>
    </div>   
    <div class="hk-sec-wrapper">         
        <div class="row">
            <div class="col-xl-12">            
                <div class="row py-3">                
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?=site_url('penjualan-baru')?>">
                            <img src="<?=base_url('assets_new/img/empty-cart.svg')?>" alt="Empty Cart" 
                                class='pb-4 img-pilihan-belanja' />
                            <p class="text-sm text-center text-muted" style='font-size:10pt;'>Anda akan memulai penjualan baru</p>
                        </a>
                    </div>             
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="<?=site_url('penjualan-pending')?>">
                            <img src="<?=base_url('assets_new/img/add-to-cart.svg')?>" alt="Add to   Cart"  
                                class='pb-4 img-pilihan-belanja' /> 
                            <?php if($penjualanPending->num_rows() >= 1){ ?>
                                <p class="text-sm text-center text-muted" style='font-size:10pt;'>
                                    Lanjutkan belanja yang belum sempat diselesaikan. Ada <span class="badge badge-info"><?=$penjualanPending->num_rows()?></span> penjualan pending.
                                </p> 
                            <?php }else{ ?>
                                <p class="text-sm text-center text-danger" style='font-size:10pt;'>
                                    Tidak Ada Penjualan Pending
                                </p> 
                            <?php } ?>  
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>