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
                            <input type="hidden" id="id"  name="id" value="<?= $data_sparepart != null ? $data_sparepart->id : ''?>">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control custom-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($data_kategori_sparepart as $key => $value) { ?>
                                        <option  <?=($data_sparepart != null ? ($data_sparepart->kategori ==  $value['kategori'] ? 'selected' : '') :'') ?> value="<?= $value['kategori'] ?>"><?= $value['kategori'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Nama Spare-Part</label>
                                <input type="text" class="form-control" placeholder="Nama Spare-Part" required id="nama_sparepart" name="nama_sparepart" value="<?= ($data_sparepart != null ? $data_sparepart->nama : '') ?>" />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Nama Spare-Part wajib diisi!
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="alamat">Harga Beli</label>
                                <input class="form-control rupiah_currency" rows="3" placeholder="Harga Beli (Rp.)" required id="harga_beli" name="harga_beli" value="<?= ($data_sparepart != null ? "Rp. ".number_format($data_sparepart->harga_beli, 0, ".", ".") : '') ?>"/>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Harga Beli wajib diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Harga Jual</label>
                                <input class="form-control rupiah_currency" rows="3" placeholder="Harga Jual (Rp.)" required id="harga_jual" name="harga_jual" value="<?= ($data_sparepart != null ? "Rp. ".number_format($data_sparepart->harga_jual, 0, ".", ".") : '') ?>" />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Harga Jual wajib diisi!
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" placeholder="Stok" required id="stok" name="stok" value="<?= ($data_sparepart != null ? $data_sparepart->stok : '') ?>" />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Harga Jual wajib diisi!
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