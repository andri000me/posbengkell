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
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    .btn-diskon{
        height: 20px; font-size: 10px; line-height: 5px;
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
                <div class="col-md-5">
                    <label> <i class="fa fa-bell"></i> Penerimaan Siap dibayar</label>                    
                    <div class="row ml-1 mb-4"> 
                        <div class="scrolling-wrapper">
                        <?php foreach ($data_penerimaan as $key => $value) { ?>
                            <div class="card card-sm ml-1 mr-1">
                                <div class="card-body">
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
                        <b>*Silahkan Pilih lebih dahulu Kendaraan yang sudah diservis untuk melakukan pembayaran </b>
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
                <div class="col-md-7">          
                    <div class="row">
                        <div class="col-md-12 mb-10">
                            <label> <i class="fa fa-money"></i> Tagihan</label>                            
                            <section class="hk-sec-wrapper" style="overflow-x:auto;">
                                <label>Spare-Part</label>                           
                                <button class="btn btn-danger btn-diskon" id="btn-diskon-sparepart" data-toggle="modal" data-target="#modal-diskon-sparepart" data-effect="effect-slide-in-bottom">0% Diskon</button>                                                
                                <table class="table table-hover w-100 display pb-30">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Keterangan</th>
                                            <th>Kuantitas</th>
                                            <th>Harga Jual</th>
                                        </tr> 
                                    </thead>
                                    <tbody id="trx_sparepart"></tbody>                                    
                                </table>
                                <hr style="margin-top: 10px; margin-bottom: 10px">
                                <label>Uraian Pekerjaan</label>          
                                <button class="btn btn-danger btn-diskon" id="btn-diskon-pekerjaan" data-toggle="modal" data-target="#modal-diskon-pekerjaan" data-effect="effect-slide-in-bottom">0% Diskon</button>     

                                <table class="table table-hover w-100 display pb-30">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th colspan="2">Keterangan</th>
                                            <th style="text-align: right;">Biaya Pekerjaan</th>
                                        </tr> 
                                    </thead>
                                    <tbody id="uraian_pekerjaan"></tbody>                                    
                                </table>
                            </section>
                        </div>    
                    </div>    
                    <div class="row">
                        <div class="col-md-12">
                            <form class="needs-validation" novalidate id="form-add-new">
                                <input type="hidden" name="id_penerimaan" id="id_penerimaan">          
                                <input type="hidden" name="id_perintah_kerja" id="id_perintah_kerja">          
                                <input type="hidden" class="readonly" name="diskon_sparepart" id="diskon_sparepart_value">          
                                <input type="hidden" class="readonly" name="diskon_service" id="diskon_service_value">          

                                <!-- <div class="col-md-12 mb-10"> -->
                                    <label> <i class="fa fa-money"></i> Tagihan</label>                            
                                    <section class="hk-sec-wrapper">
                                        <div class="row">
                                            <div class="col-md-4" style="display: none;">
                                                <div class="form-group">
                                                    <label for="bayar">Diskon (%)</label>
                                                    <input disabled min="1" max="100" type="number" style="text-align: right;" class="form-control" name="diskon" id="diskon" placeholder="Diskon (%)" value="0">
                                                </div>                                      
                                            </div>
                                            <div class="col-md-12">
                                                <!-- <input type="hidden" id="ppn" name="ppn"> -->
                                                <div class="form-group">
                                                    <label for="bayar">Total</label>
                                                    <input type="text" style="text-align: right;" class="form-control readonly" name="total" id="total" placeholder="Rp. 0" required>
                                                    <p style="text-align: right; margin: 5px">
                                                        <sup style="font-size: 10px; color: #eb4034">*(PPN 10%)</sup>
                                                        <!-- <b id="ppn_display" style="display: none;">0</b> -->
                                                    </p>
                                                </div>                                                    
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="bayar">Bayar</label>
                                            <input type="text" style="text-align: right;" class="form-control bayar" name="bayar" id="bayar" placeholder="Rp. 0" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Bidang isian Bayar Wajib diisi!
                                            </div>
                                        </div>                                                                              
                                        <div class="form-group">
                                            <label for="kembalian">Kembalian</label>
                                            <input type="text" style="text-align: right;" class="form-control readonly" name="kembalian" id="kembalian" placeholder="Rp. 0" required>
                                        </div>
                                        <button class="btn btn-success disabled" type="submit" disabled id="submit-form-bayar">Submit form</button>                                      
                                    </section>                                    
                                <!-- </div>     -->
                            </form>                         
                        </div>  
                    </div>      
                    
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
