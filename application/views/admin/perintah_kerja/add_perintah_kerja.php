<style type="text/css">
    /*.condition{
        columns: 3
    }*/
    .condition li{
        width: 200px;
        float: left;
        margin: 5px
    }
    .datetimepicker td{
        padding: 5px
    }
    .minute{
        margin:5px;
    }
    .scrolling-wrapper {
      overflow-x: scroll;
      overflow-y: hidden;
      white-space: nowrap;      
    }

    .card {
        display: inline-block;
      }

    .scrolling-wrapper-flexbox {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto; 
    }

    .scrolling-wrapper {
      -webkit-overflow-scrolling: touch;
    }

    /* width */
    ::-webkit-scrollbar {
      width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }
    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
    .datas table{
        border-collapse: collapse;
    }
    .datas tr, .datas td, .datas th{
        border:1px solid #ddd;
        padding: 10px
    }
    .datas th{
        font-weight: bold;
    }
    .selected-penerimaan {
        border-radius: 50%;
        position: absolute;
        top: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        background: red
    }
    .input-group-addon {
        padding: .375rem .75rem;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }
    .disabled{
        pointer-events: none;
    }
</style>
<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>
            <?=$subtitle_small?></h4>
    </div>    
    <div class="row">
        <div class="col-xl-12">            
            <div class="row">                
                <div class="col-md-6">
                    <label> <i class="fa fa-bell"></i> Penerimaan Menunggu</label>                    
                    <div class="row ml-1 mb-4"> 
                        <div class="scrolling-wrapper">
                        <?php foreach ($data_penerimaan as $key => $value) { ?>
                            <div class="card card-sm ml-1 mr-1">
                                <div class="card-body card-task" id="pilih_<?= $value['id'] ?>">
                                    <span id="pilih_<?= $value['id'] ?>"></span>
                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase"><?= $value['tipe_warna'] ?></span>
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div>
                                            <span class="d-block">
                                                <span class="display-5 font-weight-400 text-dark  text-uppercase">
                                                    <?= $value['no_polisi'] ?>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <h4><?= $value['nama_pemilik'] ?></h4>                    
                                    <p><?= $value['telepon_pemilik'] ?></p>
                                    <button class="btn btn-success" type="button" onclick="pilih_penerimaan('<?= $value['id'] ?>')">Pilih</button>
                                </div>
                            </div>            
                        <?php } ?>
                        </div>           
                    </div>
                    <span style="color: orange; font-size: 11px">
                        <b>*Silahkan Pilih lebih dahulu Kendaraan yang sudah diterima untuk dikerjakan </b>
                    </span>
                    <div class="row mt-20">
                        <div class="col-md-6">
                            <label> <i class="ion ion-md-person"></i> Data Pemilik</label>
                            <section class="hk-sec-wrapper">
                                <!-- <div class="form-group"> -->
                                    <label for="nama_pemilik">Nama Pemilik</label><br>  
                                    <b id="nama_pemilik"></b> 
                                <!-- </div> -->
                            </section>           
                        </div>   
                        <div class="col-md-6">
                            <label> <i class="ion ion-md-car"></i> Data Kendaraan</label>
                            <section class="hk-sec-wrapper">                                        
                                <!-- <div class="form-group"> -->
                                    <label for="no_polisi">No. Polisi</label><br>   
                                    <b id="no_polisi"></b>
                                <!-- </div>    -->
                            </section>                                                                       
                        </div>    
                    </div>      
                    <div class="row">   
                        <div class="col-md-12"> 
                            <label> <i class="fa fa-bullhorn"></i> Data Permintaan & Keluhan Pelanggan</label>
                            <section class="hk-sec-wrapper">                                        
                                <!-- <div class="datas"> -->
                                    <table class="table table-hover w-100 display pb-30">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kategori</th>
                                                <th>Keterangan</th>
                                            </tr> 
                                        </thead>
                                        <tbody id="permintaan_keluhan"></tbody>
                                    </table>
                                <!-- </div>    -->
                            </section>                                                                       
                        </div>
                    </div>                  
                </div>
                <div class="col-md-6">                    
                    <form class="needs-validation" novalidate id="form-add-new">

                        <input type="hidden" name="id_penerimaan" id="id_penerimaan" value="<?= $data_perintah_kerja != null ? $data_perintah_kerja->id_penerimaan : ''?>">          
                        <input type="hidden" name="id" id="id" value="<?= $data_perintah_kerja != null ? $data_perintah_kerja->id : '' ?>">          
                        <div class="col-md-12 mb-10">
                            <label> <i class="fa fa-briefcase"></i> Data Pekerjaan</label>
                            <section class="hk-sec-wrapper">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" required 
                                    value="<?= $data_perintah_kerja != null ? $data_perintah_kerja->pekerjaan : '' ?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Pekerjaan Wajib diisi!
                                    </div>
                                </div>      
                                <div class="form-group">
                                    <label for="pelanggan">Status Pelanggan</label>
                                    <select id="pelanggan" name="pelanggan" 
                                      class="form-control select2" 
                                      data-placeholder="Choose one" 
                                      data-parsley-class-handler="#slWrapper" 
                                      data-parsley-errors-container="#slErrorContainer" 
                                      required>
                                      <option label="Choose one"></option>
                                      <option <?= $data_perintah_kerja != null ? ($data_perintah_kerja->pelanggan == 'Ditunggu' ? 'selected' : '') : '';?> value="Ditunggu" label="Ditunggu"></option>
                                      <option <?= $data_perintah_kerja != null ? ($data_perintah_kerja->pelanggan == 'Ditinggal' ? 'selected' : '') : '';?> value="Ditinggal" label="Ditinggal"></option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang isian Status Pelanggan Wajib diisi!
                                    </div>
                                </div>                                           
                                <div class="form-group">
                                    <label for="teknisi">Pilih Teknisi</label>
                                        <select id="id_teknisi" name="id_teknisi" 
                                          class="form-control select2" 
                                          data-placeholder="Choose one" 
                                          data-parsley-class-handler="#slWrapper" 
                                          data-parsley-errors-container="#slErrorContainer" 
                                          required>
                                          <option label="Choose one"></option>
                                          <?php foreach ($teknisi as $key => $value) { ?>
                                                <option <?= $data_perintah_kerja != null ? ($data_perintah_kerja->id_teknisi == $value['id'] ? 'selected' : '') : '';?> value="<?=$value['id']?>" label="<?=$value['nama']?>"></option>
                                          <?php  } ?>
                                      </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang Pilihan Teknisi Wajib dipilih!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="teknisi">Pilih Admin Gudang</label>
                                        <select id="id_gudang" name="id_gudang" 
                                          class="form-control select2" 
                                          data-placeholder="Choose one" 
                                          data-parsley-class-handler="#slWrapper" 
                                          data-parsley-errors-container="#slErrorContainer" 
                                          required>
                                          <option label="Choose one"></option>
                                          <?php foreach ($gudang as $key => $value) { ?>
                                                <option <?= $data_perintah_kerja != null ? ($data_perintah_kerja->id_gudang == $value['id'] ? 'selected' : '') : '';?> value="<?=$value['id']?>" label="<?=$value['nama']?>"></option>
                                          <?php  } ?>
                                      </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Bidang Pilihan Teknisi Wajib dipilih!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dtp_input1" class="control-label">Tgl/Jam Appointment</label>
                                    <div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">                                        
                                        <input class="form-control readonly" size="16" type="text" value="<?= $data_perintah_kerja != null ? date("d F Y H:i a", strtotime($data_perintah_kerja->tgl_jam_appointment)) : "";?>" required>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian Tgl/Jam Appointment Wajib diisi!
                                        </div> 
                                    </div>
                                    <input type="hidden" id="dtp_input1" name="tgl_jam_appointment" value="<?= $data_perintah_kerja != null ? $data_perintah_kerja->tgl_jam_appointment : '' ?>"/>
                                </div>   
                                <div class="form-group">
                                    <label for="dtp_input2" class="control-label">Tgl/Jam Penyerahan</label>
                                    <div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
                                        <input class="form-control readonly" size="16" type="text" value="<?= $data_perintah_kerja != null ? date("d F Y H:i a", strtotime($data_perintah_kerja->tgl_jam_penyerahan)) : "" ?>" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian Tgl/Jam Penyerahan Wajib diisi!
                                        </div>     
                                    </div>
                                    <input type="hidden" id="dtp_input2" name="tgl_jam_penyerahan" value="<?= $data_perintah_kerja != null ? $data_perintah_kerja->tgl_jam_penyerahan : '' ?>" />
                                </div>   
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                      <input <?= $data_perintah_kerja != null ? ($data_perintah_kerja->stnk == 1 ? 'checked' : '') : '' ?> type="checkbox" class="custom-control-input" name="stnk" id="stnk">
                                      <label class="custom-control-label" for="stnk">Ada Surat Tanda Nomor Kendaraan (STNK) </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                      <input <?= $data_perintah_kerja != null ? ($data_perintah_kerja->buku_service == 1 ? 'checked' : '') : '' ?> type="checkbox" class="custom-control-input" name="buku_service" id="buku_service">
                                      <label class="custom-control-label" for="buku_service">Ada Buku Service </label>
                                    </div>
                                </div>
                            </section>                                                           
                            <button class="btn btn-success disabled" type="submit" disabled id="submit-form">Submit form</button>
                        </div>    
                    </form>     

                    <span style="color: orange; font-size: 11px; font-weight: bold; margin: 5px">*Silahkan Lengkapi lebih dahulu Form Data Pekerjaan diatas</span>               
                </div>                
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12"> 
                    <label> <i class="fa fa-list"></i> Data Uraian Pekerjaan</label>
                    <a href="<?=base_url('add-uraian-pekerjaan/'. ($data_perintah_kerja != null ? $data_perintah_kerja->id : ''))?>"  style="float: right" class="btn btn-success <?= ($data_perintah_kerja == null ? 'disabled' : '' ) ?>" id="add_uraian_pekerjaan"> <i class="ion ion-md-add"></i> Uraian </a>

                    <section class="hk-sec-wrapper mt-10">      
                        <table id="konten_uraian_pekerjaan"  class="table table-hover w-100 display pb-30">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Keterangan</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr> 
                            </thead>
                        </table>
                    </section>                                                                  
                </div>                
                <div class="col-md-12"> 
                    <label> <i class="fa fa-list"></i> Data Spare Part</label>
                    <a href="<?=base_url('add-transaksi-sparepart/'. ($data_perintah_kerja != null ? $data_perintah_kerja->id : ''))?>"  style="float: right" class="btn btn-success <?= ($data_perintah_kerja == null ? 'disabled' : '' ) ?>" id="add_uraian_pekerjaan"> <i class="ion ion-md-add"></i> Transaksi Spare-Part </a>
                    <section class="hk-sec-wrapper mt-10">      
                        <table id="konten_transaksi_sparepart"  class="table table-hover w-100 display pb-30">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Spare Part</th>
                                    <th>Qty</th>
                                    <th>Harga</th>                                    
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr> 
                            </thead>
                        </table>
                    </section>                                                                  
                </div>                
            </div>                                
            <!-- <a href="<?=base_url('final-check/'. ($data_perintah_kerja != null ? $data_perintah_kerja->id : "") )?>" style="margin-left: 15px" class="btn btn-warning"> <i class="ion ion-md-check"></i> Final Check</a>             -->

            <a target="_blank" href="<?=base_url('dokumen-perintah-kerja/'. ($data_perintah_kerja != null ? $data_perintah_kerja->id : "") )?>" style="margin-left: 15px" class="btn btn-success" > <i class="ion ion-md-print"></i> Print Perintah Kerja</a>
            <br>
            <hr>
            <!-- <b style="color: #dc3545"><?=isset($final_check) ? ($final_check->status == 1 ? 'Final Check Sudah Selesai dilakukan' : '' ) : '' ?></b> -->
        </div>
    </div>
</div>