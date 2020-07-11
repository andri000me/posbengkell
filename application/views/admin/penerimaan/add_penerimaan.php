<style type="text/css">
    /*.condition{
        columns: 3
    }*/
    .condition li{
        width: 200px;
        float: left;
        margin: 5px
    }
</style>
<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>
            <?=$subtitle_small?></h4>
    </div>
    <div class="row">
        <div class="col-xl-12">            
            <div class="row">
                <div class="col-md-6">
                    <form class="needs-validation" novalidate id="form-add-new">                                                
                        <input type="hidden" name="id" id="id" value="<?=($data_penerimaan != null ? $data_penerimaan->id : "") ?>">          
                        <div class="col-md-12 mb-10">
                            <label> <i class="ion ion-md-person"></i> Data Pemilik</label>
                            <section class="hk-sec-wrapper">                                 
                                <div class="form-group">
                                    <label for="no_pkb">No. PKB</label>
                                    <input type="text" class="form-control readonly" name="no_pkb" id="no_pkb" placeholder="No. PKB" 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->no_pkb : $id_bengkel."-".time()) ?>" >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian No. PKB Wajib diisi!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_pemilik">Nama Pemilik</label>
                                    <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" placeholder="Nama Pemilik" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->nama_pemilik : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Nama Pemilik Wajib diisi!
                                    </div>
                                </div>      
                                <div class="form-group">
                                    <label for="email_pemilik">Email Pemilik</label>
                                    <input type="email" class="form-control" name="email_pemilik" id="email_pemilik" placeholder="Email Pemilik" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->email_pemilik : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Email Pemilik Wajib diisi!
                                    </div>
                                </div>      
                                <div class="form-group">
                                    <label for="no_telepon">No. Telepon</label>
                                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="No. Telepon Pemilik" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->telepon_pemilik : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian No. Telepon Wajib diisi!
                                    </div>
                                </div>           

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" rows="1" placeholder="Alamat" required id="alamat" name="alamat"><?=($data_penerimaan != null ? $data_penerimaan->alamat_pemilik : "") ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Alamat wajib diisi!
                                    </div>
                                </div>   
                            </section>           
                        </div>   
                        <div class="col-md-12 mb-10">
                            <label> <i class="ion ion-md-car"></i> Data Kendaraan</label>
                            <section class="hk-sec-wrapper">                                        
                                <div class="form-group">
                                    <label for="no_polisi">No. Polisi</label>
                                    <input type="text" class="form-control" name="no_polisi" id="no_polisi" placeholder="No. Polisi" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->no_polisi : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian No. Polisi Wajib diisi!
                                    </div>
                                </div>         

                                <div class="form-group">
                                    <label for="tahun_produksi">Tahun Produksi</label>
                                    <input type="number" class="yearpicker form-control" id="tahun_produksi" name="tahun_produksi" value="<?=($data_penerimaan != null ? $data_penerimaan->tahun_produksi : "") ?>"/>
                                    
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Tahun Produksi Wajib diisi!
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label for="no_rangka">No. Rangka</label>
                                    <input type="text" class="form-control" name="no_rangka" id="no_rangka" placeholder="No. Rangka" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->no_rangka : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian No. Rangka Wajib diisi!
                                    </div>
                                </div>         

                                <div class="form-group">
                                    <label for="no_mesin">No. Mesin</label>
                                    <input type="text" class="form-control" name="no_mesin" id="no_mesin" placeholder="No. Mesin" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->no_mesin : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian No. Mesin Wajib diisi!
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="no_mesin">Tipe / Warna</label>
                                    <input type="text" class="form-control" name="tipe_warna" id="tipe_warna" placeholder="Tipe / Warna" required 
                                    value="<?=($data_penerimaan != null ? $data_penerimaan->tipe_warna : "") ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Tipe / Warna Wajib diisi!
                                    </div>
                                </div>   
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="bahan_bakar">Kilometer</label>
                                        <input value="<?=($data_penerimaan != null ? $data_penerimaan->kilometer : "") ?>" class="form-control" type="number" id="kilometer" name="kilometer" placeholder="1000 km" />                                 
                                    </div>      
                                    <div class="form-group col-md-6">
                                        <label for="bahan_bakar">Bahan Bakar (Skala 1-5)</label>
                                        <input class="range-slider" id="bahan_bakar" name="bahan_bakar" value="4" />                                 
                                    </div>   
                                </div> 
                            </section>                                                             
                            <button class="btn btn-success" type="submit">Submit form</button>                           
                        </div>    
                    </form>
                    <hr>
                    <a style="margin: 5px"  target="_blank" href="<?=base_url('dokumen-serah-terima/'. ($data_penerimaan != null ? $data_penerimaan->id : "") )?>" class="btn btn-success <?= ($data_penerimaan == null ? 'disabled' : '') ?>" > <i class="ion ion-md-print"></i> Print Penerimaan</a>
                    <a style="margin: 5px" href="<?=base_url('data-keluhan-permintaan/'. ($data_penerimaan != null ? $data_penerimaan->id : "") ) ?>" class="btn btn-warning <?= ($data_penerimaan == null ? 'disabled' : '') ?>">Keluhan & Permintaan Pelanggan</a>
                    
                </div>
                <div class="col-md-6">
                    <label> <i class="ion ion-md-list"></i> Perlengkapan dan kendaraan ketika diterima</label>
                    <section class="hk-sec-wrapper" style="overflow-x:auto;">
                        <button style="margin: 10px 0" <?=($data_penerimaan != null ? '' : 'disabled') ?> class='btn btn-success' data-toggle="modal" data-target="#modal" data-effect="effect-slide-in-bottom"> <i class="fa fa-plus"></i> Kondisi Kendaraan</button>
                        <table id="konten" class="table table-hover w-100 display pb-30">
                          <thead>
                              <tr>
                                  <th>Id</th>                                          
                                  <th>Perlengkapan</th>                                          
                                  <th>Baik</th>                                          
                                  <th>Rusak</th>                                          
                                  <th>Tidak Ada</th>  
                                  <th>Aksi</th>                                          
                              </tr>
                          </thead>
                      </table>
                  </section>
                </div>
            </div>
        </div>
    </div>
</div>