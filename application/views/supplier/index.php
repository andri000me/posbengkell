<style type='text/css'>
    .opsi{
        font-size:12.5pt;
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
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right pr-0">
                    <a href='<?=site_url("add-supplier")?>'>
                        <button class="btn btn-success">
                            <span class="fa fa-plus-circle mr-2"></span>
                            Supplier Baru
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-xl-12">            
            <div class="row">                
                <div class="col-md-12">
                    <div class="row">   
                        <div class="col-md-12"> 
                            <section class="hk-sec-wrapper" style="overflow-x:auto;">                                        
                                <!-- <div class="datas"> -->
                                    <table class="table table-hover display pb-30" id='tableSupplier'>
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Nomor Telepon</th>
                                                <th>Email</th>
                                                <th>Laman Web</th>
                                                <th>Opsi</th>
                                            </tr> 
                                        </thead>
                                        
                                    </table>
                                <!-- </div>    -->
                            </section>                                                                       
                        </div>
                    </div>                  
                </div>              
            </div>
        </div>
    </div>
</div>