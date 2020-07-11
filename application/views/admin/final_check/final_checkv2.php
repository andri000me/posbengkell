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
                    <label> <i class="fa fa-bell"></i> Selesai Dikerjakan</label>                    
                    <div class="row ml-1 mb-4"> 
                        <div class="scrolling-wrapper">
                        <?php 
                        foreach ($perintah_kerja as $key => $value) { ?>
                            <div class="card card-sm ml-1 mr-1">
                                <div class="card-body card-task" id="pilih_<?= $value['id'] ?>">
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
                                    <button class="btn btn-success" type="button" onclick="pilih_perintah_kerja('<?= $value['id'] ?>')">Pilih</button>
                                </div>
                            </div>            
                        <?php } ?>
                        </div>           
                    </div>
                    <span style="color: orange; font-size: 11px">
                        <b>*Silahkan Pilih lebih dahulu Kendaraan yang sudah dikerjakan untuk dilakukan FINAL CHECK </b>
                    </span>
                </div>          
                <div class="col-md-6">
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
                </div>   
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6"> 
                    <label> <i class="fa fa-list"></i> Data Uraian Pekerjaan</label>                        
                    <section class="hk-sec-wrapper mt-10">      
                        <table id="konten_uraian_pekerjaan"  class="table table-hover w-100 display pb-30">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <!-- <th>Estimasi Biaya</th> -->
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr> 
                            </thead>
                            <tbody id="uraian_pekerjaan"></tbody>                    
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
                            <tbody id="transaksi_sparepart"></tbody>              
                        </table>
                    </section>                                                                  
                </div>                
            </div>   
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
                            <input type="hidden" id="id_perintah_kerja"  name="id_perintah_kerja">
                            <input type="hidden" id="id_penerimaan"  name="id_penerimaan">                            
                            <div class="form-group">
                                <label for="alamat">Hasil Penemuan/Saran </label>
                                <textarea class="form-control" rows="3" placeholder="Hasil Penemuan atau Saran" id="penemuan_saran" name="penemuan_saran"></textarea>                                
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="kebersihan_kendaraan_dalam" id="kebersihan_kendaraan_dalam">
                                  <label class="custom-control-label" for="kebersihan_kendaraan_dalam">Kebersihan Kendaraan bagian dalam</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="kebersihan_kendaraan_luar" id="kebersihan_kendaraan_luar">
                                  <label class="custom-control-label" for="kebersihan_kendaraan_luar">Kebersihan Kendaraan bagian luar</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="kelengkapan_kendaraan" id="kelengkapan_kendaraan">
                                  <label class="custom-control-label" for="kelengkapan_kendaraan">Kelengkapan Kendaraan (STNK, Tool Kits, dll)</label>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="part_bekas" id="part_bekas">
                                  <label class="custom-control-label" for="part_bekas">Part Bekas</label>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="status" id="status">
                                  <label class="custom-control-label" for="status">Status Final Check (Not Oke / Oke)</label>
                                </div>
                            </div>

                            <button id="submit-form" class="btn btn-success disabled" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>