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
                            <input type="hidden" id="id"  name="id" value="<?= $data_transaksi_spare_part != null ? $data_transaksi_spare_part->id : ''?>">
                            <input type="hidden" id="id_perintah_kerja"  name="id_perintah_kerja" value="<?=$data_perintah_kerja->id?>">
                            <div class="form-group">
                                <label for="alamat">Kode Barang</label>                                
                                <input type="text" autocomplete="off" class="form-control" id="search-box" placeholder="Cari Berdasarkan Kode Barang Atau Namanya" />
                                <div id="suggesstion-box"></div>
                                <input type="hidden" id="id_barang"  name="id_barang" class="form-control" >                                
                            </div>                            

                            <div class="form-group" id="layout_nama_barang" style="border: 1px dotted lightgray; border-radius: 5px; padding: 5px">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="alamat">Nama Barang</label>                                
                                        <h6 id="nama_barang"></h6>
                                    </div>
                                    <div class="col-6">
                                        <label for="alamat">Kategori Barang</label>                                
                                        <h6 id="kategori_barang"></h6>                                        
                                    </div>
                                </div>
                                <div class="row mt-10">                                
                                    <div class="col-6">
                                        <label for="alamat">Harga</label>                                
                                        <h6 id="harga_barang"></h6>
                                    </div>
                                    <div class="col-6">
                                        <label for="alamat">Stok</label>                                
                                        <h6 id="stok_barang"></h6>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
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
                            </div>                                  
                            <button class="btn btn-success" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>