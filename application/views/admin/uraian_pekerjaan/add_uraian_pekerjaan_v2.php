<style>
    .list-autocomplete{
        padding: 5px;
    }
    .list-autocomplete:hover{
        background: lightgray;
        color: black;
        cursor: pointer;
    }
</style>

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
                                <label for="alamat">Kode/Jenis Service</label>                                
                                <input type="text" autocomplete="off" class="form-control" id="search-box" placeholder="Cari Berdasarkan Kode/Jenis Service" />
                                <div id="suggesstion-box"></div>
                                <input type="hidden" id="id_service" name="id_service" class="form-control" >                                
                            </div>                            

                            <div class="form-group" id="layout_nama_barang" style="border: 1px dotted lightgray; border-radius: 5px; padding: 5px">                                
                                <div class="row">                             
                                    <div class="col-6">
                                        <label for="alamat">Jenis Service</label>                                
                                        <h6 id="jenis_service"></h6>
                                    </div>                                       
                                    <div class="col-6">
                                        <label for="alamat">Biaya</label>                                
                                        <h6 id="harga"></h6>
                                    </div>                                    
                                </div>
                                <div class="row mt-10">
                                    <div class="col-12">
                                        <label for="alamat">Keterangan</label>                                
                                        <p id="keterangan"></p>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <input value="<?= ($data_transaksi_spare_part != null ? $data_transaksi_spare_part->qty : '') ?>" type="number" class="form-control" id="qty" name="qty" placeholder="Kuantitas" required min="1" />                                
                            </div>
                            <div class="form-group">
                                <label for="alamat">Keterangan</label>
                                <textarea class="form-control" rows="3" placeholder="Keterangan" required id="keterangan" name="keterangan"><?= ($data_transaksi_spare_part != null ? $data_transaksi_spare_part->keterangan : '') ?></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Bidang isian Keterangan wajib diisi!
                                </div>
                            </div>                                   -->
                            <button class="btn btn-success" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>