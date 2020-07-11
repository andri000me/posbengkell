<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span><?=$subtitle_small?></h4>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">                
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" novalidate id="form-add-new">
                            <input type="hidden" id="id"  name="id" value="<?= $data_library_service != null ? $data_library_service->id : ''?>">                            
                            <div class="form-group">
                                <label for="alamat">Nama Service</label>
                                <input type="text" class="form-control" placeholder="Nama Service" required id="service" name="service" value="<?= ($data_library_service != null ? $data_library_service->service : '') ?>" />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Nama Service wajib diisi!
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="alamat">Biaya Service</label>
                                <input class="form-control rupiah_currency" placeholder="Biaya" required id="biaya" name="biaya" value="<?= ($data_library_service != null ? "Rp. ".number_format($data_library_service->biaya, 0, ".", ".") : '') ?>"/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Biaya wajib diisi!
                                </div>
                            </div>        
                            <div class="form-group">
                                <label for="tipe_keuntungan">Tipe Keuntungan</label>
                                <select class="form-control custom-select" id="tipe_keuntungan" name="tipe_keuntungan" required>
                                    <option <?=($data_library_service != null ? ($data_library_service->tipe_keuntungan ==  0 ? 'selected' : '') :'') ?> value="0">Persen (%)</option>
                                    <option <?=($data_library_service != null ? ($data_library_service->tipe_keuntungan ==  1 ? 'selected' : '') :'') ?> value="1">Nominal (Rp)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Nilai Keuntungan</label>
                                <input class="form-control" type="number" placeholder="Nilai Keuntungan (% atau Nominal Rupiah)" required id="nilai_keuntungan" name="nilai_keuntungan" value="<?= ($data_library_service != null ? $data_library_service->nilai_keuntungan : '') ?>"/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Biaya wajib diisi!
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="alamat">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"><?= ($data_library_service != null ? $data_library_service->keterangan : "") ?></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Keterangan wajib diisi!
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