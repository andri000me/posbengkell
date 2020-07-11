<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span><?=$subtitle_small?></h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label> <i class="ion ion-md-person"></i> Data Pemilik</label>
            <section class="hk-sec-wrapper">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <b><?=($data_penerimaan != null ? $data_penerimaan->nama_pemilik : "") ?></b> 
                </div>
                <div class="form-group">
                    <label for="no_telepon">No. Telepon</label>
                    <b><?=($data_penerimaan != null ? $data_penerimaan->telepon_pemilik : "") ?></b>
                </div>
            </section>           
        </div>   
        <div class="col-md-6">
            <label> <i class="ion ion-md-car"></i> Data Kendaraan</label>
            <section class="hk-sec-wrapper">                                        
                <div class="form-group">
                    <label for="no_polisi">No. Polisi</label>
                    <b><?=($data_penerimaan != null ? $data_penerimaan->no_polisi : "") ?></b>
                </div>   
                <div class="form-group">
                    <label for="no_mesin">Tipe / Warna</label>
                    <b><?=($data_penerimaan != null ? $data_penerimaan->tipe_warna : "") ?></b>
                </div>    
            </section>                                                                       
        </div>    
    </div>
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">                
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" novalidate id="form-add-new">
                            <input type="hidden" id="id"  name="id" value="<?= $data_keluhan_permintaan != null ? $data_keluhan_permintaan->id : ''?>">
                            <input type="hidden" id="id_penerimaan"  name="id_penerimaan" value="<?=$data_penerimaan->id?>">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control custom-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Keluhan" <?= ($data_keluhan_permintaan != null ? ($data_keluhan_permintaan->kategori == "Keluhan" ? 'selected' : '') : '') ?> >Keluhan</option>
                                    <option value="Permintaan" <?= ($data_keluhan_permintaan != null ? ($data_keluhan_permintaan->kategori == "Permintaan" ? 'selected' : '') : '') ?> >Permintaan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                    <label for="alamat">Keterangan</label>
                                    <textarea class="form-control" rows="3" placeholder="Keterangan" required id="keterangan" name="keterangan"><?= ($data_keluhan_permintaan != null ? $data_keluhan_permintaan->keterangan : '') ?></textarea>
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