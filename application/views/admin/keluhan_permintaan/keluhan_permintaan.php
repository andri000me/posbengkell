  <div class="container-fluid px-xxl-65 px-xl-20">
      <div class="hk-pg-header">                            
            <a href="<?= base_url('edit-penerimaan/'.  $data_penerimaan->id)?>" class="btn btn-danger">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>

          <h4 class="hk-pg-title">
            <span class="pg-title-icon">
              <span class="feather-icon">
                <i data-feather="database"></i>
              </span>
            </span>Data <?=$subtitle_small?>
          </h4>
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

          <a style="font-size: 13px; margin-bottom: 10px" href="<?=base_url('add-keluhan-permintaan/'.$data_penerimaan->id)?>" class='btn btn-success'><i class="fa fa-plus"></i> <?= $subtitle_small ?></a>

                  <div class="row">
                      <div class="col-sm">
                          <div class="table-wrap">
                              <input type="hidden" id="id_penerimaan" value="<?=$data_penerimaan->id?>">
                              <table id="konten" class="table table-hover w-100 display pb-30">
                                  <thead>
                                      <tr>
                                          <th>Id</th>                                          
                                          <th>Kategori</th>                                          
                                          <th>Keterangan</th>                                          
                                          <th>Aksi</th>                                                    
                                      </tr>
                                  </thead>
                              </table>
                          </div>
                      </div>
                  </div>
              </section>
          </div>
      </div>
  </div>