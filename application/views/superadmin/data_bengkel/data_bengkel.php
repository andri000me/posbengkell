  <div class="container-fluid px-xxl-65 px-xl-20">
      <div class="hk-pg-header">
          <h4 class="hk-pg-title">
            <span class="pg-title-icon">
              <span class="feather-icon">
                <i data-feather="database"></i>
              </span>
            </span>Data <?=$subtitle_small?>
          </h4>   
          <a style="font-size: 13px" href="<?=base_url('add-bengkel')?>" class='btn btn-success'><i class="fa fa-plus"></i> <?= $subtitle_small ?></a>       
      </div>            
      <div class="row">
          <div class="col-xl-12">
              <section class="hk-sec-wrapper">                  
                  <div class="row">
                      <div class="col-sm">
                          <div class="table-wrap">
                              <table id="konten" class="table table-hover w-100 display pb-30">
                                  <thead>
                                      <tr>
                                          <th>Id</th>                    
                                          <th>Nama Pemilik</th>
                                          <th>No. NPWP</th>
                                          <th>No. Telepon</th>
                                          <th>Alamat</th>
                                          <th>Foto</th>
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