<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">
            <span class="pg-title-icon">
                <span class="feather-icon">
                    <i data-feather="external-link"></i>
                </span>
            </span>
            <?=$subtitle_small?>
            <?php if($detailSupplier !== false){ ?>
                <span class='text-info text-bold ml-2'><?=strtoupper($detailSupplier->nama)?></span>
            <?php } ?>
        </h4>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">                
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" novalidate id="formSupplier">                          
                            <div class="form-group">
                                <label for="nama">Nama Supplier</label>
                                <input type="text" class="form-control" placeholder="Nama Supplier" required id="nama" name="nama"
                                    value='<?=($detailSupplier !== false)? $detailSupplier->nama : ''?>' />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Nama Supplier wajib diisi!
                                </div>
                            </div>                                  
                            <div class="form-group">
                                <label for="alamat">Alamat Supplier</label>
                                <textarea class="form-control" placeholder="Alamat Supplier" required id="alamat" 
                                    name="alamat"><?=($detailSupplier !== false)? $detailSupplier->alamat : ''?></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Alamat Supplier wajib diisi!
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="telepon">Telepon Supplier</label>
                                <input type="number" class="form-control" placeholder="Telepon Supplier" required id="telepon" name="telepon"
                                    value='<?=($detailSupplier !== false)? $detailSupplier->telepon : ''?>' />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Telepon Supplier wajib diisi!
                                </div>
                            </div>                          
                            <div class="form-group">
                                <label for="email">Email Supplier</label>
                                <input type="email" class="form-control" placeholder="Email Supplier" required id="email" name="email" 
                                    value='<?=($detailSupplier !== false)? $detailSupplier->email : ''?>'/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Email Supplier wajib diisi!
                                </div>
                            </div>                     
                            <div class="form-group">
                                <label for="lamanWeb">Laman Web Supplier</label>
                                <input type="text" class="form-control" placeholder="lamanWeb Supplier" id="lamanWeb" name="lamanWeb"
                                    value='<?=($detailSupplier !== false)? $detailSupplier->lamanWeb : ''?>' />
                            </div>
                            <hr />                        
                            <button class="btn btn-success" type="submit">
                                Simpan <?=($detailSupplier !== false)? 'Perubahan Data' : ''?> Supplier
                            </button>
                            <a href='<?=site_url('supplier')?>'>
                                <button class="btn btn-danger ml-2" type="button">Back to List Supplier</button>
                            </a>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>