<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span><?=$subtitle_small?></h4>
    </div>
    <div class="row">
        <div class="col-md-6"> 
            <label> <i class="fa fa-list"></i> Data Uraian Pekerjaan</label>                        
            <section class="hk-sec-wrapper mt-10">      
                <table id="konten_uraian_pekerjaan"  class="table table-hover w-100 display pb-30">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Estimasi Biaya</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php foreach ($uraian_pekerjaan as $key => $value) { ?>
                            <tr>
                                <td><?=$value['keterangan']?></td>
                                <td><?=$value['estimasi_biaya']?></td>                                
                                <td><?=$value['biaya']?></td>                                
                                <td><?= $value['status'] == 0 ? "Proses" : "Selesai" ?></td>
                                <td> 
                                    <button  style="margin:2px" class="btn btn-primary" title="Tetapkan Biaya" onclick="fixingPrice('<?= $value['id'] ?>')">
                                    <i class="fa fa-check"></i></button>  </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </section>                                                                  
        </div>                
        <div class="col-md-6"> 
            <label> <i class="fa fa-list"></i> Data Transaksi Spare Part</label>                        
            <section class="hk-sec-wrapper mt-10">      
                <table id="konten_transaksi_sparepart"  class="table table-hover w-100 display pb-30">
                    <thead>
                        <tr>
                            <th>Spare Part</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th>Harga Jual</th>
                            <th>Status</th>
                        </tr> 
                    </thead>
                    <tbody>                        
                        <?php foreach ($transaksi_sparepart as $key => $value) { ?>
                            <tr>
                                <td><?=$value['nama_barang']?></td>
                                <td><?=$value['qty']?></td>
                                <td><?=$value['keterangan']?></td>
                                <td><?=$value['harga_jual']?></td>
                                <td><?= $value['status'] == 0 ? "Proses" : "Selesai" ?></td>
                            </tr>
                        <?php }?>                        
                    </tbody>
                </table>
            </section>                                                                  
        </div>                
    </div>             

    <div class="row">
        <div class="col-xl-12">            
            <label> <i class="ion ion-md-person"></i> Pemeriksaan Akhir Sebelum Penyerahan</label>
            <section class="hk-sec-wrapper">      
                <div class="row">
                    <div class="col-sm">                        
                        <form class="needs-validation" novalidate id="form-add-new">
                            <input type="hidden" id="id"  name="id">
                            <input type="hidden" id="id_perintah_kerja"  name="id_perintah_kerja" value="<?= $perintah_kerja->id ?>">
                            <input type="hidden" id="id_penerimaan"  name="id_penerimaan" value="<?= $id_penerimaan ?>">                            
                            <div class="form-group">
                                <label for="alamat">Hasil Penemuan/Saran </label>
                                <textarea class="form-control" rows="3" placeholder="Hasil Penemuan atau Saran" id="penemuan_saran" name="penemuan_saran"><?= $final_check != null ? $final_check->penemuan_saran : "" ?></textarea>                                
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input <?= $final_check != null ? ($final_check->kebersihan_kendaraan_dalam == 1 ? 'checked' : '') : '' ?> type="checkbox" class="custom-control-input" name="kebersihan_kendaraan_dalam" id="kebersihan_kendaraan_dalam">
                                  <label class="custom-control-label" for="kebersihan_kendaraan_dalam">Kebersihan Kendaraan bagian dalam</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input <?= $final_check != null ? ($final_check->kebersihan_kendaraan_luar == 1 ? 'checked' : '') : '' ?> type="checkbox" class="custom-control-input" name="kebersihan_kendaraan_luar" id="kebersihan_kendaraan_luar">
                                  <label class="custom-control-label" for="kebersihan_kendaraan_luar">Kebersihan Kendaraan bagian luar</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input <?= $final_check != null ? ($final_check->kelengkapan_kendaraan == 1 ? 'checked' : '') : '' ?>  type="checkbox" class="custom-control-input" name="kelengkapan_kendaraan" id="kelengkapan_kendaraan">
                                  <label class="custom-control-label" for="kelengkapan_kendaraan">Kelengkapan Kendaraan (STNK, Tool Kits, dll)</label>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input <?= $final_check != null ? ($final_check->part_bekas == 1 ? 'checked' : '') : '' ?> type="checkbox" class="custom-control-input" name="part_bekas" id="part_bekas">
                                  <label class="custom-control-label" for="part_bekas">Part Bekas</label>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input <?= $final_check != null ? ($final_check->status == 1 ? 'checked' : '') : 'checked' ?> type="checkbox" class="custom-control-input" name="status" id="status">
                                  <label class="custom-control-label" for="status">Status Final Check (Not Oke / Oke)</label>
                                </div>
                            </div>


                            <button class="btn btn-success" <?=$final_check_available == 0 ? 'disabled' : '' ?>  type="submit">Submit form</button>

                            <br>
                            <b style="color: #dc3545"><?=$final_check != null ? ($final_check->status == 1 ? 'Final Check Sudah Selesai dilakukan' : '' ) : '' ?></b>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>