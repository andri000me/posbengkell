<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span><?=$subtitle_small?></h4>
    </div>
    <div class="row">
        <div class="col-xl-12">            
            <label> <i class="ion ion-md-person"></i> Pemilik Bengkel</label>
            <section class="hk-sec-wrapper">                
                <div class="row">
                    <div class="col-3">
                      <center>
                        <object data="<?= $data_bengkel != null ? base_url('upload/'. $data_bengkel->foto) : '' ?>" type="image/png" class="figure-img w-200p img-fluid rounded">
                           <img src="<?=base_url('assets_new/img/img-thumb.jpg')?>" />
                        </object>
                      </center> 

                        <form class="form-horizontal" id="image-logo">
                            <div class="form-group">
                                <input type="file" name="file" class="form-control btn">
                            </div>             
                            <div class="form-group">
                                <button class="btn btn-success" id="btn_upload" type="submit">Ganti</button>
                            </div>
                        </form>   
                    </div>
                    <div class="col-sm">
                        <form class="needs-validation" novalidate id="form-add-new">
                            <input type="hidden" id="id"  name="id">
                            <div class="form-group">    
                                <label for="alamat">Atas Nama</label>
                                <input value="<?= $data_bengkel != null ? $data_bengkel->nama_pemilik : '' ?>" type="text" class="form-control" placeholder="Atas Nama" required id="nama_pemilik" name="nama_pemilik">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Nama Pemilik wajib diisi!
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="alamat">NPWP</label>
                                <input value="<?= $data_bengkel != null ? $data_bengkel->no_npwp : '' ?>" type="text" class="form-control" placeholder="No. NPWP" required id="no_npwp" name="no_npwp">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Nomor NPWP wajib diisi!
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="alamat">No. Telepon</label>
                                <input value="<?= $data_bengkel != null ? $data_bengkel->no_telepon : '' ?>" class="form-control" rows="3" placeholder="No. Telepon" required id="no_telepon" name="no_telepon"/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian No. Telepon wajib diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" rows="3" placeholder="Alamat" required id="alamat" name="alamat"><?= $data_bengkel != null ? $data_bengkel->alamat : '' ?></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Alamat wajib diisi!
                                </div>
                            </div>

                            <button class="btn btn-success" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>