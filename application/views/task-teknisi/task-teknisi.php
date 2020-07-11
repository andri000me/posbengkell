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
                <div class="col-md-12">
                    <label> <i class="fa fa-bell"></i> Tugas Anda </label>                    
                    <div class="row ml-1 mb-4"> 
                        <div class="scrolling-wrapper">
                        <?php foreach ($perintah_kerja as $key => $value) { ?>
                            <div class="card card-sm ml-1 mr-1">
                                <div class="card-body card-task" id="pilih_<?= $value['id'] ?>">
                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase"><?= $value['no_pkb'] ?></span>
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div>
                                            <span class="d-block">
                                                <span class="display-5 font-weight-400 text-dark  text-uppercase">
                                                    <?= $value['no_polisi'] ?>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <h4><?= $value['tipe_warna'] ?></h4>         
                                    <p>No. Mesin <b><?=$value['no_mesin']?></b></p>

                                    <!-- <p><?= $value['telepon_pemilik'] ?></p> -->
                                    <p>Teknisi <b><?=$value['teknisi']?></b></p>
                                    <button class="btn btn-success" type="button" onclick="pilih_tugas('<?= $value['id'] ?>')">Pilih</button>
                                </div>
                            </div>            
                        <?php } ?>
                        </div>           
                    </div>
                    <span style="color: orange; font-size: 11px">
                        <b>*Silahkan Pilih lebih dahulu Tugas untuk dikerjakan </b>
                    </span>
                    <div class="row">   
                        <div class="col-md-12"> 
                            <label> <i class="fa fa-bullhorn"></i> Data Uraian Pekerjaan</label>
                            <section class="hk-sec-wrapper" style="overflow-x:auto;">                                        
                                <!-- <div class="datas"> -->
                                    <table class="table table-hover display pb-30">
                                        <thead>
                                            <tr>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr> 
                                        </thead>
                                        <tbody id="task_teknisi"></tbody>
                                    </table>
                                <!-- </div>    -->
                            </section>                                                                       
                        </div>
                    </div>                  
                </div>
                <div class="col-md-6">                                        
                </div>                
            </div>
        </div>
    </div>
</div>