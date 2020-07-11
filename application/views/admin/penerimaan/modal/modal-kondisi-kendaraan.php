<div id="modal" class="modal fade">
  <div class="modal-dialog modal-dialog-vertical-center" role="document">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tambah Kondisi Kendaraan</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<h3 class="tx-gray-800 tx-normal mg-b-5">Kondisi Kendaraan</h3>        
      	<br>        
      	<form id="form-add-new-kondisi-kendaraan" enctype="multipart/form-data" >    
          <input type="hidden" name="id_penerimaan" id="id_penerimaan" value="<?=($data_penerimaan != null ? $data_penerimaan->id : '') ?>">
            <!-- <div class="form-group">
                <select id="input-kondisi-kendaraan" name="kondisi_kendaraan" 
                    class="form-control select2" 
                    data-placeholder="Choose one" 
                    data-parsley-class-handler="#slWrapper" 
                    data-parsley-errors-container="#slErrorContainer" 
                    required>
                    <option label="Choose one"></option>
                    <?php foreach ($data_kondisi_kendaraan as $key => $value) { ?>
                        <option value="<?=$value['keterangan']?>"><?=$value['keterangan']?></option>
                    <?php } ?>                                                                  
                </select>                  
            </div>           -->
  		      <div class="form-group">
  	          <input type="text" id="input-kondisi-kendaraan" name="kondisi_kendaraan" class="form-control" placeholder="Kondisi Kendaraan" required>
  	        </div>
  	        <input value="Simpan" name="Simpan" type="submit" class="btn btn-success pd-y-12 btn-block"/>        
  	    </form>
      </div>
    </div>
  </div>
</div>