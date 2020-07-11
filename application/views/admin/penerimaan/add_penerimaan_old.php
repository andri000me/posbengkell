<style type="text/css">
    /*.condition{
        columns: 3
    }*/
    .condition li{
        width: 200px;
        float: left;
        margin: 5px
    }
</style>
<div class="container-fluid px-xxl-65 px-xl-20">
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span><?=$subtitle_small?></h4>
    </div>
    <div class="row">
        <div class="col-xl-12">            
            <div class="row">
                <div class="col-sm">                                            
                    <form class="needs-validation" novalidate id="form-add-new">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label> <i class="ion ion-md-person"></i> Data Pemilik</label>
                                <section class="hk-sec-wrapper">
                                    <div class="form-group">
                                        <label for="nama_pemilik">Nama Pemilik</label>
                                        <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" placeholder="Pemilik" required 
                                        value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian Nama Pemilik Wajib diisi!
                                        </div>
                                    </div>      
                                    <div class="form-group">
                                        <label for="no_telepon">No. Telepon</label>
                                        <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="Pemilik" required 
                                        value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian No. Telepon Wajib diisi!
                                        </div>
                                    </div>                                           
                                    <div class="form-group">
                                        <label for="no_pkb">No. PKB</label>
                                        <input type="text" class="form-control" name="no_pkb" id="no_pkb" placeholder="No. PKB" required 
                                        value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian No. PKB Wajib diisi!
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" rows="1" placeholder="Alamat" required id="alamat" name="alamat"></textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian Alamat wajib diisi!
                                        </div>
                                    </div>   
                                </section>           
                            </div>   

                            <div class="col-md-6 mb-10">
                                <label> <i class="ion ion-md-car"></i> Data Pemilik</label>
                                <section class="hk-sec-wrapper">                                        

                                    <div class="form-group">
                                        <label for="no_rangka">No. Rangka</label>
                                        <input type="text" class="form-control" name="no_rangka" id="no_rangka" placeholder="No. Rangka" required 
                                        value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian No. Rangka Wajib diisi!
                                        </div>
                                    </div>         

                                    <div class="form-group">
                                        <label for="no_mesin">No. Mesin</label>
                                        <input type="text" class="form-control" name="no_mesin" id="no_mesin" placeholder="No. Mesin" required 
                                        value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian No. Mesin Wajib diisi!
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="no_mesin">Tipe / Warna</label>
                                        <input type="text" class="form-control" name="tipe_warna" id="tipe_warna" placeholder="Tipe / Warna" required 
                                        value="">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian Tipe / Warna Wajib diisi!
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label for="tahun_produksi">Tahun Produksi</label>
                                        <input type="number" class="yearpicker form-control" id="tahun_produksi" name="tahun_produksi" value="" />
                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Bidang isian Tahun Produksi Wajib diisi!
                                        </div>  
                                    </div>                               
                                </section>                                                             
                            </div>    
                        </div>
                        <button class="btn btn-success" type="submit">Submit form</button>
                    </form>
                </div>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="col-sm">                                            
                    <div class="form-row">
                        <div class="col-md-4x mb-10">                                 
                            <!-- <div class="row"> -->
                                <ul class="condition">
                                    <li>
                                        <section class="hk-sec-wrapper">
                                        <label>
                                            Automatic Light Switch
                                        </label>
                                        <hr>
                                        <div class="row">                                        
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Baik</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Rusak</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Tidak Ada</label>
                                                </div>
                                            </div>
                                        </div>  
                                        </section>                                   
                                    </li>
                                    <li>
                                        <section class="hk-sec-wrapper">
                                        <label>
                                            Automatic Light Switch
                                        </label>
                                        <hr>
                                        <div class="row">                                        
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Baik</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Rusak</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Tidak Ada</label>
                                                </div>
                                            </div>
                                        </div>  
                                        </section>                                   
                                    </li>
                                    <li>
                                        <section class="hk-sec-wrapper">
                                        <label>
                                            Automatic Light Switch 
                                        </label>
                                        <hr>
                                        <div class="row">                                        
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Baik</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Rusak</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Tidak Ada</label>
                                                </div>
                                            </div>
                                        </div>  
                                        </section>                                   
                                    </li>
                                    <li>
                                        <section class="hk-sec-wrapper">
                                        <label>
                                            Automatic Light Switch
                                        </label>
                                        <hr>
                                        <div class="row">                                        
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Baik</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Rusak</label>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="custom-control custom-radio radio-teal">
                                                    <input type="radio" id="customRadio2" name="customRadio" checked class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Tidak Ada</label>
                                                </div>
                                            </div>
                                        </div>  
                                        </section>                                   
                                    </li>
                                </ul>
                                <!-- <div class="col-sm"> -->
                                    
                                <!-- </div>                                 -->
                            <!-- </div>    -->
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>