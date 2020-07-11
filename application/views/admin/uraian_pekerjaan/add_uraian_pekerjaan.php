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
                            <input type="hidden" id="id"  name="id" value="<?= $data_uraian_pekerjaan != null ? $data_uraian_pekerjaan->id : ''?>">
                            <input type="hidden" id="id_perintah_kerja"  name="id_perintah_kerja" value="<?=$data_perintah_kerja->id?>">
                            <div class="form-group">
                                <label for="alamat">Estimasi Biaya</label>
                                <input class="form-control" rows="3" value="<?= ($data_uraian_pekerjaan != null ? "Rp. ".number_format($data_uraian_pekerjaan->estimasi_biaya, 0, ".", ".") : '') ?>" placeholder="Estimasi Biaya (Rp.)" required id="estimasi_biaya" name="estimasi_biaya"/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Estimasi Biaya wajib diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Keterangan</label>
                                <textarea class="form-control" rows="3" placeholder="Keterangan" required id="keterangan" name="keterangan"><?= ($data_uraian_pekerjaan != null ? $data_uraian_pekerjaan->keterangan : '') ?></textarea>
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